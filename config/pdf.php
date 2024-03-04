<?php

return [
    'default_font' => 'irsans',
    'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => storage_path('temp/'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',
    'defaultCssFile'        => false,
    'pdfWrapper'            => 'misterspelik\LaravelPdf\Wrapper\PdfWrapper',
    'font_path' => base_path('public/'),
    'font_data' => [
        'irsans' => [
            'R'  => 'persian-number.ttf',    // regular font
            //'B'  => '',       // optional: bold font
            //'I'  => '',     // optional: italic font
            //'BI' => '', // optional: bold-italic font
            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ]
    ]
];
