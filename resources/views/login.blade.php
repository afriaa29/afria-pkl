<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(to right, #4a90e2, #9013fe);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.3s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.05);
        }

        .form-control:focus {
            border-color: #9013fe;
            box-shadow: 0 0 5px rgba(144, 19, 254, 0.5);
        }

        .btn-primary {
            background-color: #9013fe;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4a90e2;
        }

        .text-dark {
            color: #333 !important;
        }

        .illustration {
            position: absolute;
            top: 20%;
            right: 10%;
            opacity: 0.1;
            z-index: -1;
        }

        .input-group-text {
            cursor: pointer;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            background: rgba(0, 0, 0, 0.1);
        }

        /* Menambahkan margin bottom pada container untuk menghindari konten tertutup footer */
        .container {
            margin-bottom:
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center mb-4 text-dark">Login Pengguna</h1>
                        @if ($errors->has('login'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first('login') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('login.submit') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label text-dark">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-dark">Kata Sandi</label>
                                <div class="input-group">
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required>
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary w-100">Masuk</button>
                            </div>
                        </form>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="text-center mt-3">
                            <p class="text-dark">Belum memiliki akun? <a href="{{ route('registrasi.tampil') }}"
                                    class="text-primary">Daftar di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p class="mb-0">Perpustakaan Digital &copy; 2024 Afria 😁</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        });
    </script>
</body>

</html>
