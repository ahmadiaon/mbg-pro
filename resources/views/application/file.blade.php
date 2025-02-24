@extends('app.layouts.main')


@section('content')
    {{-- 1. HEADER --}}
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>FILE MANAGER</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        {{-- <li class="breadcrumb-item active" aria-current="page">
                            Manage Form
                        </li> --}}
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    {{-- 2. FOLDERS --}}

    <div class="row pb-10">
        <div class="col-12 mb-20">
            <div class="btn-list">
                <button type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                    <i class="icon-copy bi bi-folder-plus"></i> folder baru
                </button>
                <button type="button" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);">
                    <i class="icon-copy bi bi-upload"></i> upload
                </button>
{{--                 
                <button type="button" class="btn" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);">
                    <i class="fa fa-linkedin"></i> linkedin
                </button>
                <button type="button" class="btn" data-bgcolor="#f46f30" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);">
                    <i class="fa fa-instagram"></i> instagram
                </button>
                <button type="button" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(195, 35, 97);">
                    <i class="fa fa-dribbble"></i> dribbble
                </button>
                <button type="button" class="btn" data-bgcolor="#3d464d" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(61, 70, 77);">
                    <i class="fa fa-dropbox"></i> dropbox
                </button>
                <button type="button" class="btn" data-bgcolor="#db4437" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(219, 68, 55);">
                    <i class="fa fa-google-plus"></i> google-plus
                </button>
                <button type="button" class="btn" data-bgcolor="#bd081c" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(189, 8, 28);">
                    <i class="fa fa-pinterest-p"></i> pinterest
                </button>
                <button type="button" class="btn" data-bgcolor="#00aff0" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 175, 240);">
                    <i class="fa fa-skype"></i> skype
                </button>
                <button type="button" class="btn" data-bgcolor="#00b489" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);">
                    <i class="fa fa-vine"></i> vine
                </button> --}}
            </div>
        </div>
        <div class="col-12">
            <div class="search-icon-box bg-white box-shadow border-radius-10 mb-30">
                <input type="text" class="border-radius-10" id="filter_input" placeholder="Search file..." title="Type in a name">
                <i class="search_icon dw dw-search"></i>
            </div>        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">75</div>
                        <div class="font-14 text-secondary weight-500">
                            AKTA
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                            <i class="icon-copy bi bi-three-dots-vertical"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">124,551</div>
                        <div class="font-14 text-secondary weight-500">
                            HSE
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                            <i class="icon-copy bi bi-three-dots-vertical"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">400+</div>
                        <div class="font-14 text-secondary weight-500">
                            HRGA
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon">
                            <i class="icon-copy bi bi-three-dots-vertical"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">$50,000</div>
                        <div class="font-14 text-secondary weight-500">Earning</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);">
                            <i class="icon-copy bi bi-three-dots-vertical"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Data Table with Checckbox select</h4>
        </div>
        <div class="pb-20">
            <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="DataTables_Table_3_length"><label>Show <select name="DataTables_Table_3_length" aria-controls="DataTables_Table_3" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="DataTables_Table_3_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="Search" aria-controls="DataTables_Table_3"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="checkbox-datatable table nowrap dataTable no-footer dtr-inline collapsed" id="DataTables_Table_3" role="grid" aria-describedby="DataTables_Table_3_info">
                <thead>
                    <tr role="row"><th class="dt-body-center sorting_disabled" rowspan="1" colspan="1" aria-label="
                            
                                
                                
                            
                        ">
                            <div class="dt-checkbox">
                                <input type="checkbox" name="select_all" value="1" id="example-select-all">
                                <span class="dt-checkbox-label"></span>
                            </div>
                        </th><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="display: none;">Position</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="display: none;">Office</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="display: none;">Start date</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_3" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="display: none;">Salary</th></tr>
                </thead>
                <tbody>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                <tr role="row" class="odd">
                        <td class=" dt-body-center" tabindex="0" style=""><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Angelica Ramos</td>
                        <td style="display: none;">Chief Executive Officer (CEO)</td>
                        <td style="display: none;">London</td>
                        <td style="display: none;">2009/10/09</td>
                        <td style="display: none;">$1,200,000</td>
                    </tr><tr role="row" class="even">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Ashton Cox</td>
                        <td style="display: none;">Junior Technical Author</td>
                        <td style="display: none;">San Francisco</td>
                        <td style="display: none;">2009/01/12</td>
                        <td style="display: none;">$86,000</td>
                    </tr><tr role="row" class="odd">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Bradley Greer</td>
                        <td style="display: none;">Software Engineer</td>
                        <td style="display: none;">London</td>
                        <td style="display: none;">2012/10/13</td>
                        <td style="display: none;">$132,000</td>
                    </tr><tr role="row" class="even">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Brenden Wagner</td>
                        <td style="display: none;">Software Engineer</td>
                        <td style="display: none;">San Francisco</td>
                        <td style="display: none;">2011/06/07</td>
                        <td style="display: none;">$206,850</td>
                    </tr><tr role="row" class="odd">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Caesar Vance</td>
                        <td style="display: none;">Pre-Sales Support</td>
                        <td style="display: none;">New York</td>
                        <td style="display: none;">2011/12/12</td>
                        <td style="display: none;">$106,450</td>
                    </tr><tr role="row" class="even">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Cedric Kelly</td>
                        <td style="display: none;">Senior Javascript Developer</td>
                        <td style="display: none;">Edinburgh</td>
                        <td style="display: none;">2012/03/29</td>
                        <td style="display: none;">$433,060</td>
                    </tr><tr role="row" class="odd">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Dai Rios</td>
                        <td style="display: none;">Personnel Lead</td>
                        <td style="display: none;">Edinburgh</td>
                        <td style="display: none;">2012/09/26</td>
                        <td style="display: none;">$217,500</td>
                    </tr><tr role="row" class="even">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Doris Wilder</td>
                        <td style="display: none;">Sales Assistant</td>
                        <td style="display: none;">Sidney</td>
                        <td style="display: none;">2010/09/20</td>
                        <td style="display: none;">$85,600</td>
                    </tr><tr role="row" class="odd">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Fiona Green</td>
                        <td style="display: none;">Chief Operating Officer (COO)</td>
                        <td style="display: none;">San Francisco</td>
                        <td style="display: none;">2010/03/11</td>
                        <td style="display: none;">$850,000</td>
                    </tr><tr role="row" class="even">
                        <td class=" dt-body-center" tabindex="0"><div class="dt-checkbox"><input type="checkbox" name="id[]" value=""><span class="dt-checkbox-label"></span></div></td>
                        <td class="sorting_1">Gavin Cortez</td>
                        <td style="display: none;">Team Leader</td>
                        <td style="display: none;">San Francisco</td>
                        <td style="display: none;">2008/10/26</td>
                        <td style="display: none;">$235,500</td>
                    </tr></tbody>
            </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="DataTables_Table_3_info" role="status" aria-live="polite">1-10 of 14 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_3_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_3_previous"><a href="#" aria-controls="DataTables_Table_3" data-dt-idx="0" tabindex="0" class="page-link"><i class="ion-chevron-left"></i></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_3" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_3" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="DataTables_Table_3_next"><a href="#" aria-controls="DataTables_Table_3" data-dt-idx="3" tabindex="0" class="page-link"><i class="ion-chevron-right"></i></a></li></ul></div></div></div></div>
        </div>
    </div>
@endsection()
