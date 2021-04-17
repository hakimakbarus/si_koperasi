@extends('adminlte::page')

@section('title', 'Madrasah')

@section('content_header')
    {{-- <h1>Data madrasah</h1> --}}
@stop

@section('content')
    @include('tools.flash-swal')
    {{-- {{csrf_token()}} --}}
    <div class="row">
        <div class="col-md-12 text-right mb-5">
            <a class="btn btn-success" href="javascript:void(0)" id="createNew" data-target="#ajaxModel">Tambah Madrasah</a>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Madrasah</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="card-body table-responsive no-padding">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kepala</th>
                                <th>TTD</th>
                                <th>Stempel</th>
                                <th>NIP</th>
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
                    <form id="madrasahForm" name="madrasahForm" class="form-horizontal">
                        {{-- <div class="form-group">
                            <div class="col-sm-12">
                                <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
                            </div>
                        </div> --}}

                        <input type="hidden" name="madrasah_id" id="madrasah_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"
                                    value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kepala</label>
                            <div class="col-sm-12">
                                {{-- <textarea id="detail" name="email" required="" placeholder="Enter Details" class="form-control"></textarea> --}}
                                {{-- <input type="email" class="form-control validate" id="email" name="email" placeholder="Masukkan Email" maxlength="50" required=""> --}}
                                <input type="text" class="form-control" id="kepala" name="kepala"
                                    placeholder="Masukkan Kepala Madrasah" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-5 control-label">TTD</label>
                                <input type="text" name="ttd" id="ttd" class="form-control" value=""
                                    placeholder="Masukkan TTD">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-5 control-label">Stempel</label>
                                <input type="text" name="stempel" id="stempel" class="form-control" value=""
                                    placeholder="Masukkan Stempel">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-5 control-label">NIP</label>
                                <input type="text" name="nip" id="nip" class="form-control" value=""
                                    placeholder="Masukkan NIP">
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
                        title: 'Data Madrasah'
                    },
                    {
                        extend: 'print',
                        title: 'Data Madrasah'
                    },
                ],
                ajax: "{{ route('madrasah.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'kepala',
                        name: 'kepala'
                    },
                    {
                        data: 'ttd',
                        name: 'ttd'
                    },
                    {
                        data: 'stempel',
                        name: 'stempel'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });



            $("#password").keyup(function() {
                if ($(this).val().length > 0 && $(this).val().length < 8) {
                    $('#saveBtnNew').prop('disabled', 'disabled');
                    $('#saveBtnEdit').prop('disabled', 'disabled');
                    $('#minPassText').show();
                } else {
                    $('#saveBtnNew').prop('disabled', false);
                    $('#saveBtnEdit').prop('disabled', false);
                    $('#minPassText').hide();
                }
            });


            // $('#madrasahForm').onsubmit(function() {

            // });

            // $('#madrasahForm').onsubmit(function() {
            //     if($("#password").val().length > 0 &&  $("#password").val().length < 7) {
            //         Swal.fire('Error', 'Password Harus 8 karakter atau lebih!', 'error');
            //     } else {
            //         $(this).submit();
            //     }
            // });
            // jQuery.noConflict();

            $('#createNew').click(function() {
                $('#saveBtn').val("create-madrasah");
                $('#madrasah_id').val('');
                $('#ketPass').hide();
                $("#role").prop('disabled', false);
                $('#saveBtnNew').show();
                $('#saveBtnEdit').hide();
                $('#madrasahForm').trigger("reset");

                $('#saveBtnNew').prop('disabled', false);
                $('#minPassText').hide();

                $('#modelHeading').html("Tambah Madrasah Baru");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editMadrasah', function() {
                $('#madrasahForm').trigger("reset");
                $('#saveBtnEdit').prop('disabled', false);
                $('#minPassText').hide();
                var madrasah_id = $(this).data('id');
                $.get("{{ route('madrasah.index') }}" + '/' + madrasah_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit madrasah");
                    $('#saveBtn').val("edit-madrasah");
                    $('#ajaxModel').modal('show');
                    $('#madrasah_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#kepala').val(data.kepala);
                    $('#ttd').val(data.telepon);
                    $('#stempel').val(data.alamat);
                    $('#nip').val(data.nip);
                    
                    $('#saveBtnNew').hide();
                    $('#saveBtnEdit').show();
                })
            });


            $('#saveBtnNew').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#madrasahForm').serialize(),
                    url: "{{ route('madrasah.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#madrasahForm').trigger("reset");
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
                var madrasah_id = $(this).data("id");
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#madrasahForm').serialize(),
                    url: "{{ route('madrasah.index') }}" + '/' + $('#madrasah_id').val(),
                    type: "PUT",
                    dataType: 'json',
                    success: function(data) {
                        $('#madrasahForm').trigger("reset");
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


            $('body').on('click', '.deleteMadrasah', function() {
                var madrasah_id = $(this).data("id");
                var name = $(this).data("name");

                Swal.fire({
                    title: 'Yakin ingin Menghapus data ?',
                    text: "Data madrasah " + name + " tidak bisa di pulihkan jika telah dihapus",
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
                            url: "{{ route('madrasah.index') }}" + '/' + madrasah_id,
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
        $('#madrasahForm').validate();
        $('#jenis_kelamin').select2();
        $('#role').select2();

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
