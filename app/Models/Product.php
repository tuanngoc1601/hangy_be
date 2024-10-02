<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "products";
    protected $primaryKey = "id";

    protected $fillable = [
        "id",
        "name",
        "slug",
        "description",
        "real_price",
        "daily_price",
        "flash_sale_price",
        "stock_quantity",
        "sold_quantity",
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
        $hashids = new Hashids('products', 10);
        return $hashids->encode($this->attributes['id']);
    }

    /**
     * Get decoded hashids to id
     */
    public static function decodeHashId($hashedId)
    {
        $hashids = new Hashids('products', 10);
        return $hashids->decode($hashedId)[0] ?? null;
    }

    /**
     * The products that belong to the categories.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }

    /**
     * The products that has many the order_items.
     */
    public function order_items(): HasMany
    {
        return $this->hasMany(Order_Item::class, 'product_id');
    }

    /**
     * The products has many to the cart items.
     */
    public function cart_items(): HasMany
    {
        return $this->hasMany(Cart_Item::class, 'product_id');
    }

    /**
     * The products that has many the sub products.
     */
    public function sub_products(): HasMany
    {
        return $this->hasMany(Sub_Product::class, 'product_id');
    }

    /**
     * The products that has many the medias.
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class, 'product_id');
    }
}
