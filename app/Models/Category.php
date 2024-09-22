<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "categories";
    protected $primaryKey = "id";

    protected $fillable = [
        "id",
        "name",
        "slug",
        "description",
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
        $hashids = new Hashids('categories', 10);
        return $hashids->encode($this->attributes['id']);
    }

    /**
     * Get decoded hashids to id
     */
    public static function decodeHashId($hashedId)
    {
        $hashids = new Hashids('categories', 10);
        return $hashids->decode($hashedId)[0] ?? null;
    }

    /**
     * The categories that belong to the products.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
}
