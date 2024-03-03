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
        body {
            direction: rtl;
            font-size: 18px;
        }

        .invoice {
            margin: 20px auto;
            width: 21cm;
            padding: 10px;
        }

        .row {
            display: flex;
        }

        .column1 {
            flex: 1;
            padding: 5px;
            border: 1px solid #000;
        }

        .column2 {
            flex: 4;
            padding: 5px;
            border: 1px solid #000;
        }

        .column {
            flex: 1;
            padding: 5px;
            border: 1px solid #000;
        }

        .rotate-text {
            width: 100%;
            height: 100%;
            text-align: center;
            transform: rotate(-90deg);
            white-space: nowrap;
            overflow: hidden;
        }

        .d-flex {
            width: 100%;
            display: flex;
            justify-content: space-around;
            padding-top: 15px;
        }

        @font-face {
            font-family: irSans;
            src: url("http://sun-tech.ir/fonts/iran-sans/persian-number.ttf");
            font-weight: bold;
        }

        * {
            font-family: IrSans,serif !important;
        }
    </style>

    <body>
    <div class="invoice">
        <div class="row">
            <div class="column">سکو های اجاره ای سازمان میادین میوه و تره بار</div>
        </div>
        <div class="row">
            <div class="column1">
                <div class="rotate-text">فروشنده</div>
            </div>
            <div class="column2">آقای: .............<br>آدرس: .............<br>تلفن: .............</div>
        </div>
        <div class="row">
            <div class="column1">
                <div class="rotate-text">خریدار</div>
            </div>
            <div class="column2">صورت حساب آقای: .............<br>به آدرس: .............<br>تلفن: .............</div>
        </div>
        <div class="row">
            <div class="column">وزن با ظرف</div>
            <div class="column">نوع کالا</div>
            <div class="column">تعداد</div>
            <div class="column">ورن خالص</div>
            <div class="column">فی</div>
            <div class="column">قیمت کل به ریال</div>
        </div>';
        // Start the loop
        $empty = '';
        foreach ($customArray as $item) {
            $html .= '
        <div class="row">
            <div class="column">' . $item["item_weight"] . '</div>
            <div class="column">' . $item["item_name"] . '</div>
            <div class="column">' . $item["weight"] . '</div>
            <div class="column">' . $empty . '</div>
            <div class="column">' . $empty . '</div>
            <div class="column">' . $empty . '</div>
        </div>
    ';
        }
        $html .= '
        <div class="row">
            <div class="column">جمع کل به حروف :</div>
        </div>
        <div class="row">
            <div class="column">
                تذکر: اینجانب .................................... اجناس فوق الذکر را سالم تحویل و متعهد میشوم ظرف مدت 7 روز نسبت به
                پرداخت وجه کالای خریداری شده اقدام و تسویه نمایم،بعد از گذشت زمان فوق در صورت عدم پرداخت فروشنده تام
                الاختیار است در مراجع ذیصلاح اقدام قانونی به عمل آورد و حق هرگونه اعتراض را از خود سلب مینمایم.
                <br>
                <div class="d-flex">
                    <div>مهر و امضاء فروشنده</div>
                    <div>امضاء خریدار</div>
                </div>
            </div>
        </div>
    </div>
    </body>

    ';
        $pdf->writeHTML($html, true, false, true, false, '');

        $now = Jalalian::now()->format('Y-m-d_H-i-s');
        $pdfPath = public_path($now . '-invoice.pdf');
        $pdf->Output($pdfPath, 'F');

        $downloadLink = url($now . '-invoice.pdf');
        return response()->json($downloadLink);
    }

}
