<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'first_user_id',
        'second_user_id',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function firstUser(): BelongsTo
    {
        return $this->belongsTo(User::class,'first_user_id', 'id');
    }

    public function secondUser(): BelongsTo
    {
        return $this->belongsTo(User::class,'second_user_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRecipientUser(): BelongsTo
    {
        return $this->firstUser->getId() === Auth::id() ?
            $this->secondUser() : $this->firstUser();
    }


    public function getEmailToSendNotificationAboutNewMessage(): string
    {
        return $this->firstUser->getId() === Auth::id() ?
            $this->secondUser->getEmail() : $this->firstUser->getEmail();
    }
}
