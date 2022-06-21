<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *  Class WalletType.
 *
 * @property int $id
 * @property string $name
 * @property string $wallet_symbol
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class WalletType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'wallet_symbol',
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getWalletSymbol(): string
    {
        return $this->wallet_symbol;
    }
}
