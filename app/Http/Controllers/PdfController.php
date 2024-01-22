<?php

namespace App\Http\Controllers;

use App\Models\Egress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;
use Psy\Util\Str;
use TCPDF;

class PdfController extends Controller
{

    public function download()
    {
        $data = Egress::query()
//            ->whereDate('created_at', Carbon::today())
            ->with('fruit')->get();
        $customArray = [];
        $totalPrice = 0;
        foreach ($data as $item) {
            if (!empty($item['fruit']) && isset($item['fruit']))
                $customArray[] = [
                    'item_name' => $item['fruit']['name'],
                    'item_weight' => $item['weight'] . ' کیلوگرم ',
                    'item_price' => $item['price'] . ' تومان '
                ];
            $totalPrice += $item['price'];
        }
        $pdf = new TCPDF('TCPDF', 'pt', 'A5', true, 'UTF-8', false);

        $pdf->SetCreator('Your Company');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');
        $pdf->SetFont('dejavusans', '', 12);

        $pdf->AddPage();

        $html = '
        <style>
            *{
                direction: rtl;
            }
            h2 {
                color: #333;
                font-size: 24px;
                margin-bottom: 30px;
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                direction: rtl;
                margin-bottom: 30px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 20px;
                text-align: right;
                direction: rtl;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
        <div style="direction: rtl; text-align: center">
            <h3>سازمان میادین میوه و تره بار </h3>
            <h3>استان اصفهان</h3>
            <h4>فاکتور خروجی</h4>
        </div>
        <table>
            <thead>
                <tr>
                    <th>قیمت آیتم</th>
                    <th>وزن آیتم</th>
                    <th>نام آیتم</th>
                </tr>
            </thead>
            <tbody>
    ';

        foreach ($customArray as $item) {
            $html .= '
            <tr>
                <td>' . $item['item_price'] . '</td>
                <td>' . $item['item_weight'] . '</td>
                <td>' . $item['item_name'] . '</td>
            </tr>
        ';
        }

        $html .= '
            </tbody>
        </table>
    ';
        $pdf->writeHTML($html, true, false, true, false, '');

        $now = Jalalian::now()->format('Y-m-d_H-i-s');
        $pdfPath = public_path($now . '-invoice.pdf');
        $pdf->Output($pdfPath, 'F');

        $downloadLink = url($now . '-invoice.pdf');
        return response()->json($downloadLink);
    }

}
