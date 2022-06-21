<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class UserWallet.
 *
 * @property int $id
 * @property string $info
 * @property int $user_id
 * @property int $wallet_type_id
 */
class UserWallet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'info',
        'user_id',
        'wallet_type_id',
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

    public function walletType(): BelongsTo
    {
        return $this->belongsTo(WalletType::class);
    }

    public function financeOperationsHistories(): HasMany
    {
        return $this->hasMany(FinanceOperationsHistory::class, 'wallet_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getWalletTypeId(): int
    {
        return $this->wallet_type_id;
    }

    public function getInfoWithMask(): string
    {
        return preg_replace('/\d{6}(?=\d{4}$)/', '******', $this->info);
    }
}
