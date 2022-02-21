<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    // use HasFactory;
    protected $fillable=['title','sub_title','image_path','hyperlink','created_at','updated_at'];
}
