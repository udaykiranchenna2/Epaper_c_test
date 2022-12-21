<?php

namespace App\Http\Controllers\Paper;

use App\Composer;
use App\Http\Controllers\Controller;
use App\Models\Epaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;

class EpaperController extends Controller
{
    public function ePapers()
    {
        Artisan::call('optimize');
        $news = Epaper::where('status', 1)->with('pdf_images')->get();
        return Inertia::render('News', [
            'News' => $news,
        ]);
    }
    public function ePaperView($id)
    {
        $news = Epaper::where('status', 1)->where('newsid', $id)->with('pdf_images')->first();
        return Inertia::render('EpaperView', [
            'News' => $news,
        ]);
    }
    public function cropPaper(Request $request)
    {
        $image_64 = $request->file; //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        // find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(10) . '.' . $extension;

        File::put(storage_path() . '/app/public/pdfs/cropped' . $imageName, base64_decode($image));
        $pdf_url = asset('storage/pdfs/cropped' . $imageName);

        return response()->json(['image' => $pdf_url]);

    }
    public function Composer()
    {

        app()->make(Composer::class)->run(['update']);

    }
}
