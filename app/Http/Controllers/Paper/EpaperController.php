<?php

namespace App\Http\Controllers\Paper;

use Inertia\Inertia;
use App\Models\Epaper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EpaperController extends Controller
{
    public function ePapers()
    {
        $news = Epaper::where('status',1)->with('pdf_images')->get();
        return Inertia::render('News', [
            'News'=>$news,
        ]);
    }
    public function ePaperView($id)
    {
        $news = Epaper::where('status',1)->where('newsid',$id)->with('pdf_images')->first();
        return Inertia::render('EpaperView', [
            'News'=>$news,
        ]);
    }
}
