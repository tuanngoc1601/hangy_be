<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale_Product extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "flash_sale_products";
    protected $primaryKey = "id";

    protected $fillable = [
        "id",
        "flash_sale_id",
        "product_id",
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
        $hashids = new Hashids('flash_sale_products', 10);
        return $hashids->encode($this->attributes['id']);
    }

    /**
     * Get decoded hashids to id
     */
    public static function decodeHashId($hashedId)
    {
        $hashids = new Hashids('flash_sale_products', 10);
        return $hashids->decode($hashedId)[0] ?? null;
    }
}
