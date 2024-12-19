<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskExpireSoon extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Przypomnienie: Termin na wykonanie Twojego zadania niedługo wygaśnie.')
            ->line('Twoje zadanie "' . $this->task->name . '" jutro wygaśnie.')
            ->action('Zobacz swoje zadanie', url(route('tasks.show', $this->task->id)))
            ->line('Proszę pamiętaj żeby wykonać swoję zadanie przed upływem terminu.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'task_name' => $this->task->name,
            'expires_at' => $this->task->expiration_date,
        ];
    }
}
