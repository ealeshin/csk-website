<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('Категория', 'Категории товаров');
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
                'name' => 'id',
                'label' => 'ID'
            ],
            [
                'name' => 'title',
                'label' => 'Категория',
                'limit' => 144
            ]
        ]);
    }

	protected function setupShowOperation()
	{
		$this->crud->set('show.setFromDb', false);

        CRUD::addColumns([
            [
                'name' => 'id',
                'label' => 'ID'
            ],
            [
                'name' => 'title',
                'label' => 'Категория',
                'limit' => 144
            ]
        ]);

        if (!$this->crud->getCurrentEntry()->parent_id) {
            CRUD::addColumn([
                'name' => 'subcategories',
                'label' => 'Подкатегории',
                'type' => 'closure',
                'function' => function($entry) {
                    $subcategoriesId = Category::where('parent_id', $entry->id)
                        ->pluck('title', 'id')
                        ->toArray();
                    foreach($subcategoriesId as $id => $title) {
                        echo "<a href='/admin/category/{$id}/show'>{$title}</a><br>";
                    }
                }
            ]);
        }
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
                'name' => 'parent_id',
                'label' => 'Корневая категория',
                'hint' => 'Для создания новой корневой категории оставьте это поле пустым',
                'type' => 'select_from_array',
                'default' => null,
                'options' => Category::whereNull('parent_id')->pluck('title', 'id')->toArray()
            ],
            [
                'name' => 'title',
                'label' => 'Название'
            ],
            [
                'name' => 'description',
                'label' => 'Описание'
            ],
            [
                'name' => 'active',
                'label' => 'Показывать на сайте',
                'type' => 'checkbox',
                'default' => true,
                'hint' => 'Используйте этот чекбокс, если нужно скрыть на сайте всю категорию полностью'
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
