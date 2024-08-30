<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'status'];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    protected static function booted()
    {
        static::creating(function ($category) {
            if (is_null($category->status)) {
                $category->status = 'active';
            }
        });
    }
}
