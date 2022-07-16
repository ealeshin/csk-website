<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('Товар', 'Товары');
        CRUD::orderBy('id', 'desc');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name' => 'code',
                'label' => 'Артикул'
            ],
            [
                'name' => 'name',
                'label' => 'Наименование',
                'limit' => 144
            ]
        ]);
    }

	protected function setupShowOperation()
	{
		$this->crud->set('show.setFromDb', false);

        CRUD::addColumns([
            [
                'name' => 'category.title',
                'label' => 'Категория',
                'limit' => 144
            ],
            [
                'name' => 'code',
                'label' => 'Артикул'
            ],
            [
                'name' => 'barcode',
                'label' => 'Штрихкод'
            ],
            [
                'name' => 'brand',
                'label' => 'Бренд'
            ],
            [
                'name' => 'name',
                'label' => 'Наименование',
                'limit' => 144
            ],
            [
                'name' => 'description',
                'label' => 'Описание',
                'limit' => 1024,
                'hint' => 'Описание можно разбить на абзацы и использовать HTML-теги'
            ],
            [
                'name' => 'price',
                'label' => 'Цена'
            ],
            [
                'name' => 'in_stock',
                'label' => 'В наличии',
                'type' => 'closure',
                'function' => function($entry) {
                    return $entry->in_stock ? 'Да' : 'Нет';
                }
            ],
            [
                'name' => 'active',
                'label' => 'Показывать на сайте',
                'type' => 'closure',
                'function' => function($entry) {
                    return $entry->active ? 'Да' : 'Нет';
                }
            ],
            [
                'name' => 'product_images',
                'label' => 'Изображения',
                'type' => 'closure',
                'function' => function($entry) {
                    $array = $entry->images;
                    foreach($array as $element) {
                        echo "<img src=\"{$element['image']}\" width=\"200\" height=\"auto\" vspace=\"10\"><br>";
                    }
                    return ' ';
                }
            ]
        ]);
	}

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::addFields([
            [
                'name' => 'category',
                'label' => 'Категория',
                'type' => 'select_from_array',
                'allows_null' => false,
                'options' => Category::getSelectOptionsArray(),
                'default' => Product::lastAddedCategoryId()
            ],
            [
                'name' => 'code',
                'label' => 'Артикул',
                'type' => 'text'
            ],
            [
                'name' => 'barcode',
                'label' => 'Штрихкод',
                'type' => 'number'
            ],
            [
                'name' => 'brand',
                'label' => 'Бренд',
                'type' => 'text'
            ],
            [
                'name' => 'name',
                'label' => 'Наименование',
                'type' => 'text'
            ],
            [
                'name' => 'description',
                'label' => 'Описание',
                'type' => 'textarea'
            ],
            [
                'name' => 'price',
                'label' => 'Цена',
                'type' => 'number',
                'attributes' => [
                    'step' => 0.01
                ],
                'hint' => 'Цена в формате 123 или 1234,99 (разделитель - запятая)'
            ],
            [
                'name' => 'unit',
                'label' => 'Единица измерения',
                'type' => 'select',
                'allows_null' => false
            ],
            [
                'name' => 'in_stock',
                'label' => 'В наличии',
                'type' => 'checkbox',
                'default' => true
            ],
            [
                'name' => 'active',
                'label' => 'Показывать на сайте',
                'type' => 'checkbox',
                'default' => true
            ],
            [
                'name' => 'images',
                'label' => 'Изображения',
                'type' => 'repeatable',
                'fields' => [
                    [
                        'name' => 'image',
                        'type' => 'image',
                        'label' => 'Изображение',
                        'wrapper' => ['class' => 'form-group col-md-4'],
                        'max_file_size' => 2097152,
                    ],
                ],
                'new_item_label' => 'Добавить изображение',
                'hint' => 'Формат изображения JPG или PNG. Размер одного изображения - до 2 Мб'
            ],
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
