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

        /*@font-face {*/
        /*    font-family: irSans;*/
        /*    src: url("http://sun-tech.ir/fonts/iran-sans/persian-number.ttf");*/
        /*    font-weight: bold;*/
        /*}*/

        /** {*/
        /*    font-family: IrSans,serif !important;*/
        /*}*/
    </style>
</head>
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
