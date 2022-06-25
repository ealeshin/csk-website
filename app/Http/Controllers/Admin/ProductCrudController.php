<?php

namespace App\Http\Controllers\Admin;

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
                'label' => 'Наименование'
            ]
        ]);
    }

	protected function setupShowOperation()
	{
		$this->crud->set('show.setFromDb', false);

        CRUD::addColumns([
            [
                'name' => 'code',
                'label' => 'Артикул'
            ],
            [
                'name' => 'name',
                'label' => 'Наименование'
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
                'name' => 'category_id',
                'label' => 'Категория',
                'type' => 'number'
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
                'name' => 'name',
                'label' => 'Наименование',
                'type' => 'text'
            ],
            [
                'name' => 'price',
                'label' => 'Цена',
                'type' => 'number',
                'attributes' => [
                    'step' => 0.01
                ]
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
