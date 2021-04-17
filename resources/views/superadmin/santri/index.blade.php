@extends('adminlte::page')

@section('title', 'Santri')

@section('content_header')
    {{-- <h1>Data santri</h1> --}}
@stop

@section('content')
    @include('tools.flash-swal')
    {{-- {{csrf_token()}} --}}
    <div class="row">
        <div class="col-md-12 text-right mb-5">
            <a class="btn btn-success" href="javascript:void(0)" id="createNew" data-target="#ajaxModel">Tambah Santri</a>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Santri</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="card-body table-responsive no-padding">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Tahun Masuk</th>
                                <th>Status</th>
                                <th>Saldo</th>
                                <th>Madrasah</th>
                                <th>Ribath</th>
                                <th width="280px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="santriForm" name="santriForm" class="form-horizontal">
                        {{-- <div class="form-group">
                            <div class="col-sm-12">
                                <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
                            </div>
                        </div> --}}

                        <input type="hidden" name="santri_id" id="santri_id">
                        <input type="hidden" name="nisn" id="nisn">

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama santri"
                                    value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-12 control-label">Tahun Masuk</label>
                            <div class="col-sm-12">
                                <select name="tahun_masuk" class="form-control year" id="year" style="width: 100%;">
                                    <option value="">--Pilih Tahun--</option>
                                    <?php for ($year = date('Y'); $year >= 2000; $year--) { ?>
                                    <option value="<?= $year ?>"><?= $year ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Madrasah</label>
                            <div class="col-sm-12">
                                {{-- <input type="hidden" value="{{ $list_opd->id }}" name="id_opd" class="form-control">
                                <input type="text" value="{{ $list_opd->nama_opd }}" name="" class="form-control" disabled> --}}
                                <select class="form-control list-madrasah" id="list-madrasah" name="id_madrasah" style="width: 100%;" required>
                                    <option value="-1">--Pilih Madrasah--</option>
                                    @foreach ($list_madrasah as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Ribath</label>
                            <div class="col-sm-12">
                                {{-- <input type="hidden" value="{{ $list_opd->id }}" name="id_opd" class="form-control">
                                <input type="text" value="{{ $list_opd->nama_opd }}" name="" class="form-control" disabled> --}}
                                <select class="form-control list-ribath" id="list-ribath" name="id_ribath" style="width: 100%;" required>
                                    <option value="-1">--Pilih Ribath--</option>
                                    @foreach ($list_ribath as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtnEdit" value="create">Save
                                changes</button>
                            <button type="submit" class="btn btn-primary" id="saveBtnNew" value="create">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    {{-- <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'> --}}

    <link rel='stylesheet' href='{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}'>

@stop

@section('js')

    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"> </script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"> </script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"> </script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> --}}

    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#minPassText').hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                serverSide: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                dom: '<"html5buttons">Blfrtip',
                buttons: [{
                        extend: 'excel',
                        title: 'Data Santri'
                    },
                    {
                        extend: 'print',
                        title: 'Data Santri'
                    },
                ],
                ajax: "{{ route('santri.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nisn',
                        name: 'nisn'
                    },
                    {
                        data: 'tahun_masuk',
                        name: 'tahun_masuk'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'saldo',
                        name: 'saldo'
                    },
                    {
                        data: 'nama_madrasah',
                        name: 'nama_madrasah'
                    },
                    {
                        data: 'nama_ribath',
                        name: 'nama_ribath'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#createNew').click(function() {
                $('#saveBtn').val("create-santri");
                $('#santri_id').val('');
                $('#ketPass').hide();
                $("#role").prop('disabled', false);
                $('#saveBtnNew').show();
                $('#saveBtnEdit').hide();
                $('#year').val('').change();
                $('#list-madrasah').val('').change();
                $('#list-ribath').val('').change();
                $('#santriForm').trigger("reset");

                $('#saveBtnNew').prop('disabled', false);
                $('#minPassText').hide();

                $('#modelHeading').html("Tambah Santri Baru");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editsantri', function() {
                $('#year').val('').change();
                $('#list-madrasah').val('').change();
                $('#list-ribath').val('').change();
                $('#santriForm').trigger("reset");
                $('#saveBtnEdit').prop('disabled', false);
                $('#minPassText').hide();
                var santri_id = $(this).data('id');
                $.get("{{ route('santri.index') }}" + '/' + santri_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Santri");
                    $('#saveBtn').val("edit-santri");
                    $('#ajaxModel').modal('show');
                    $('#santri_id').val(data.id);
                    $('#nisn').val(data.nisn);
                    $('#nama').val(data.nama);
                    $('#year').val(data.tahun_masuk).change();
                    $('#list-madrasah').val(data.id_madrasah).change();
                    $('#list-ribath').val(data.id_ribath).change();
                    
                    $('#saveBtnNew').hide();
                    $('#saveBtnEdit').show();
                })
            });


            $('#saveBtnNew').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#santriForm').serialize(),
                    url: "{{ route('santri.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#santriForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        Swal.fire("Sukses", "Data berhasil disimpan", "success");
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        Swal.fire("Oops...", "Data gagal disimpan!", "error")
                        $('#saveBtn').html('Save Changes');
                    }
                });
                $(this).html('Simpan');
            });

            $('#saveBtnEdit').click(function(e) {
                var santri_id = $(this).data("id");
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#santriForm').serialize(),
                    url: "{{ route('santri.index') }}" + '/' + $('#santri_id').val(),
                    type: "PUT",
                    dataType: 'json',
                    success: function(data) {
                        $('#santriForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        Swal.fire("Sukses", "Data berhasil disimpan", "success");
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                        Swal.fire("Oops...", "Data gagal disimpan!", "error")
                    }
                });
                $(this).html('Simpan');
            });


            $('body').on('click', '.deletesantri', function() {
                var santri_id = $(this).data("id");
                var name = $(this).data("name");

                Swal.fire({
                    title: 'Yakin ingin Menghapus data ?',
                    text: "Data Santri " + name + " tidak bisa di pulihkan jika telah dihapus",
                    // type: 'question',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal!',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('santri.index') }}" + '/' + santri_id,
                            success: function(data) {
                                table.draw();
                                swal("Sukses", "Data berhasil dihapus.", "success");
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                Swal.fire("Oops...", "Data gagal dihapus!", "error")
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });

            $('input[name="telepon"]').keyup(function(e) {
                if (/\D/g.test(this.value)) {
                    this.value = this.value.replace(/\D/g, '');
                }
            });
        });

    </script>

    <script>
        $('#santriForm').validate();
        $('#year').select2();
        $('#list-madrasah').select2();
        $('#list-ribath').select2();

        function showhidePass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </script>

@stop
