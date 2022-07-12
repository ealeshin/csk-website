<?php

namespace App\Services;

class FormHandler
{
    protected $name;
    protected $phone;
    protected $email;
    protected $data = [];

    public function __construct($name, $phone, $email, $data = [])
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->data = $data;
    }
}