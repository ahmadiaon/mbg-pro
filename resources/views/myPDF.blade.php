<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <link href="{{ env('APP_URL') }}boot_css/bootstrap.min.css" rel="stylesheet"> --}}
    <!-- Bootstrap CSS -->

    <title>Hello, world!</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);

        * {
            margin: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            background: #FFF;
            font-family: 'Roboto', sans-serif;
        }

        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-left {
            float: left;
        }

        .col-right {
            float: right;
        }

        h1 {
            font-size: 1.2em;
            color: #444;
        }

        h2 {
            font-size: .8.7em;
        }
        h4 {
            font-size: .4.7em;
        }

        h3 {
            font-size: 0.9em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .5em;
            color: #666;
            line-height: 1.2em;
        }

        a {
            text-decoration: none;
            color: #00a63f;
        }

        #invoiceholder {
            width: 100%;
            height: 100%;
            padding: 50px 0;
        }

        #invoice {
            position: relative;
            margin: 0 auto;
            width: 700px;
            background: #FFF;
        }

        [id*='invoice-'] {
            /* Targets all id with 'col-' */
            /*  border-bottom: 1px solid #EEE;*/
            padding: 20px;
        }

        #invoice-top {
            border-bottom: 2px solid #00a63f;
        }

        #invoice-mid {
            min-height: 30px;
        }

        #invoice-bot {
            min-height: 240px;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
            width: 50px;
            overflow: hidden;
        }

        .info {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
        }

        .logo img,
        .clientlogo img {
            width: 100%;
        }

        .clientlogo {
            display: inline-block;
            vertical-align: middle;
            width: 50px;
        }

        .clientinfo {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        #message {
            margin-bottom: 30px;
            display: block;
        }

        h2 {
            margin-bottom: 5px;
            color: #444;
        }
        h4 {
            margin-bottom: 2px;
            color: #444;
        }

        .col-right td {
            color: #666;
            padding: 5px 8px;
            border: 0;
            font-size: 0.5em;
            border-bottom: 1px solid #eeeeee;
        }

        .col-right td label {
            margin-left: 5px;
            font-weight: 600;
            color: #444;
        }

        .cta-group a {
            display: inline-block;
            padding: 7px;
            border-radius: 4px;
            background: rgb(196, 57, 10);
            margin-right: 10px;
            min-width: 100px;
            text-align: center;
            color: #fff;
            font-size: 0.5em;
        }

        .cta-group .btn-primary {
            background: #00a63f;
        }

        .cta-group.mobile-btn-group {
            display: none;
        }



        .tabletitle th {
            border-bottom: 2px solid #ddd;
            text-align: right;
        }

        .tabletitle th:nth-child(2) {
            text-align: left;
        }

        th {
            font-size: 0.5em;
            text-align: left;
            padding: 5px 10px;
        }

        .item {
            width: 50%;
        }

        .list-item td {
            text-align: right;
        }

        .list-item td:nth-child(2) {
            text-align: left;
        }

        .total-row th,
        .total-row td {
            text-align: right;
            font-weight: 700;
            font-size: .5em;
            border: 0 none;
        }

        .table-main {}

        footer {
            border-top: 1px solid #eeeeee;
            ;
            padding: 15px 20px;
        }

        .effect2 {
            position: relative;
        }

        .effect2:before,
        .effect2:after {
            z-index: -1;
            position: absolute;
            content: "";
            bottom: 15px;
            left: 10px;
            width: 50%;
            top: 80%;
            max-width: 300px;
            background: #777;
            -webkit-box-shadow: 0 15px 10px #777;
            -moz-box-shadow: 0 15px 10px #777;
            box-shadow: 0 15px 10px #777;
            -webkit-transform: rotate(-3deg);
            -moz-transform: rotate(-3deg);
            -o-transform: rotate(-3deg);
            -ms-transform: rotate(-3deg);
            transform: rotate(-3deg);
        }

        .effect2:after {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        }

        @media screen and (max-width: 767px) {
            h1 {
                font-size: .6em;
            }
            h3 {
                font-size: .2em;
            }

            #invoice {
                width: 100%;
            }

            #message {
                margin-bottom: 20px;
            }

            [id*='invoice-'] {
                padding: 20px 10px;
            }

            .logo {
                width: 140px;
            }

            .title {
                float: none;
                display: inline-block;
                vertical-align: middle;
                margin-left: 40px;
            }

            .title p {
                text-align: left;
            }

            .col-left,
            .col-right {
                width: 100%;
            }


            .cta-group {
                text-align: center;
            }

            .cta-group.mobile-btn-group {
                display: block;
                margin-bottom: 20px;
            }

            /*==================== Table ====================*/
            td {
                text-align: center;
            }

            footer {
                text-align: center;
            }
        }
    </style>
</head>

<body>

    {{-- <div id="invoiceholder"> --}}
    {{-- <div id="invoice" class="effect2"> --}}

    <div id="invoice-top">
        <div class="logo"><img src="https://cdn3.iconfinder.com/data/icons/daily-sales/512/Sale-card-address-512.png"
                alt="Logo" /></div>
        <div class="title">
            <h1>MITRA BARITO GROUP</h1>
            <p>Invoice Date: <span id="invoice_date">Desember 2022</span><br>
                Periode: <span id="gl_date">1 November 2022 s/d 30 November 2022</span>
            </p>
        </div>
        <!--End Title-->
    </div>
    <!--End InvoiceTop-->



    <div id="invoice-mid">
        <div class="clearfix">
            
            <div class="col-left">
                <div class="clientinfo">
                    <h2 id="supplier">No SLIP</h2>
                    <h2 id="supplier" style="font-size: 2em">513</h2>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h2 id="supplier">AHMADI</h2>
                    <p>
                        <span id="address">MBLE-0422003</span><br>
                        <span id="city">ETL DEVELOPER</span><br>
                        <span id="country">IT</span> - <span id="zip">12062</span><br>
                        <span id="tax_num">555-555-5555</span><br>
                    </p>
                </div>
            </div>
            <div class="col-right">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><span>No. KPJ </span><label id="invoice_total">1234 1234 341</label></td>
                            <td><span>No BPJS Kes.</span><label id="currency">64352403980239</label></td>
                            <td><span>Status Pajak</span><label id="currency">S/0</label></td>
                        </tr>
                        <tr>
                            <td><span>Gaji Pokok</span><label id="payment_term">Rp. 3.300.300</label></td>
                            <td><span>Insentif</span><label id="invoice_type">Rp. 1.100.000</label></td>
                            <td><span>Tunjangan</span><label id="invoice_type">Rp. 2.000.000</label></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span>Premi MB</span> : <label id="note">22.22</label>
                                <span>, Premi BK</span> : <label id="note">0</label>
                                <span>, Premi RJ</span> : <label id="note">150</label>
                                <span>, Premi Non-RJ</span> : <label id="note">0</label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--End Invoice Mid-->


    <div id="invoice-mid">
        <div class="clearfix">
            <div class="col-left">
                <div class="clientinfo">
                    <h2 id="supplier">Kehadiran</h2>
                    <p>
                        <span id="address">DS</span><br>
                        <span id="address">DL</span><br>
                        <span id="address">PW</span><br>
                        <span id="address">A</span><br>
                        <span id="address">Off</span><br>
                        <span id="address">DS</span><br>
                        <span id="address">DL</span><br>
                        <span id="address">PW</span><br>
                        <span id="address">A</span><br>
                        <span id="address">Off</span><br>
                    </p>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h2 id="supplier">Jumlah</h2>
                    <p>
                        <span id="address">28</span><br>
                        <span id="address">2</span><br>
                        <span id="address">2</span><br>
                        <span id="address">2</span><br>
                        <span id="address">2</span><br>
                        <span id="address">2</span><br>
                        <span id="address">2</span><br>
                        <span id="address">2</span><br>
                        <span id="address">2</span><br>
                        <span id="address">2</span><br>
                    </p>
                </div>
            </div>
        
            <div class="col-right">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><span>Jumlah Dibayar</span><label id="invoice_total">30</label></td>
                            <td><span>Jumlah Potongan</span><label id="currency">2</label></td>
                        </tr>
                        <tr></tr>
                    </tbody>
                </table>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>18.10</span><label id="currency">A</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>18.10</span><label id="currency">A</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                        </tr>
                        <tr>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>18.10</span><label id="currency">A</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>18.10</span><label id="currency">A</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                        </tr>
                        <tr>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>18.10</span><label id="currency">A</label></td>
                            <td><span>01.10</span><label id="invoice_total">DS</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>02.10</span><label id="currency">PW</label></td>
                            <td><span>18.10</span><label id="currency">A</label></td>
                        </tr>
                        <tr>
                            <td>
                                <span>01.10</span><label id="invoice_total">DS</label>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


  


    <div id="invoice-mid">
        <div class="clearfix">
            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">Potongan</h4>
                    <p>
                        <span id="address">BPJS Kesehatan</span><br>
                        <span id="address">BPJS Naker</span><br>
                        <span id="address">BPJS Pensiun</span><br>
                        <span id="address">Pph21</span><br>
                        <span id="address">Alpa</span><br>
                        <span id="address">Izin/Sakit</span><br>
                        <span id="address">Lainnya</span><br>
                    </p>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">-</h4>
                    <p>
                        <span id="address">Rp. 3.200.000</span><br>
                        <span id="city">Rp. 1.100.000</span><br>
                        <span id="city">Rp. 2.30.000</span><br>
                        <span id="address">Rp. 3.200.000</span><br>
                        <span id="city">Rp. 2.30.000</span><br>
                        <span id="city">Rp. 2.30.000</span><br>
                    </p>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">|</h4>
                    
                </div>
            </div>

            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">Gaji Pokok</h4>
                    <p>
                        <span id="address">Gaji Pokok</span><br>
                        <span id="city">Insentif</span><br>
                    </p>
                    <h4 id="supplier">Premi</h4>
                    <p>
                        <span id="address">Non MB</span><br>
                        <span id="city">MB</span><br>
                    </p>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">-</h4>
                    <p>
                        <span id="address">Rp. 3.200.000</span><br>
                        <span id="city">Rp. 1.100.000</span><br>
                    </p>
                    <h4 id="supplier">-</h4>
                    <p>
                        <span id="address">Rp. 3.200.000</span><br>
                        <span id="city">Rp. 2.30.000</span><br>
                    </p>
                </div>
            </div>
           
            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">Hauling</h4>
                    <p>
                        <span id="address">6.700 x Rp. 1.500</span><br>
                    </p>
                    <h4 id="supplier">HM</h4>
                    <p>
                        <span id="address">220 x Rp. 25.000</span><br>
                    </p>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">-</h4>
                    <p>
                        <span id="address">Rp. 10,050.000</span><br>
                    </p>
                    <h4 id="supplier">-</h4>
                    <p>
                        <span id="address">Rp. 5.500.000</span><br>
                    </p>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">Pembayaran</h4>
                    <p>
                        <span id="address">Mobilisasi</span><br>
                    </p>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h4 id="supplier">-</h4>
                    <p>
                        <span id="address">Rp. 7.500.000</span><br>
                    </p>
                </div>
            </div>           
        </div>
    </div>


    <div id="invoice-mid">
        <div class="clearfix">
            <div class="col-left">
                <div class="clientinfo">
                    <h2 id="supplier">AHMADI</h2>
                    <p>
                        <span id="address"><b>Pembayaran</b></span><br>
                        <span id="city"><b>Account No.</b></span><br>
                        <span id="country"><b>Atas Nama</b></span><br>
                        <span id="tax_num"><b>Nominal</b></span><br>
                    </p>
                </div>
            </div>
            <div class="col-left">
                <div class="clientinfo">
                    <h2 id="supplier">-</h2>
                    <p>
                        <label id="address">: BNI</label><br>
                        <label id="city">: 1452911910</label><br>
                        <label id="country">: AHMADI</label><br>
                        <label id="tax_num">: Rp. 4.608.000</label><br>
                    </p>

                  
                </div>
            </div>

            <div class="col-right">
                <table class="table">
                    <thead>    
                        <tr class="tabletitle">
                            <td><label>Gaji Kotor</label></td>
                            <td><label id="payment_term">Rp 50.000.000</label></td>
                            <td>|</td>
                            <td><label>Potongan</label></td>
                            <td><label id="payment_term">Rp. 20.000.000</label></td>
                        </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td><label>Gaji Bersih</label></td>
                            <td><label id="payment_term">Rp. 30.000.000</label></td>
                            <td>|</td>
                            <td><label>Pembulatan </label></td>
                            <td><label id="payment_term">Rp. 0</label></td>
                        </tr>
                      
                        <tr class="list-item total-row">
                            <th colspan="9" class="tableitem"> Lima Juta Lima Ratus Dua Puluh Lima Ribu Rupiah ___ Rp. 5,525,000  </th>
                            {{-- <td data-label="Grand Total" class="tableitem">111.84</td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--End Invoice Mid-->


    

    {{-- </div><!--End Invoice--> --}}
    {{-- </div><!-- End Invoice Holder--> --}}






</body>

</html>
