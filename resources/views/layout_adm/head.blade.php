<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ env('APP_URL') }}vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ env('APP_URL') }}vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ env('APP_URL') }}vendors/images/favicon-16x16.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}vendors/styles/css2.css" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css"
        href="{{ env('APP_URL') }}src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="{{ env('APP_URL') }}src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}vendors/styles/style.css" />

    <style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }
          
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
          
        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style>

    <style>
          @if(session('dataUser')->role == 'admin-hr')
        html {
            zoom: 0.9;
        }
        @elseif(session('dataUser')->role == 'logistic')
        html {
            zoom: 0.0;
        }
        @endif 

        
    </style>