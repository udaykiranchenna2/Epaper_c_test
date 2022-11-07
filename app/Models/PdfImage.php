<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfImage extends Model
{
    use HasFactory;
    protected $fillable = ['image_file','image_url','news_id'];
}
