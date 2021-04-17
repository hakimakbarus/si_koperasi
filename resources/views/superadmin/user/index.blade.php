@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    {{-- <h1>Data User</h1> --}}
@stop

@section('content')
    @include('tools.flash-swal')
    {{-- {{csrf_token()}} --}}
    <div class="row">
        <div class="col-md-12 text-right mb-5">
            <a class="btn btn-success" href="javascript:void(0)" id="createNew" data-target="#ajaxModel">Tambah User</a>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data User</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="card-body table-responsive no-padding">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Gender</th>
                                <th>Role</th>
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
                    <form id="userForm" name="userForm" class="form-horizontal">
                        {{-- <div class="form-group">
                            <div class="col-sm-12">
                                <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
                            </div>
                        </div> --}}

                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama"
                                    value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                {{-- <textarea id="detail" name="email" required="" placeholder="Enter Details" class="form-control"></textarea> --}}
                                {{-- <input type="email" class="form-control validate" id="email" name="email" placeholder="Masukkan Email" maxlength="50" required=""> --}}
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-5 control-label">No. Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control" value=""
                                    placeholder="Masukkan No. Telepon">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Password" value="" required="">
                                <div class="col-sm-12">
                                    <small><input type="checkbox" class="form-checkbox" onclick="showhidePass()"> Show
                                        password</small>
                                </div>
                                <div class="col-sm-12">
                                    <small class="text-red" id="minPassText">*Password minimal 8 karakter</small></dd>
                                </div>
                                <div class="col-sm-12">
                                    <small id="ketPass" class="text-red">Kosongi jika tidak ingin mengubah password.</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12 control-label">Jenis Kelamin</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" style="width: 100%;">
                                    <option>--Pilih Jenis Kelamin--</option>
                                    <option value="L">Laki - Laki</option>
                                    {{-- <option value="merchant">Merchant</option> --}}
                                    {{-- <option value="wali santri">Wali Santri</option> --}}
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="role" id="role" style="width: 100%;">
                                    <option>--Pilih Role--</option>
                                    <option value="admin">Admin</option>
                                    {{-- <option value="merchant">Merchant</option> --}}
                                    {{-- <option value="wali santri">Wali Santri</option> --}}
                                    <option value="bendahara">Bendahara</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" id="alamat"></textarea>
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
        $('#delete-user').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('action');
            swal({
                title: 'Apakah Anda yakin ingin menghapus User ini ?',
                icon: 'warning',
                buttons: ["Kembali", "Hapus!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

    </script>

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
                        title: 'Data User'
                    },
                    {
                        extend: 'print',
                        title: 'Data User'
                    },
                ],
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'role',
                        name: 'role'
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


            // $('#userForm').onsubmit(function() {

            // });

            // $('#userForm').onsubmit(function() {
            //     if($("#password").val().length > 0 &&  $("#password").val().length < 7) {
            //         Swal.fire('Error', 'Password Harus 8 karakter atau lebih!', 'error');
            //     } else {
            //         $(this).submit();
            //     }
            // });
            // jQuery.noConflict();

            $('#createNew').click(function() {
                $('#saveBtn').val("create-user");
                $('#user_id').val('');
                $('#ketPass').hide();
                $("#role").prop('disabled', false);
                $('#saveBtnNew').show();
                $('#saveBtnEdit').hide();
                $('#jenis_kelamin').val(null).change();
                $('#role').val(null).change();
                $('#userForm').trigger("reset");

                $('#saveBtnNew').prop('disabled', false);
                $('#minPassText').hide();

                $('#modelHeading').html("Tambah User Baru");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editUser', function() {
                $('#jenis_kelamin').val(null).change();
                $('#role').val(null).change();
                $('#userForm').trigger("reset");
                $('#saveBtnEdit').prop('disabled', false);
                $('#minPassText').hide();
                var user_id = $(this).data('id');
                $.get("{{ route('user.index') }}" + '/' + user_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit User");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#user_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#telepon').val(data.telepon);
                    $('#alamat').val(data.alamat);
                    $('#password').attr('placeholder', 'Password Baru');
                    $('#password').attr('required', 'false');
                    $('#ketPass').show();
                    $("#jenis_kelamin").val(data.jenis_kelamin).change();
                    $("#role").val(data.role).change();
                    $("#role").prop('disabled', 'disabled');
                    // if (data.role === 'superadmin') {
                    //     $("#role").prop('disabled', 'disabled');
                    // } else {
                    //     $("#role").prop('disabled', false);
                    // }
                    $('#saveBtnNew').hide();
                    $('#saveBtnEdit').show();
                })
            });


            $('#saveBtnNew').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "{{ route('user.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#userForm').trigger("reset");
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
                var user_id = $(this).data("id");
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "{{ route('user.index') }}" + '/' + $('#user_id').val(),
                    type: "PUT",
                    dataType: 'json',
                    success: function(data) {
                        $('#userForm').trigger("reset");
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


            $('body').on('click', '.deleteUser', function() {
                var user_id = $(this).data("id");
                var name = $(this).data("name");

                Swal.fire({
                    title: 'Yakin ingin Menghapus data ?',
                    text: "Data user " + name + " tidak bisa di pulihkan jika telah dihapus",
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
                            url: "{{ route('user.index') }}" + '/' + user_id,
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
        $('#userForm').validate();
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
