<?php

namespace App\Http\Controllers;

use App\Models\Egress;
use Illuminate\Support\Carbon;
use misterspelik\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    public function download()
    {

        $data = Egress::query()
            ->whereDate('created_at', Carbon::today()->subDays(2))
            ->with('fruit')->get();
        if (empty($data)) {
            return response()->json(['message' => 'در این روز داده ای موجود نیست']);
        }
        $array = [];
        $totalPrice = 0;
        foreach ($data as $item) {
            if (!empty($item['fruit']) && isset($item['fruit']))
                $array[] = [
                    'item_name' => $item['fruit']['name'],
                    'item_weight' => $item['weight'] . ' کیلوگرم ',
                    'item_price' => $item['price'] . ' تومان '
                ];
            $totalPrice += (int)$item['price'];
        }

        $pdf = PDF::loadView('pdf', compact($array));
        return $pdf->download('disney.pdf');
    }

//    public function download()
//    {
//        $pdf = new TCPDF('TCPDF', 'pt', 'A4', true, 'UTF-8', false);
//
//        $pdf->SetCreator('Your Company');
//        $pdf->SetAuthor('Your Name');
//        $pdf->SetTitle('Invoice');
//        $pdf->SetSubject('Invoice');
//        $pdf->SetFont('dejavusans', '', 12);
//
//        $pdf->AddPage();
//        $pdf->writeHTML($html, true, false, true, false, '');
//
//        $now = Jalalian::now()->format('Y-m-d_H-i-s');
//        $pdfPath = public_path($now . '-invoice.pdf');
//        $pdf->Output($pdfPath, 'F');
//
//        $downloadLink = url($now . '-invoice.pdf');
//        return response()->json($downloadLink);
//    }

}
