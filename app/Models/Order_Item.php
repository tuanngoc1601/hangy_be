<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order_Item extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "order_items";
    protected $primaryKey = "id";

    protected $fillable = [
        "id",
        "order_id",
        "product_id",
        "sub_product_id",
        "quantity",
        "price",
        "sub_total_price",
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
        $hashids = new Hashids('order_items', 10);
        return $hashids->encode($this->attributes['id']);
    }

    /**
     * Get decoded hashids to id
     */
    public static function decodeHashId($hashedId)
    {
        $hashids = new Hashids('order_items', 10);
        return $hashids->decode($hashedId)[0] ?? null;
    }

    /**
     * The order_items that belong to the order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * The order_items that belong to the products.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * The order_items that belong to the sub products.
     */
    public function sub_product(): BelongsTo
    {
        return $this->belongsTo(Sub_Product::class, 'sub_product_id');
    }
}
