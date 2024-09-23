<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sub_Product extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "sub_products";
    protected $primaryKey = "id";

    protected $fillable = [
        "id",
        "name",
        "description",
        "real_price",
        "daily_price",
        "flash_sale_price",
        "stock_quantity",
        "sold_quantity",
        "product_id",
        "image_url",
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
        $hashids = new Hashids('sub_products', 10);
        return $hashids->encode($this->attributes['id']);
    }

    /**
     * Get decoded hashids to id
     */
    public static function decodeHashId($hashedId)
    {
        $hashids = new Hashids('sub_products', 10);
        return $hashids->decode($hashedId)[0] ?? null;
    }

    /**
     * The sub products that has many the cart items.
     */
    public function cart_items(): HasMany
    {
        return $this->hasMany(Cart_Item::class, 'sub_product_id');
    }

    /**
     * The sub products that belong to the products.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
