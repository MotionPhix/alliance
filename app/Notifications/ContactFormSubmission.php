<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormSubmission extends Notification
{
  use Queueable;

  public function __construct(
    public array $data
  ) {}

  public function via($notifiable): array
  {
    return ['mail'];
  }

  public function toMail($notifiable): MailMessage
  {
    return (new MailMessage)
      ->subject('New Contact Form Submission')
      ->greeting('Hello!')
      ->line('You have received a new contact form submission:')
      ->line('From: ' . $this->data['name'] . ' (' . $this->data['email'] . ')')
      ->line('Subject: ' . $this->data['subject'])
      ->line('Message:')
      ->line($this->data['message'])
      ->action('View in Dashboard', url('/admin/contacts'))
      ->line('Thank you for using our application!');
  }
}
