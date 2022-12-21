<?php

namespace App\Http\Controllers;

use Imagick;
use Exception;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Epaper;
use App\Models\Category;
use App\Models\PdfImage;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
class PdfController extends Controller
{

    public function uploadPDF()
    {
        $Categories = Category::where('status',true)->pluck('title','id');
        return Inertia::render('Pdf/uploadPDF', [
            'Categories'=> $Categories,
        ]);
    }
    public function epapaers()
    {

         $news = Epaper::where('status',1)->with('pdf_images')->get();
        return Inertia::render('Pdf/Epapers', [
            'News'=>$news,
        ]);
    }

    public function storePDF(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'date'=>'required',
            'category'=>'required',
       ]);

        $now = Carbon::now();
        $unique_code = $now->format('YmdHisu');
        $count = Epaper::count();
        $epaper = new Epaper();
        $uniqid = Str::random(9);



       $fileName = time().'.'.$request->file('pdf')->getClientOriginalExtension();
       $pdf =$request->file('pdf')->storeAs('public/pdfs', $fileName);
        $pdf_url = asset('storage/pdfs/'.$fileName);
        $epaper->title = $request->title;
        $epaper->pdf_file = $fileName;
        $epaper->pdf_url = $pdf_url;
        $epaper->news_url = null;
        $epaper->edition = null;
        $epaper->addedby = Auth::user()->id;
        $epaper->status = 1;
        $epaper->date = Carbon::parse($request->date)->format('Y-m-d');
        $epaper->newsid = $unique_code;
        $epaper->newsno = $count+1;
        $epaper->category_id = $request->category;
        $epaper->save();
        $im = new Imagick();
        public_path('storage/pdfs/'.$fileName);
        $im->setResolution(300,300);
        $im->readimage(public_path('storage/pdfs/'.$fileName));
        $pages = $im->getNumberImages();
        $im->setImageFormat('jpeg');
        $im->setImageBackgroundColor('white');
        $im->setImageAlphaChannel(Imagick::VIRTUALPIXELMETHOD_WHITE);
            for($i = 0;$i < $pages; $i++) { 
                $pdfImage = new PdfImage();
                // Set iterator postion

                try{
                    $im->setIteratorIndex($i);
                }catch(Exception $e)
                {
                    return response([$e,$i]);
                }
                // Set image format
                $im->setImageFormat('jpeg');
                $imageName = 'epaper_'.$unique_code.'_'.$i.'.jpg';
                // Write Images to temp 'upload' folder
                $im->writeImage(storage_path('app/public/pdfimages/'.$imageName));

                $pdfImage->image_file = $imageName;
                $pdfImage->image_url =asset('storage/pdfimages/'.$imageName);
                $pdfImage->news_id =$unique_code;
                $pdfImage->save();

            }

            $im->clear();
            $im->destroy();



            return response()->json(['status'=>true]);


    //    storage_path('app/public/pdfimages/'.'epaper'.$i.'.jpg');

    }

    public function ePaperView($id)
    {
        $news = Epaper::where('status',1)->where('newsid',$id)->with('pdf_images')->first();
        return Inertia::render('Pdf/PaperView', [
            'News'=>$news,
        ]);
    }
   public function MakePdfTOImage()
   {
    $img = Image::make(public_path('thumb.jpg'))->resize(300, 200);
    return $img->response('jpg');
    $pdf = new Pdf(public_path('app.pdf'));
    // $pages = $pdf->getNumberOfPages();

//    $pages = $pdf->getNumberOfPages();
//     for ($i=1; $i <= $pages; $i++) {
//         $pdf->setPage(2)
//     ->saveImage('/storage/app/public/pdfimages/'.'epaper'.$i.'.png');
    // }

   }

}
