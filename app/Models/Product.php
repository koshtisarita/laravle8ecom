<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes; 
    protected $fillable = [
        'title', 'subtitle', 'brand_id',
         'size_id', 'categories', 'length', 'slug',
          'actual_price', 'discount', 'discount_in', 'is_discount', 
          'is_newarrival', 'short_description', 'long_description', 'status',
           'meta_title', 'meta_keywords', 'meta_discription', 'model_detail', 
           'remember_token', 'created_at', 'updated_at'
    ];
}
