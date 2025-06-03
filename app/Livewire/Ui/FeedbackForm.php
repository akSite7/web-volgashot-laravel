<?php

namespace App\Livewire\Ui;

use App\Models\Feedback;
use Livewire\Component;

class FeedbackForm extends Component
{
    public $name = '';
    public $phone = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Пожалуйста, введите ваше имя.',
        'phone.required' => 'Укажите номер телефона.',
        'message.required' => 'Укажите комментарий.',
    ];

    public function submit()
    {
        $this->validate();

        Feedback::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        session()->flash('success', 'Спасибо за заявку! Мы скоро свяжемся с вами.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.ui.feedback-form');
    }
}
