<?php

namespace App\Traits;

trait CRUDImageAttributeTrait
{

    public function imageUpload($value, $attribute_name, $disk, $destination_path, $format = 'png')
    {
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        } // if a base64 was sent, store it in the db
        else if (\Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode($format, 90);
            // 1. Generate a filename.
            $filename = md5($value . time()) . '.' . $format;
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = 'storage/' . $destination_path . '/' . $filename;
        } else if ($value) {
            $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
        }
    }

    public function imageMultipleUpload($images, $attribute_name, $property_name, $disk, $destination_path, $withCompressed = false, $format = 'jpg', $maxHeight = null)
    {
        $oldImages = $this->{$attribute_name};
        $oldPaths = array_column($oldImages ?? [], $property_name);

        $imagesArr = [];
        foreach ($images as $item) {
            $value = $item->{$property_name} ?? null;
            if ($value && \Str::startsWith($value, 'data:image')) {
                $image = \Image::make($value);

                if ($maxHeight !== null) {
                    $image = $image->heighten($maxHeight, function ($constraint) {
                        $constraint->upsize();
                    });
                }

                $encodedImage = $image->encode($format, 90);
                $filename = md5($value . time()) . '.' . $format;
                \Storage::disk($disk)->put($destination_path . '/' . $filename, $encodedImage->stream());

                $imagesArrItem = [$property_name => '/storage/' . $destination_path . '/' . $filename];
                $imagesArr[] = $imagesArrItem;
            } else if (\Str::startsWith($value, '/storage')) {
                $index = array_search($value, $oldPaths);
                if ($index !== false) {
                    $imagesArr[] = $oldImages[$index];
                }
            }
        }

        if ($oldImages) {
            foreach ($oldImages as $value) {
                if (!in_array($value, $imagesArr)) {
                    \Storage::disk($disk)->delete($value);
                }
            }
        }
        $this->attributes[$attribute_name] = json_encode($imagesArr);
    }
}
