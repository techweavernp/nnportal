<?php

use App\Models\FrontPage\Message;
use function Livewire\Volt\{rules, state};

state(['name' => '', 'mobile' => '', 'email' => '', 'subject' => '', 'message' => '',]);

rules([
    'name' => 'required',
    'mobile' => 'size:10',
    'email' => 'required|email',
    'subject' => 'required',
    'message' => 'required',
]);

$sendMail = function () {
    $this->validate();
    try {
        $data = $this->only(['name', 'email', 'mobile', 'subject', 'message']);
        $data['message_type'] = 1;
        Message::create($data);
    } catch (\Exception $e) {
        session()->flash('alert-error', "Failed to send message: ".$e->getMessage());
    }
    $this->reset();
    session()->flash('alert-success', "Your message was sent successfully.");
}
?>


<form class="contact-form" wire:submit.prevent="sendMail" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-6 padding-right">
            <div class="form-group">
                <input wire:model="name" id="name" name="name" type="text" class="form-control" required=""
                       placeholder="Full Name">
            </div>
        </div>

        <div class="col-sm-6 padding-left">
            <div class="form-group">
                <input wire:model="email" class="form-control" id="email" name="email" type="email" required=""
                       placeholder="Email">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <input wire:model="subject" class="form-control" id="case" name="case" type="text" required=""
                       placeholder="Your Case">
            </div>
        </div>
    </div>

    <div class="form-group">
        <textarea wire:model="message" id="message" name="message" class="form-control form-message" rows="4"
                  required="" placeholder="What do you want to know?"></textarea>
    </div>

    <div class="form-group text-center">
        @if(session('alert-success'))
            <div class="btn btn-success btn-sqr">{{ session('alert-success') }}</div>
        @else
            <button class="submitBtn btn btn-primary" type="submit">Submit</button>
        @endif
    </div>
</form>
