<?php

namespace App\Models;

use App\Notifications\NewMessageNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'message',
        'attachment',
        'author_user_id',
        'chat_id',
        'hidden_status',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_user_id', 'id');
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class,'chat_id','id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getAttachment(): ?string
    {
        return $this->attachment;
    }

    public function getHiddenStatus(): bool
    {
        return $this->hidden_status;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function sendNewMessageNotification(Message $message)
    {
        $this->notify(new NewMessageNotification($message));
    }

}
