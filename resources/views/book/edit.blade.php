<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
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
            max-width: 600px;
            margin: auto;
            border-radius: 1rem;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        h1 {
            color: #333;
        }

        .btn {
            padding: 10px 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary {
            background-color: #6a82fb; /* Warna biru */
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a6ee0; /* Biru lebih gelap saat hover */
            transform: translateY(-2px); /* Efek angkat saat hover */
        }

        .btn-secondary {
            background-color: #ccc; /* Warna abu-abu */
            border: none;
        }

        .btn-secondary:hover {
            background-color: #b0b0b0; /* Warna abu-abu lebih gelap saat hover */
            transform: translateY(-2px); /* Efek angkat saat hover */
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
    <img src="https://via.placeholder.com/400" alt="Ilustrasi Buku" class="illustration"> <!-- Gambar ilustrasi -->
    <div class="container mt-5">
        <div class="card">
            <h1 class="text-center mb-4">Edit Buku</h1>
            <form action="{{ route('book.update', $book->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" value="{{ $book->judul }}" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" value="{{ $book->penulis }}" name="penulis" required>
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahun" value="{{ $book->tahun }}" name="tahun" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('book.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
