<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #nomer_surat {
            text-align: center;
        }

        .nama_surat {
            text-transform: uppercase;
            text-decoration: underline;
            font-weight: bolder;
        }

        #surat {
            padding: 10px;
            border: 1px solid green;
            min-width: 300px;
            min-height: 400px;
            overflow: auto;
        }

        #surat div {
            margin: 4px;
        }

        #par_pembuka {
            text-align: justify;
        }

        #content_surat {
            position: auto;
            //  border:1px solid red;
            overflow: auto;
            padding-left: 30px;
            min-height: 300px;
        }

        #content_surat1 {
            position: auto;
            //  border:1px solid red;
            overflow: auto;
            padding-left: 30px;
            min-height: 300px;
        }

        #content_surat2 {
            position: auto;
            //  border:1px solid red;
            overflow: auto;
            padding-left: 30px;
            min-height: 300px;
        }

        #content_surat div {
            position: relative;
            padding: 1px;
        }

        #content_surat1 div {
            position: relative;
            padding: 1px;
        }

        #content_surat2 div {
            position: relative;
            padding: 1px;
        }

        label.l_form {
            //  display: inline-block;
        }

        .isian_surat {
            position: absolute;
            left: 170px;
            width: auto;


        }

        * {
            background: none;
            border: none;
        }

        body {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1.4;
            word-spacing: 2pt;
            letter-spacing: 0.2pt;
            font-family: Garamond, "Times New Roman", serif;
            color: #000;
            background: none;
            font-size: 12pt;
        }

        #header,
        #left-column,
        #footer {
            display: none;
        }

        #middle,
        #center-column,
        #main {
            background: #FFF;
            width: 100%;
            border: none;
            box-shadow: none;
        }

        #surat_tampil {
            width: 95%;
            padding: 3px;
            margin: 0 auto;
            border: none;
            background: none;
        }

        #kepala_surat {
            width: 95%;
            margin: 0 auto;
            text-align: center;
            font-size: 13pt;
        }

        #kepalasurat {
            width: 95%;
            margin: 0 auto;
            background: url("logo.png");
            text-align: center;
            font-size: 13pt;
        }

        #logo_surat {
            display: block;
            position: absolute;
            top: 10px;
            left: 50px;
        }

        .garis {
            border-bottom: 3px solid #000;
            width: 100%;
            margin: 0 auto;
            margin-bottom: 15px;
            clear: both;
        }

        #content_surat {
            width: 95%;
            position: auto;
            padding-left: 30px;
            margin: 0 auto;
        }

        #content_surat1 {
            width: 95%;
            position: auto;
            padding-left: 30px;
            margin: 0 auto;
        }

        #content_surat2 {
            width: 95%;
            position: auto;
            padding-left: 30px;
            margin: 0 auto;
        }

        #content_surat label {
            display: block;
            width: 29%;
            float: left;
            clear: both;
        }

        #content_surat1 label {
            display: block;
            width: 29%;
            float: left;
            clear: both;
        }

        #content_surat2 label {
            display: block;
            width: 29%;
            float: left;
            clear: both;
        }

        #content_surat span.titik {
            float: left;
            width: 1%;
        }

        #content_surat1 span.titik {
            float: left;
            width: 1%;
        }

        #content_surat2 span.titik {
            float: left;
            width: 1%;
        }

        #content_surat span.s_kanan {
            float: left;
            max-width: 50%;
            text-align: justify;
        }

        #content_surat1 span.s_kanan {
            float: left;
            max-width: 50%;
            text-align: justify;
        }

        #content_surat2 span.s_kanan {
            float: left;
            max-width: 50%;
            text-align: justify;
        }

        #par_penutup,
        #par_pembuka,
        #nomer_surat {
            clear: both;
            position: relative;
            width: 95%;
            margin: 0 auto;
            margin-bottom: 15px;
        }

        #nomer_surat {
            text-align: center;
        }

        .masuk_alinea {
            margin-right: 20px;
        }

        .tanda_tangan {
            float: left;
            text-align: center;
            width: 50%;
        }

        .kosong {
            margin-bottom: 70px;
        }

        #surat_tampil {
            width: 480px;
            border: 1px solid #4D4D4D;
            overflow: auto;
            padding: 3px;
            margin: 0 auto;
        }

        #kepala_surat {
            width: 450px;
            margin: 0 auto;
            text-align: center;
        }

        #logo_surat {
            display: none;
        }

        #isi {
            display: inline-block;
            width: 200px;
        }

        .garis {
            border-bottom: 3px solid #000;
            width: 600px;
            margin: 0 auto;
            margin-bottom: 10px;
            clear: both;
        }

        #content_surat {
            width: 450px;
            position: auto;
            padding-left: 30px;
            margin: 0 auto;
        }

        #content_surat1 {
            width: 450px;
            position: auto;
            padding-left: 30px;
            margin: 0 auto;
        }

        #content_surat2 {
            width: 450px;
            position: auto;
            padding-left: 30px;
            margin: 0 auto;
        }

        #content_surat label {
            display: block;
            width: 140px;
            float: left;
            clear: both;
        }

        #content_surat1 label {
            display: block;
            width: 140px;
            float: left;
            clear: both;
        }

        #content_surat2 label {
            display: block;
            width: 140px;
            float: left;
            clear: both;
        }

        #content_surat span.s_kanan {
            float: left;
            max-width: 200px;
            text-align: justify;
        }

        #content_surat1 span.s_kanan {
            float: left;
            max-width: 200px;
            text-align: justify;
        }

        #content_surat2 span.s_kanan {
            float: left;
            max-width: 200px;
            text-align: justify;
        }

        #content_surat span.titik {
            float: left;
            width: 10px;
        }

        #content_surat1 span.titik {
            float: left;
            width: 10px;
        }

        #content_surat2 span.titik {
            float: left;
            width: 10px;
        }

        #par_penutup,
        #par_pembuka,
        #nomer_surat {
            clear: both;
            position: relative;
            width: 650px;
            margin: 0 auto;
            margin-bottom: 15px;
        }

        #nomer_surat {
            text-align: center;
        }

        .masuk_alinea {
            margin-right: 20px;
        }

        .tanda_tangan {
            float: left;
            text-align: center;
            width: 50%;
        }

        .kosong {
            margin-bottom: 60px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <?php $i = 0; ?>
    @foreach($data_surat as $surat)
    @if($i!=0)
    <div class="page-break"></div>
    @endif
    <?php $i = 1; ?>
    <div style="padding-left: 30px;">
        <br>
        Kepada Yth. <br>
        Bapak/Ibu Pimpinan <br>
        {{ $surat->financial}} <br>
        Di Tempat  <br>
        <br><br><br>
        Dengan Hormat,<br>
        Yang bertanda tangan dibawah ini: <br><br>
        <div style="padding-left: 30px;">
            <div style="display:inline-block; width: 150px;">Nama</div>
            <div style="display:inline-block; width: 2px;">: </div>
            <div style="display:inline-block; width: 400px;">{{ $surat->name}} </div>
            <br>
        </div>
        <div style="padding-left: 30px;">
            <div style="display:inline-block; width: 150px;">Alamat</div>
            <div style="display:inline-block; width: 2px;">: </div>
            <div style="display:inline-block; width: 400px;">{{ $surat->address}} </div>
            <br>
        </div>
        <div style="padding-left: 30px;">
            <div style="display:inline-block; width: 150px;">Nomer Handphone</div>
            <div style="display:inline-block; width: 2px;">: </div>
            <div style="display:inline-block; width: 400px;">{{ $surat->phone_number}} </div>
            <br>
        </div>
        <div style="padding-left: 30px;">
            <div style="display:inline-block; width: 150px;">Email</div>
            <div style="display:inline-block; width: 2px;">: </div>
            <div style="display:inline-block; width: 400px;">{{ $surat->email}} </div>
            <br>
        </div>
        <div style="padding-left: 30px;">
            <div style="display:inline-block; width: 150px;">Pekerjaan</div>
            <div style="display:inline-block; width: 2px;">: </div>
            <div style="display:inline-block; width: 400px;">{{ $surat->profession}} </div>
            <br>
        </div>
        Dengan ini mengajukan pembuatan rekening tabungan {{ $surat->financial}}  <br>
        <div style="display:inline-block; width: 650px;">
            Pihak kami menyatakan kesanggupan untuk mengikuti syarat dan ketentuan dalam membuka rekening tabungan. Atas
            kerjasamanya kami ucapkan terima kasih.
        </div>
        <br><br>
        <div style="padding-left: 30px;">
            <div class="tanda_tangan" style="float:right">
                <div class="kosong" id="pejabat"> Palangka Raya, Jumat 1 April 2022<br />hormat saya,<br /></div>
                <div id="nama_pejabat" style="text-transform:uppercase;text-decoration:underline;">{{ $surat->name}}</div>
            </div>
        </div>
        <br><br><br><br><br><br>

        <div style="padding-left: 0px;">
            <i>*tembusan)</i><br>
            <div style="padding-left: 30px;">
                Digital Creative Hub
            </div>

        </div>
    </div>
    @endforeach

</body>

</html>
