<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "carts";
    protected $primaryKey = "id";

    protected $fillable = [
        "id",
        "user_id",
        "created_at",
        "updated_at"
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get encoded id by hashids 
     */
    public function getHashedIdAttribute()
    {
        $hashids = new Hashids('carts', 10);
        return $hashids->encode($this->attributes['id']);
    }

    /**
     * Get decoded hashids to id
     */
    public static function decodeHashId($hashedId)
    {
        $hashids = new Hashids('carts', 10);
        return $hashids->decode($hashedId)[0] ?? null;
    }

    /**
     * The cart that has one the user.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }

    /**
     * The cart that has many the cart_items.
     */
    public function cart_items(): HasMany
    {
        return $this->hasMany(Cart_Item::class, 'cart_id');
    }
}
