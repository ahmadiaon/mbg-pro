<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>MBG - {{ $title }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ env('APP_URL') }}vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ env('APP_URL') }}vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ env('APP_URL') }}vendors/images/favicon-16x16.png" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}vendors/styles/style.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site favicon -->

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        html {
            zoom: 0.8;
            /* Old IE only */
        }

        .modal-backdrop {
            background-color: transparent;
        }
    </style>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}vendors/styles/icon-font.min.css" />