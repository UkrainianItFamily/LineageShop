<?php

namespace App\Models;

use App\Notifications\SupportRequestMessageNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class SupportRequestMessage extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'text',
        'user_id',
        'support_request_id'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function supportRequest(): BelongsTo
    {
        return $this->belongsTo(SupportRequest::class);
    }

    public function sendSupportRequestNewMessage(
        self $supportRequestMessage,
        string $mailToAddress,
        string $mailFromAddress,
        int $supportId,
        int $supportSubjectId
    ) {
        $this->notify(new SupportRequestMessageNotification(
            $supportRequestMessage,
            $mailToAddress,
            $mailFromAddress,
            $supportId,
            $supportSubjectId
        ));
    }
}
