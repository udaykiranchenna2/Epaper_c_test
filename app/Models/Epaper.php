<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epaper extends Model
{
    use HasFactory;
    protected $fillable = ['title','status','pdf_file','pdf_url','news_url','edition','addedby','date','newsid','newsno','category_id','sub_category_id'];

    public function pdf_images()
    {
        return $this->hasMany(PdfImage::class,'news_id','newsid');
    }
}
