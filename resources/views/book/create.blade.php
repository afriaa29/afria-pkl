<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to right, #6a82fb, #fc5c7d); /* Gradien biru dan merah muda */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .card {
            max-width: 500px;
            margin: auto;
            border-radius: 1rem;
            background-color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
        }

        .text-dark {
            color: #212529 !important;
        }

        .btn-primary {
            background-color: #6a82fb; /* Biru */
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #5a6ee0; /* Biru lebih gelap saat hover */
        }

        .btn-secondary {
            transition: background-color 0.3s;
        }

        .btn-secondary:hover {
            background-color: #B0BEC5; /* Warna abu-abu saat hover */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .illustration {
            position: absolute;
            top: 20%;
            right: 10%;
            opacity: 0.1; /* Mengatur transparansi gambar */
            z-index: -1; /* Memastikan gambar berada di belakang */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h1 class="text-center mb-4 text-dark">Tambah Buku</h1>
            <form action="{{ route('book.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" required>
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahun" name="tahun" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                    <a href="{{ route('book.index') }}" class="btn btn-secondary btn-lg">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1e N7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
