<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
        }

        body {
            background: linear-gradient(to right, #4a90e2, #9013fe);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.3s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .form-control:focus {
            border-color: #9013fe;
            box-shadow: 0 0 5px rgba(144, 19, 254, 0.5);
        }

        .btn-dark {
            background-color: #9013fe;
            border: none;
        }

        .btn-dark:hover {
            background-color: #4a90e2;
        }

        .text-dark {
            color: #333 !important;
        }

        .input-group-text {
            cursor: pointer;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        footer {
            flex-shrink: 0;
            width: 100%;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            background: rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .card {
                margin: 0 15px;
            }
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="container">
            <h1 class="text-center text-white mb-4">Registrasi Pengguna Baru</h1>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <form action="{{ route('registrasi.submit') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label text-dark">Nama Pengguna</label>
                                    <input type="text" class="form-control" name="name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-dark">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label text-dark">Kata Sandi</label>
                                    <div class="input-group">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                        <span class="input-group-text" id="togglePassword">
                                            <i class="bi bi-eye" id="eyeIcon"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label text-dark">Konfirmasi Kata
                                        Sandi</label>
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" class="form-control"
                                            name="password_confirmation" required>
                                        <span class="input-group-text" id="togglePasswordConfirmation">
                                            <i class="bi bi-eye" id="eyeIconConfirmation"></i>
                                        </span>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-dark btn-lg">Daftar</button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <p class="text-dark">Sudah memiliki akun? <a href="{{ route('login') }}"
                                        class="text-primary"> Masuk di sini</a></p>
                            </div>
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

        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const eyeIconConfirmation = document.getElementById('eyeIconConfirmation');

        togglePasswordConfirmation.addEventListener('click', function() {
            if (passwordConfirmationInput.type === 'password') {
                passwordConfirmationInput.type = 'text';
                eyeIconConfirmation.classList.remove(' bi-eye');
                eyeIconConfirmation.classList.add('bi-eye-slash');
            } else {
                passwordConfirmationInput.type = 'password';
                eyeIconConfirmation.classList.remove('bi-eye-slash');
                eyeIconConfirmation.classList.add('bi-eye');
            }
        });
    </script>
</body>

</html>
