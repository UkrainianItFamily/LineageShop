<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class UserRating.
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_customer_id
 * @property int $rating
 * @property string $text
 * @property int $order_id
 * @property string $created_at
 */
class UserRating extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'user_customer_id',
        'rating',
        'text',
        'order_id',
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

    public function userCustomers(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_customer_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getUserCustomerId(): int
    {
        return $this->user_customer_id;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}
