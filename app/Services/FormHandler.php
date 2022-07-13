<?php

namespace App\Services;

class FormHandler
{
    protected $name;
    protected $phone;
    protected $email;
    protected $text;
    protected $data = [];
    protected $to;

    public function __construct($name, $phone, $email, $text = '', $data = [])
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->text = $text;
        $this->data = $data;
        $this->to = env('MAIL_TO');
    }

    public function sendOrder()
    {
        $data = $this->getCommonFields();
        $data +=  ['data' => $this->data];
        $view = view('mail.order', $data)->render();

        return $this->sendEmail($this->to, 'Заказ на cskone.ru', $view);
    }

    public function sendQuestion()
    {
        $data = $this->getCommonFields();
        $data +=  ['question' => $this->text];
        $view = view('mail.question', $data)->render();

        return $this->sendEmail($this->to, 'Вопрос на cskone.ru', $view);
    }

    protected function getCommonFields()
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }

    protected function sendEmail($to, $subject, $message)
    {
        $headers = "From: mail@example.com\r\n"
            ."Content-type: text/html; charset=utf-8\r\n"
            ."X-Mailer: PHP mail script";

        $result = mail($to, $subject, $message, $headers);

        return $result;
    }
}