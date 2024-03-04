<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
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
            width: 100%;
            overflow: hidden;
            clear: both;
        }

        .column {
            float: right;
            width: calc(50% - 6px); /* subtracting margin and border */
            padding: 5px;
            border: 1px solid #000;
            box-sizing: border-box;
        }

        .rotate-text {
            writing-mode: tb-rl;
            white-space: nowrap;
        }

        .d-flex::after {
            content: "";
            display: block;
            clear: both;
        }

        .d-flex > div {
            width: 48%;
            float: right;
            margin-bottom: 15px;
        }

        .d-flex > div:last-child {
            float: left;
        }
    </style>
</head>
<body>
<div class="invoice">
    <div class="row">
        <div class="column">سکو های اجاره ای سازمان میادین میوه و تره بار</div>
    </div>
    <div class="row">
        <div class="column">
            <div class="rotate-text">فروشنده</div>
        </div>
        <div class="column">
            آقای: .............<br>آدرس: .............<br>تلفن: .............
        </div>
    </div>
    <div class="row">
        <div class="column">
            <div class="rotate-text">خریدار</div>
        </div>
        <div class="column">
            صورت حساب آقای: .............<br>به آدرس: .............<br>تلفن: .............
        </div>
    </div>
    <div class="row">
        <div class="column">وزن با ظرف</div>
        <div class="column">نوع کالا</div>
        <div class="column">تعداد</div>
        <div class="column">ورن خالص</div>
        <div class="column">فی</div>
        <div class="column">قیمت کل به ریال</div>
    </div>
    <div class="row">
        <div class="column">&nbsp;</div>
        <div class="column">&nbsp;</div>
        <div class="column">&nbsp;</div>
        <div class="column">&nbsp;</div>
        <div class="column">&nbsp;</div>
        <div class="column">&nbsp;</div>
    </div>
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
</html>
