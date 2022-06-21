<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class FinanceOperationsHistory.
 *
 * @property int $id
 * @property int $user_id
 * @property int $money
 * @property int $type
 * @property int $status
 * @property int $wallet_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 * @property int $canceled_at
 * @property string $canceled_info
 */
class FinanceOperationsHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'money',
        'type',
        'status',
        'wallet_id',
        'canceled_at',
        'canceled_info',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userWallet(): BelongsTo
    {
        return $this->belongsTo(UserWallet::class, 'wallet_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getMoney(): int
    {
        return $this->money;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getWalletId(): int
    {
        return $this->wallet_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getCanceledAt(): ?string
    {
        return $this->canceled_at;
    }

    public function getCanceledInfo(): ?string
    {
        return $this->canceled_info;
    }
}
