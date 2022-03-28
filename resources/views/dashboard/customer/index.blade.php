@extends('layouts.dashboard')
@section('title')
    <title>Customer</title>
@endsection
@push('after-style')
    <style>
        textarea {
            min-height: 100px !important;
        }

    </style>
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Customer</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Customer</div>
                </div>
            </div>

            <div class="section-body">

                <div class="mt-3 mb-3">
                    <button type="button" id="add-data" class="btn btn-primary">Tambah Data</button>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Customer</h4>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('sortir.customer') }}" method="get">
                                    <button type="submit" class="btn btn-primary">Sortir Nama</button>
                                </form>
                                <div class="float-right mb-4">
                                    <form action="{{ route('search.customer') }}" method="get">
                                        <div class="d-flex flex-row">
                                            <div class="mr-2">
                                                <input type="text" name="search" value="" class="form-control" id="">
                                            </div>
                                            <div class="mr-2">
                                                <input type="date" name="start_date" value="" class="form-control" id="">
                                            </div>
                                            <div class="mr-2">
                                                <input type="date" name="end_date" value="" class="form-control" id="">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cari Customer</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal Registrasi</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">No HP</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $item)
                                                <tr>
                                                    <td>{{ ($customers->currentpage() - 1) * $customers->perpage() + $loop->index + 1 }}
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->no_hp }}</td>
                                                    <td>{{ substr($item->alamat, 0, 20) }}....</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info"
                                                            data-target="#ajax-show-{{ $item->id }}"
                                                            data-toggle="modal">Detail</a>
                                                        <a href="javascript:void(0)" class="btn btn-primary edit"
                                                            data-id="{{ $item->id }}">Edit</a>
                                                        <a href="javascript:void(0)" class="btn btn-danger delete"
                                                            data-id="{{ $item->id }}">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                {{ $customers->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="ajax-create" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajax-model-customer"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)" id="addEditCustomer" name="addEditCustomer" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="">NO Hp</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-save" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($customers as $c)
        <div class="modal fade" id="ajax-show-{{ $c->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $c->nama }}</td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td>{{ $c->no_hp }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $c->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('after-script')
    <script type="text/javascript">
        $(document).ready(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#add-data').click(function() {
                $('#addEditCustomer').trigger("reset");
                $('#ajax-model-customer').html("Tambah Customer");
                $('#ajax-create').modal('show')
            });

            // ajax edit data
            $('body').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ url('edit-customer') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#ajax-model-customer').html('Edit Customer');
                        $('#ajax-create').modal('show');
                        $('#id').val(res.id);
                        $('#nama').val(res.nama);
                        $('#no_hp').val(res.no_hp);
                        $('#alamat').val(res.alamat);
                    }
                });
            });

            // ajax untuk membuat data baru
            $('body').on('click', '#btn-save', function(event) {
                var id = $("#id").val();
                var nama = $("#nama").val();
                var alamat = $("#alamat").val();
                var no_hp = $("#no_hp").val();
                $("#btn-save").html('Mohon tunggu...');
                $("#btn-save").attr("disabled", true);

                $.ajax({
                    type: "POST",
                    url: "{{ url('add-customer') }}",
                    data: {
                        id: id,
                        nama: nama,
                        no_hp: no_hp,
                        alamat: alamat,
                    },
                    dataType: 'json',
                    success: function(res) {
                        window.location.reload();
                        $("#btn-save").html('Submit');
                        $("#btn-save").attr("disabled", false);
                    }
                });
            });

            // ajax untuk menghapus data
            $('body').on('click', '.delete', function() {
                if (confirm('YAKIN UNTUK MENGHAPUS INI?') == true) {
                    var id = $(this).data('id');

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('delete-customer') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            window.location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
