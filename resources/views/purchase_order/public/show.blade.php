@extends('template.admin.main')


@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Purchase Detail</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Purchase Detail
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="product-wrap">
        <div class="product-detail-wrap mb-30">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="product-slider slider-arrow" id="shows">
                        
                    </div>
                    <div class="product-slider-nav" id="slider">
                       
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="product-detail-desc pd-20 card-box height-100-p">
                        <h4 class="mb-20 pt-20">{{$purchase_orders->po_number}}</h4>
                        <p>
                            {{$purchase_orders->description}}
                        </p>
                        <div class="price">Tanggal Update: <ins>{{ \Carbon\Carbon::parse($purchase_orders->updated_a)->toDayDateTimeString()}}</ins></div>
                       
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#po_path"
                                    >Surat PO</a
                                >
                            </div>
                            <div class="col-md-6 col-6">
                                <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#surat_jalan_path"
                                    >Surat Jalan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="surat_jalan_path" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4> 
        </div>
        <div class="modal-body">
          <div style="text-align: center;">
  <iframe src="{{env('APP_URL')}}purchase/pdf/{{$purchase_orders->travel_document_path}}" 
  style="width:100%; height:500px;" frameborder="0"></iframe>
  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div


<!-- Modal -->
<div class="modal fade" id="po_path" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4> 
        </div>
        <div class="modal-body">
          <div style="text-align: center;">
  <iframe src="{{env('APP_URL')}}purchase/pdf/{{$purchase_orders->po_path}}" 
  style="width:100%; height:500px;" frameborder="0"></iframe>
  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('js')
<script>
    jQuery(document).ready(function () {
        function getShow(){
            var galeries = @json($galeries);
            
            galeries.forEach(element => {
                var path = element.galery_path
                console.log(path)
                var shows ="";
                shows = `<div class="product-slide">
                    ${element.galery_path}
                                        <img src="{{env('APP_URL')}}purchase/image/`+path+`" alt="" />
                                    </div>`
                $('#shows').append(shows);
                var slider = "";
                slider = ` <div class="product-slide-nav">
                                    <img src="{{env('APP_URL')}}purchase/image/`+path+`" alt="" />
                                </div>`
                $('#slider').append(slider);
              
            });
            console.log()
        }
        getShow()

        jQuery(".product-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            infinite: true,
            speed: 1000,
            fade: true,
            asNavFor: ".product-slider-nav",
        });
        jQuery(".product-slider-nav").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: ".product-slider",
            dots: false,
            infinite: true,
            arrows: false,
            speed: 1000,
            centerMode: true,
            focusOnSelect: true,
        });
        $("input[name='demo3_22']").TouchSpin({
            initval: 1,
        });
    });
</script>
@endsection