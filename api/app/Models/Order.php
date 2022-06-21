<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class Order
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_customer_id
 * @property int $user_seller_id
 * @property int $wallet_type_id
 * @property int $ship_type
 * @property int $status
 * @property null|int $quantity
 * @property null|string $nickname
 * @property float $order_price
 * @property string $date_open
 * @property null|string $date_close
 */
class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'user_customer_id',
        'user_seller_id',
        'wallet_type_id',
        'ship_type',
        'status',
        'nickname',
        'quantity',
        'order_price',
        'date_open',
        'date_closet',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function userCustomer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_customer_id', 'id');
    }

    public function userSeller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_seller_id', 'id');
    }

    public function walletType(): BelongsTo
    {
        return $this->belongsTo(WalletType::class, 'wallet_type_id', 'id');
    }

    public function userRatings(): HasMany
    {
        return $this->hasMany(UserRating::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getUserCustomerId(): int
    {
        return $this->user_customer_id;
    }

    public function getUserSellerId(): int
    {
        return $this->user_seller_id;
    }

    public function getWalletTypeId(): int
    {
        return $this->wallet_type_id;
    }

    public function getShipType(): int
    {
        return $this->ship_type;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getOrderPrice(): float
    {
        return $this->order_price;
    }

    public function getDateOpen(): string
    {
        return $this->date_open;
    }

    public function getDateClose(): ?string
    {
        return $this->date_close;
    }
}
