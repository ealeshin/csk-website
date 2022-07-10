<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PartnerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Partner::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/partner');
        CRUD::setEntityNameStrings('Партнёр', 'Партнёры');
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
                'name' => 'title',
                'label' => 'Название'
            ],
            [
                'name' => 'link',
                'label' => 'Ссылка'
            ]
        ]);
    }

	protected function setupShowOperation()
	{
		$this->crud->set('show.setFromDb', false);

        CRUD::addColumns([
            [
                'name' => 'title',
                'label' => 'Название'
            ],
            [
                'name' => 'link',
                'label' => 'Ссылка'
            ],
            [
                'name' => 'logo',
                'label' => 'Логотип',
                'type' => 'closure',
                'function' => function($entry) {
                    echo "<img src=\"/{$entry->image}\" width=\"300\" height=\"auto\"";
                    return ' ';
                }
            ],
            [
                'name' => 'description',
                'label' => 'Описание'
            ],
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
                'name' => 'title',
                'type' => 'text',
                'label' => 'Название'
            ],
            [
                'name' => 'link',
                'type' => 'text',
                'label' => 'Ссылка на сайт',
                'hint' => 'Полная ссылка, начинающаяся с https://'
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Описание',
                'hint' => 'Поддерживаются HTML-теги'
            ],
            [
                'name' => 'image',
                'type' => 'image',
                'label' => 'Изображение',
                'max_file_size' => 2097152,
                'hint' => 'Изображение в формате JPG или PNG размером до 2 Мб. Рекомендуемый размер - 400x400 px'
            ]
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
