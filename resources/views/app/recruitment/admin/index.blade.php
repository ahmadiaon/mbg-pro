@extends('app.layouts.main')

@section('src_css')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 80px;
            height: 80px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection


@section('content')
    <div class="faq-wrap">
        <h4 class="mb-20 h4 text-blue">Recruitment</h4>
        <div id="accordion">

            <div class="card">
                <div class="card-header">
                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#data-table-manage-absensi">
                        Data Recruitment
                    </button>
                </div>

                <div id="data-table-manage-absensi" class="collapse show" data-parent="#accordion">
                    <div class="">
                        <div class="row pd-20">
                            <div class="col-auto">
                                <h4 class="text-blue h4">Recruitment</h4>
                            </div>
                        </div>
                        <div class="mb-20" id="datatable-data">



                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama <button><i class="icon-copy bi bi-123"></i></button></th>
                                        <th>Jabatan</th>
                                        <th>Kota</th>
                                        <th>Nama <button><i class="icon-copy bi bi-123"></i></button></th>
                                        <th>Jabatan</th>
                                        <th>Kota</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>


    <div id="pdfModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PDF Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="loader" class="loader"></div>
                    <iframe id="pdfViewer" style="display:none;" width="100%" height="500px"></iframe>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="small-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tindak Lanjut Lamaran
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue name"></h5>
                        <ul>
                            <li>
                                <span>Email :</span>
                                <div class="email"></div>
                            </li>
                            <li class="">
                                <span>Phone Number:</span>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="phone_number"> </div>
                                    </div>
                                    <div class="col-4">
                                        <a hidden class="phone_number_wa" target="_blank"
                                            href="https://wa.me/621255897044"><i class="icon-copy bi bi-whatsapp "></i> </a>
                                    </div>
                                </div>

                            </li>
                            <li class="">
                                <span>Alamat:</span>
                                <div class="alamat">ahmadi@mail.com</div>
                            </li>
                            <li>
                                <span>Posisi</span>
                                <h5 class="mb-20 h5 text-blue posisi"></h5>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="id_recruitment" id="id_recruitment">
                </div>
                <div class="modal-footer text-center">
                    <div class="btn-list ">
                        <a class="btn  btn-outline-warning file_cv" href="/file/recruitment/.pdf" target="_blank">
                            <i class="icon-copy bi bi-file-earmark-pdf"></i> CV
                        </a>


                        <button onclick="updateRecruitment('Disimpan')" type="button" class="btn" data-bgcolor="#3b5998"
                            data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);">
                            <i class="icon-copy bi bi-file-earmark-check"></i> Simpan
                        </button>
                        <button type="button" onclick="updateRecruitment('Ditolak')" class="btn" data-bgcolor="#bd081c"
                            data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(189, 8, 28);">
                            <i class="icon-copy bi bi-file-earmark-excel"></i> Tolak
                        </button>
                        <button data-dismiss="modal" type="button" class="btn" data-bgcolor="#00b489"
                            data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);">
                            <i class="icon-copy bi bi-x-lg"></i> close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script_javascript')
    <script>
        //getDataRecruitment
        let data_header = 
            ['Tanggal','Nama','Posisi','Provinsi','Status','Aksi'];

          

        data_header.forEach((header, index) =>{
                        $(`.header-filter`).append(`
                        <h4 class="weight-600 font-18 pb-10">Filter ${header}</h4>
                        <div class="filter-container mb-30">
                            <div class="sidebar-btn-group pb-30">
                            <button type="button" class="btn btn-outline btn-primary select-all" data-col="${index}">Pilih
                                Semua</button>
                            <button type="button" class="btn btn-outline btn-danger deselect-all" data-col="${index}">Hapus
                                Semua</button>
                            </div>
                            <select class="multi-filter" data-col-index="${index}" multiple="multiple"></select>
                        </div>
                        
                        
                        `);
                        console.log("Kolom ke-" + index + ": " + $(header).text());
                    });
        var data;
        var table;
        let data_object_recruitment = {};
        let data_jabatan;

        $.ajax({
            url: '/api/mbg/db/JABATAN',
            type: "GET",
            success: function(response) {
                data_jabatan = response.data.data_tables;
                console.log(data_jabatan);

                // data_jabatan = Object.entries();
            },
            error: function(response) {
                console.log('errr');
            }
        });


        function dataShow(id_data) {
            console.log('id_data');
            console.log(id_data);
            console.log(data_object_recruitment[id_data]);
            let data_detail = data_object_recruitment[id_data];
            $('.name').text(data_detail.full_name);
            $('#id_recruitment').val(data_detail.id);
            $('.email').text(data_detail.email);
            $('.phone_number').text(data_detail.phone_number);
            $('.alamat').text(
                `${data_detail.provinsi}, ${data_detail.kabupaten}, ${data_detail.kecamatan}, ${data_detail.address_description} `
            );
            $('.posisi').text(data_jabatan[data_detail.position]['JABATAN']['value_data']);
            $(".file_cv").attr("href", `/file/recruitment/${data_detail.file}`);
            $(".phone_number_wa").attr("href", `https:wa.me/${data_detail.phone_number}`);
        }

        function updateFilterOptions(exceptIndex) {
            $(".multi-filter").each(function() {
                var columnIndex = $(this).data("col-index");
                var select = $(this);

                if (columnIndex === exceptIndex) return; // Jangan ubah filter yang sedang digunakan

                var selectedValues = select.val() || [];
                select.empty();

                // Ambil data tersaring
                var filteredData = table
                    .column(columnIndex, {
                        search: "applied"
                    })
                    .data()
                    .unique()
                    .sort();

                select.append('<option value="all">[Pilih Semua]</option>');
                filteredData.each(function(d) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                });

                select.val(selectedValues);
            });
        }

        function filterTable() {
            var filters = {};
            var activeIndex = null;

            $(".multi-filter").each(function() {
                var columnIndex = $(this).data("col-index");
                var selectedValues = $(this).val();

                if (selectedValues && selectedValues.includes("all")) {
                    $(this).val($(this).find("option:not([value='all'])").map(function() {
                        return this.value;
                    }).get());
                    selectedValues = $(this).val();
                }

                if (selectedValues && selectedValues.length > 0) {
                    filters[columnIndex] = selectedValues;
                    if (activeIndex === null) {
                        activeIndex = columnIndex;
                    }
                }
            });

            table.columns().every(function(index) {
                if (filters[index] && filters[index].length > 0) {
                    this.search(filters[index].join("|"), true, false).draw();
                } else {
                    this.search("").draw();
                }
            });

            updateFilterOptions(activeIndex);
        }

        function getDataRecruitment() {
            $.ajax({
                url: '/api/recruitment/get',
                type: "POST",
                contentType: false,
                processData: false,
                data: null,
                success: function(response) {
                    console.log('response');
                    console.log(response);
                    let data_array_recruitment = [];
                    Object.values(response.data).forEach(recruitment => {
                        data_array_recruitment.push([recruitment.time_propose, recruitment.full_name,
                        data_jabatan[recruitment.position]['JABATAN']['value_data'], recruitment.provinsi, recruitment.status,
                            recruitment.nik_ktp, recruitment.id
                        ]);

                    });
                    console.log('data_array_recruitment');
                    console.log(data_array_recruitment);
                    data_object_recruitment = response.data;
                    data = data_array_recruitment;
                    table = $('#example').DataTable({
                        dom: 'lrtip',
                        data: data_array_recruitment,
                        columns: [{
                                title: "Tanggal"
                            },
                            {
                                title: "Nama Lengkap"
                            },
                            {
                                title: "Posisi",
                                render: function(data, type, row) {
                                    return `${row[2]}`;
                                }
                            },
                            {
                                title: "Provinsi"
                            },
                            {
                                title: "Status",
                                render: function(data, type, row) {
                                    let color_status = 'outline-secondary'
                                    if (row[4] == 'Disimpan') {
                                        color_status = 'primary';
                                    } else if (row[4] == 'Ditolak') {
                                        color_status = 'danger';
                                    }
                                    return `<button class="btn btn-${color_status} btn-sm" >${row[4]}</button>`;
                                }
                            },
                            {
                                title: "Aksi",
                                render: function(data, type, row) {
                                    return `
                                            
                                                <a href="modal" onclick="dataShow(${row[6]})" data-toggle="modal" data-target="#small-modal" class="edit-avatar">
                                                    <div class="btn btn-sm btn-outline-warning"><i class="icon-copy bi bi-arrow-up-right-square"></i> </div>
                                                </a>
                                           `;
                                }
                            }
                        ],

                        

                        // headerCallback: function(thead, data, start, end, display) {
                        //     var th = $(thead).find("th").eq(0); // Kolom pertama (Names)
                        //     th.html(
                        //         `<button class="btn btn-sm btn-warning" onclick="handleClick(event)"><i class="icon-copy bi bi-funnel-fill"></i></button> Names`
                        //     );
                        // }
                    });
                    console.log('abs');
                    console.log(table.columns().header());
                    updateFilterOptions(null);

                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    </script>


    <script>
        function updateRecruitment(val_status) {
            // $('#loading-modal').modal('show');
            $.ajax({
                url: '/api/recruitment/store',
                type: "POST",
                data: {
                    id_lamaran: $(`#id_recruitment`).val(),
                    val_lamaran: val_status
                },
                success: function(response) {
                    console.log('response');
                    console.log(response);
                    stopLoading()
                },
                error: function(response) {
                    console.log(response);
                }
            });
            stopLoading();
        }

        function handleClick(event) {
            event.stopPropagation(); // Mencegah sorting saat tombol diklik
            alert("Tombol di header Names diklik!");
        }

        $(document).ready(function() {
            // var table = $('#example').DataTable({
            //     dom: 'lrtip', // Sembunyikan default search box DataTables
            // });

            getDataRecruitment();













            // Inisialisasi Select2 untuk dropdown filter
            $(".multi-filter").select2({
                placeholder: "Pilih...",
                width: "100%",
                allowClear: true,
                closeOnSelect: false
            });

            // Event: Pilih Semua
            $(document).on("click", ".select-all", function() {
                var colIndex = $(this).data("col");
                var select = $(".multi-filter[data-col-index='" + colIndex + "']");

                select.val(select.find("option:not([value='all'])").map(function() {
                    return this.value;
                }).get()).trigger("change");
            });

            // Event: Hapus Semua
            $(document).on("click", ".deselect-all", function() {
                var colIndex = $(this).data("col");
                $(".multi-filter[data-col-index='" + colIndex + "']").val([]).trigger("change");
            });

            // Event filter
            $(".multi-filter").on("change", filterTable);

            // Isi filter awal berdasarkan semua data

        });
    </script>
@endsection
