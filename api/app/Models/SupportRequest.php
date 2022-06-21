<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\SupportRequestNotification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *  Class SupportRequest.
 *
 * @property int $id
 * @property string $text
 * @property string $subject
 * @property int|null $order_id
 * @property string $login
 * @property int $author_id
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $email
 */
class SupportRequest extends Model
{
    use SoftDeletes;
    use Notifiable;


    protected $fillable = [
        'text',
        'subject',
        'order_id',
        'login',
        'author_id',
        'status',
        'email'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getSubject(): int
    {
        return $this->subject;
    }

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function sendSupportRequest(self $supportRequest)
    {
        $this->notify(new SupportRequestNotification($supportRequest));
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
