<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart_Item extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "cart_items";
    protected $primaryKey = "id";

    protected $fillable = [
        "id",
        "cart_id",
        "product_id",
        "sub_product_id",
        "quantity",
        "amount",
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
        $hashids = new Hashids('cart_items', 10);
        return $hashids->encode($this->attributes['id']);
    }

    /**
     * Get decoded hashids to id
     */
    public static function decodeHashId($hashedId)
    {
        $hashids = new Hashids('cart_items', 10);
        return $hashids->decode($hashedId)[0] ?? null;
    }

    /**
     * The cart item that belong to the cart.
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    /**
     * The cart item that belong to the products.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * The cart item that belong to the sub products.
     */
    public function sub_product(): BelongsTo
    {
        return $this->belongsTo(Sub_Product::class, 'sub_product_id');
    }
}
