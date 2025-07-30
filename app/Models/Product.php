<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'regular_price',
        'discount_percentage',
        'discount_price',
        'category_id',
        'brand_id',
        'stock_quantity',
        'status',
        'discount_start_date',
        'discount_end_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Uncategorized',
        ]);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault([
            'name' => 'No Brand',
        ]);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getMainImage()
    {
        return $this->images->first()?->image ?? 'images/no-image.jpg';
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);

            // Optional: Make sure slug is unique
            $originalSlug = $product->slug;
            $count = 1;
            while (Product::where('slug', $product->slug)->exists()) {
                $product->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);

                // Make sure updated slug is unique
                $originalSlug = $product->slug;
                $count = 1;
                while (Product::where('slug', $product->slug)->where('id', '!=', $product->id)->exists()) {
                    $product->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }
}
