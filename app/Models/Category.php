<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Add parent_id to fillable so you can mass assign it
    protected $fillable = ['name', 'parent_id'];

    // Parent category relation (nullable)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Children (subcategories) relation
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
