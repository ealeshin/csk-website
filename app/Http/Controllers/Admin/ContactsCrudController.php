<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContactsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Contact::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contacts');
        CRUD::setEntityNameStrings('Контакты', 'Контакты');
        CRUD::denyAccess('create');
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
                'name' => 'office_name',
                'label' => 'Название точки'
            ],
        ]);
    }

	protected function setupShowOperation()
	{
		$this->crud->set('show.setFromDb', false);

        CRUD::addColumns([
            [
                'name' => 'office_name',
                'label' => 'Название точки'
            ],
            [
                'name' => 'office_type',
                'label' => 'Тип точки'
            ],
            [
                'name' => 'address',
                'label' => 'Адрес'
            ],
            [
                'name' => 'phone_main',
                'label' => 'Главный номер телефона'
            ],
            [
                'name' => 'phone_add',
                'label' => 'Дополнительный номер телефона'
            ],
            [
                'name' => 'email',
                'label' => 'E-mail'
            ],
            [
                'name' => 'work_hours',
                'label' => 'Режим работы'
            ],
            [
                'name' => 'days_off',
                'label' => 'Выходные дни'
            ],
            [
                'name' => 'map',
                'label' => 'Ссылка на iframe с картой'
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
                'name' => 'office_name',
                'label' => 'Название точки',
                'type' => 'text'
            ],
            [
                'name' => 'office_type',
                'label' => 'Тип точки',
                'type' => 'text'
            ],
            [
                'name' => 'address',
                'label' => 'Адрес',
                'type' => 'text'
            ],
            [
                'name' => 'phone_main',
                'label' => 'Главный номер телефона',
                'type' => 'text'
            ],
            [
                'name' => 'phone_add',
                'label' => 'Дополнительный номер телефона',
                'type' => 'text'
            ],
            [
                'name' => 'email',
                'label' => 'E-mail',
                'type' => 'text'
            ],
            [
                'name' => 'work_hours',
                'label' => 'Режим работы',
                'type' => 'text'
            ],
            [
                'name' => 'days_off',
                'label' => 'Выходные дни',
                'type' => 'text'
            ],
            [
                'name' => 'map',
                'label' => 'Ссылка на iframe с картой',
                'type' => 'textarea'
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
