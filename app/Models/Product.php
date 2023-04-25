<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'status'
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function productsCommandes()
    {
        return $this->hasMany(Commande::class, 'product_id', 'id');
    }
}
