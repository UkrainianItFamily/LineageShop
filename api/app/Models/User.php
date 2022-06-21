<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyNotification;
use App\Notifications\BindEmailNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetUserPasswordNotification;

/**
 *  Class User.
 *
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $email
 * @property int $license
 * @property int $confirm_email
 * @property string $user_photo
 * @property int $online
 * @property int $confirm_send_email
 * @property bool $password_reset_admin
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_role_id
 * @property string $google_id
 * @property string $yandex_id
 * @property string $vkontakte_id
 * @property string $facebook_id
 * @property string $discord_id
 * @property float $balance
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'login',
        'email',
        'license',
        'user_photo',
        'online',
        'confirm_send_email',
        'password_reset_admin',
        'user_role_id',
        'id',
        'google_id',
        'yandex_id',
        'vkontakte_id',
        'facebook_id',
        'discord_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'balance'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function emailToken(): HasOne
    {
        return $this->hasOne(EmailToken::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function chat(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function userRole(): BelongsTo
    {
        return $this->BelongsTo(UserRole::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLicense(): int
    {
        return $this->license;
    }

    public function getUserPhoto(): ?string
    {
        return $this->user_photo;
    }

    public function getOnline(): int
    {
        return $this->online;
    }

    public function getConfirmSendEmail(): int
    {
        return $this->confirm_send_email;
    }

    public function getPasswordResetAdmin(): bool
    {
        return $this->password_reset_admin;
    }

    public function getUserRoleId(): int
    {
        return $this->user_role_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function getBalance(): string
    {
        return $this->balance;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function sendBindEmail(string $token, string $email)
    {
        $this->notify(new BindEmailNotification($token, $email));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyNotification());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendAdminResetPasswordNotification(string $email, string $password)
    {
        $this->notify(new AdminResetUserPasswordNotification($email, $password));
    }
}
