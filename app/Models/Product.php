<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function features() {
        return $this->hasMany(Feature::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images');
    }
    
}
