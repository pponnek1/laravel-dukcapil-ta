<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false,   // Throw an Exception on warnings from dompdf
    'public_path' => null,  // Override the public path if needed

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | Set options for the PDF renderer
    |
    */
    'options' => [
        'font_dir' => storage_path('fonts/'),
        'font_cache' => storage_path('fonts/'),
        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),
        'allowed_protocols' => [
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],
        'log_output_file' => null,
        'enable_font_subsetting' => true,
        'pdf_backend' => 'CPDF',
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_paper_orientation' => 'portrait',
        'default_font' => 'sans-serif',
        'dpi' => 96,
        'enable_php' => true,
        'enable_javascript' => true,
        'enable_remote' => true,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
        'is_unicode' => true,
    ],

    'administrationRoute' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Dejavu Sans font directory
    |--------------------------------------------------------------------------
    |
    | This set the directory for the dejavu sans font, if it's not set otherwise
    | defaults to /storage/fonts
    |
    */
    'dejavu_sans_font_dir' => storage_path('fonts'),

    /*
    |--------------------------------------------------------------------------
    | Default Font
    |--------------------------------------------------------------------------
    |
    | If no font is specified in the dompdf configuration, we'll use this
    | font for all text. This must be a Unicode-compatible font.
    |
    */
    'default_font' => 'DejaVu Sans',

    /*
    |--------------------------------------------------------------------------
    | Default PHP Paper Size
    |--------------------------------------------------------------------------
    |
    | This set the default paper size for the PDF.
    |
    */
    'default_paper_size' => 'letter',
];
