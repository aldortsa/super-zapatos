<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

use App\Http\Requests\ArticleCrudRequest as SaveRequest;
use App\Http\Requests\ArticleCrudRequest as UpdateRequest;

class ArticleCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setModel('App\Article');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/article');
        $this->crud->setEntityNameStrings('article', 'articles');
        $this->crud->addColumn([
            'name' => 'name',
            'label' => "Name"
        ]);

        $this->crud->addColumn([
            'name' => 'name',
            'label' => "Name"
        ]);

        $this->crud->addColumn([
            'name' => 'price',
            'label' => "Price"
        ]);
        $this->crud->addColumn([
            'name' => 'total_in_shelf',
            'label' => "Total in Shelf"
        ]);

        $this->crud->addColumn([
            'name' => 'total_in_vault',
            'label' => "Total in Vault"
        ]);

        $this->crud->addColumn([
            'label' => 'Store',
            'type' => 'select',
            'name' => 'store_id',
            'entity' => 'store',
            'attribute' => 'name',
            'model' => "App\Store"
        ]);

        //adding Fields
        $this->crud->addField([    // TEXT
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'description',
            'label' => 'Description',
            'type' => 'textarea',
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'price',
            'label' => 'Price',
            'type' => 'text',
            'hint' => 'Price format: 0.00',
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'total_in_shelf',
            'label' => 'Total in Shelf',
            'type' => 'text'
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'total_in_vault',
            'label' => 'Total in Vault',
            'type' => 'text',
        ]);

        $this->crud->addField([    // SELECT
            'label' => 'Store',
            'type' => 'select2',
            'name' => 'store_id',
            'entity' => 'store',
            'attribute' => 'name',
            'model' => "App\Store"
        ]);

    }

    public function store(SaveRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }
}
