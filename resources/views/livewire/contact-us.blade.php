<?php

use App\Models\FrontPage\Message;
use function Livewire\Volt\{rules, state};

state(['name' => '', 'email' => '', 'subject' => '', 'message' => '',]);

rules([
    'name' => 'required',
    'email' => 'required|email',
    'subject' => 'required',
    'message' => 'required',
]);

$sendMail = function () {
    $this->validate();
    try {
        $data = $this->only(['name', 'email', 'subject', 'message']);
        $data['message_type'] = 2;
        //Log::info('message send: ', $data);
        //Mail::to('contact@casefile.com')->send(new SendEmail($data));
        Message::create($data);
    } catch (\Exception $e) {
        session()->flash('alert-error', "Failed to send message: ".$e->getMessage());
    }
    $this->reset();
    session()->flash('alert-success', "Your message was sent successfully.");
}
?>

<div class="col-md-6">
    <div class="form-section">
        <form wire:submit.prevent="sendMail" class="contact-form" method="post">
            @csrf
            <div class="form-group">
                <input wire:model="name" id="name" name="name" type="text" class="form-control" required=""
                       placeholder="Full Name">
            </div>

            <div class="form-group">
                <input wire:model="email" class="domainSearchBar form-control" id="email" name="email" type="email"
                       required="" placeholder="Email">
            </div>

            <div class="form-group">
                <input wire:model="subject" id="subject" name="subject" type="text" class="form-control" required=""
                       placeholder="Subject">
            </div>

            <div class="form-group">
                <textarea wire:model="message" id="message" name="message" class="form-control form-message" rows="4"
                          required="" placeholder="Write your message."></textarea>
            </div>

            <div class="form-group">
                @if(session('alert-success'))
                    <div class="btn btn-success btn-sqr">{{ session('alert-success') }}</div>
                @else
                    <button class="btn btn-primary" type="submit">Submit</button>
                @endif
            </div>
        </form>
    </div>
</div>


