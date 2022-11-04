<?php

namespace App\Http\Controllers;

use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
   public function MakePdfTOImage()
   {
    $pdf = new Pdf(public_path('app.pdf'));
   $pages = $pdf->getNumberOfPages();
    for ($i=1; $i <= $pages; $i++) {
        $pdf->setPage(2)
    ->saveImage('title'.$i.'.pdf');
    }

   }
}
