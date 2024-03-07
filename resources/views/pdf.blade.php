<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            direction: rtl;
            font-size: 14px;
        }

        .invoice {
            margin: 20px auto 0;
            width: 17cm;
            padding: 10px;
            border-collapse: collapse;
        }

        .invoice2 {
            margin: 0 auto;
            width: 17cm;
            padding: 20px;
            border-collapse: collapse;
        }

        .column1 {
            width: 15%;
            padding: 15px;
            border: 1px solid #000;
            writing-mode: vertical-rl;
            white-space: nowrap;
            overflow: hidden;
        }

        .column2 {
            width: 85%;
            padding: 5px;
            border: 1px solid #000;
        }

        .column {
            padding: 5px;
            border: 1px solid #000;
            width: 16.67%; /* Equal width for each column */
        }

        .columnData {
            padding: 5px;
            border: 1px solid #000;
            width: 16.67%; /* Equal width for each column */
        }

        .rotate-text {
            white-space: nowrap;
            overflow: hidden;
        }

        .d-flex {
            width: 100%;
            text-align: center;
        }

        .d-flex div {
            display: inline-block;
            width: 48%;
        }
    </style>
</head>
<body>
<table class="invoice">
    <tr class="row">
        <td class="column" colspan="6" style="text-align: center;">سکو های اجاره ای سازمان میادین میوه و تره بار</td>
    </tr>
    <tr class="row">
        <td class="column1">
            <div class="rotate-text">فروشنده</div>
        </td>
        <td class="column2">آقای: .............<br>آدرس: .............<br>تلفن: .............</td>
    </tr>
    <tr class="row">
        <td class="column1">
            <div class="rotate-text">خریدار</div>
        </td>
        <td class="column2">صورت حساب آقای: .............<br>به آدرس: .............<br>تلفن: .............</td>
    </tr>
</table>
<table class="invoice2">
    <tr class="row">
        <td class="column" style="width: 16.67%;">وزن با ظرف</td>
        <td class="column" style="width: 16.67%;">نوع کالا</td>
        <td class="column" style="width: 16.67%;">تعداد</td>
        <td class="column" style="width: 16.67%;">وزن خالص</td>
        <td class="column" style="width: 16.67%;">فی</td>
        <td class="column" style="width: 16.67%;">قیمت کل به ریال</td>
    </tr>
    @foreach($data as $item)
        <tr class="row">
            <td class="columnData">{{ $item['item_weight'] }}</td>
            <td class="columnData">{{ $item['item_name'] }}</td>
            <td class="columnData">{{ $item['item_weight'] }}</td>
            <td class="columnData">{{ $item['item_weight'] }}</td>
            <td class="columnData">{{ $item['item_price'] }}</td>
            <td class="columnData">{{ $item['item_price'] }}</td>
        </tr>
    @endforeach
    <tr class="row">
        <td class="column" colspan="6">جمع کل به حروف :</td>
    </tr>
    <tr class="row">
        <td class="column" colspan="6">
            تذکر: اینجانب .................................... اجناس فوق الذکر را سالم تحویل و متعهد میشوم ظرف مدت 7 روز
            نسبت به
            پرداخت وجه کالای خریداری شده اقدام و تسویه نمایم،بعد از گذشت زمان فوق در صورت عدم پرداخت فروشنده تام
            الاختیار است در مراجع ذیصلاح اقدام قانونی به عمل آورد و حق هرگونه اعتراض را از خود سلب مینمایم.
            <br>
            <div class="d-flex">
                <div>مهر و امضاء فروشنده</div>
                <div>امضاء خریدار</div>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
