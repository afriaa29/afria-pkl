<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f0f0f0;
        }

        .navbar {
            background-color: #343a40;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin: 20px 0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 8px 12px;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_length select {
            margin-left: 5px;
            margin-right: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 5px;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* Tambahan style untuk Select2 */
        .select2-container {
            min-width: 200px;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
        }
    </style>
</head>

<body>
    @include('book.modal-create')

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Perpustakaan</a>
            <span class="navbar-text text-white me-auto">Halo {{ session('username') }}, kamu telah berhasil login</span>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <div class="d-flex">
                    <button class="btn btn-success" id="tambah-data">Tambah</button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger ms-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="table-responsive">
            <div class="mb-3 d-flex justify-content-between">
                <div class="form-group">
                    <label for="filter_penulis">Penulis:</label>
                    <select id="filter_penulis" class="form-control" multiple>
                        @foreach($penulis as $p)
                            <option value="{{ $p }}">{{ $p }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="filter_tahun">Tahun:</label>
                    <select id="filter_tahun" class="form-control" multiple>
                        @foreach($tahun as $t)
                            <option value="{{ $t }}">{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button id="reset_filter" class="btn btn-secondary mt-4">Reset Filter</button>
                </div>
            </div>

            <table id="tableData" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            @include('book.modal-edit')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#filter_penulis, #filter_tahun').select2({
                placeholder: "Pilih opsi",
                allowClear: true
            });

            // Inisialisasi DataTable
            var table = $('#tableData').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("book.index") }}',
                    data: function(d) {
                        d.penulis = $('#filter_penulis').val();
                        d.tahun = $('#filter_tahun').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'penulis',
                        name: 'penulis'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Reset filter
            $('#reset_filter').click(function() {
                $('#filter_penulis').val('').trigger('change');
                $('#filter_tahun').val('').trigger('change');
                table.draw();
            });

            // Apply filter when selection changes
            $('#filter_penulis, #filter_tahun').change(function() {
                table.draw();
            });

            // Modal handlers
            $("#tambah-data").on('click', function() {
                $("#modal-create").modal('show');
                $(".modal-body").show();
            });

            // AJAX setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Edit button handler
            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');
                let judul = $(this).data('judul');
                let penulis = $(this).data('penulis');
                let tahun = $(this).data('tahun');

                $('#modalUbah #judul').val(judul);
                $('#modalUbah #penulis').val(penulis);
                $('#modalUbah #tahun').val(tahun);
                $('#modalUbah #id').val(id);

                $("#modal-edit").modal('show');

            });

            $('#formUbah').submit(function(e) {
        e.preventDefault();
        var id = $('#modalUbah #id').val();
        var formData = $(this).serialize();

        $.ajax({
            url: '/book/' + id,
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#modal-edit').modal('hide');
                table.ajax.reload();
                // Tambahkan notifikasi sukses jika diperlukan
            },
            error: function(xhr) {
                // Handle error
                console.log(xhr.responseText);
                // Tambahkan notifikasi error jika diperlukan
            }
        });
    });


        });

    </script>
</body>

</html>
