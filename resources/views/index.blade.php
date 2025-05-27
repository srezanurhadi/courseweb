<!DOCTYPE html>
<html lang="en"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Dosen</title> <x-headcomponent></x-headcomponent>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5; /* Warna latar belakang halaman keseluruhan */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container-wrapper { /* Tambahkan wrapper jika <x-sidebar> dan konten lain tetap ada di halaman yang sama di luar login */
            /* Jika login ini adalah halaman penuh, wrapper ini mungkin tidak perlu
               dan styling body di atas sudah cukup. Namun, jika ini bagian dari layout lebih besar,
               Anda mungkin perlu menyesuaikan. Untuk saat ini, kita anggap ini halaman login utama. */
        }

        .login-container {
            display: flex;
            width: 900px; /* Anda bisa sesuaikan atau gunakan persentase, misal 80vw */
            max-width: 95%; /* Agar responsif di layar kecil */
            height: 600px; /* Anda bisa sesuaikan atau gunakan vh, misal 80vh */
            max-height: 95vh; /* Agar responsif di layar kecil */
            background-color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
        }

        .login-form-section {
            flex: 1;
            padding: 40px 30px; /* Sedikit mengurangi padding horizontal untuk ruang lebih */
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
            position: relative; /* Untuk positioning logo */
        }

        .logo-container { /* Mengganti class .logo agar lebih spesifik dan bisa diposisikan */
            position: absolute;
            top: 40px;
            left: 40px;
        }

        .logo-container .brand-name {
            font-size: 24px;
            font-weight: 700;
            color: #4A90E2;
        }
        .logo-container .section-info {
            font-size:10px;
            color: #555;
            margin-top:-5px;
        }


        .login-form-section h2 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px; /* Mengurangi margin bawah */
            text-align: left;
            margin-top: 60px; /* Memberi ruang untuk logo di atas */
        }

        .form-group {
            margin-bottom: 18px; /* Sedikit mengurangi margin */
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: calc(100% - 22px); /* Kena padding input L+R */
            padding: 12px 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px; /* Sedikit mengecilkan font input */
            transition: border-color 0.3s;
        }

        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            outline: none;
            border-color: #4A90E2;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px; /* Mengurangi margin */
            font-size: 13px; /* Mengecilkan font */
        }

        .form-options .remember-me {
            display: flex;
            align-items: center;
            color: #555;
        }

        .form-options .remember-me input[type="checkbox"] {
            margin-right: 6px; /* Mengurangi margin */
        }

        .form-options .forgot-password a {
            color: #4A90E2;
            text-decoration: none;
        }

        .form-options .forgot-password a:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #4A90E2;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #357ABD;
        }

        .register-link {
            text-align: center;
            margin-top: 18px; /* Mengurangi margin */
            font-size: 13px; /* Mengecilkan font */
            color: #555;
        }

        .register-link a {
            color: #4A90E2;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .welcome-section {
            flex: 1;
            background: linear-gradient(to bottom right, #4A90E2, #63A4FF);
            padding: 40px; /* Menyesuaikan padding */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            position: relative;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50px;
            width: 100px;
            height: 100%;
            background-color: #ffffff;
            border-top-right-radius: 80px;
            border-bottom-right-radius: 80px;
            z-index: 1;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
        }

        .welcome-section h1 {
            font-size: 28px; /* Menyesuaikan ukuran font */
            font-weight: 700;
            margin-bottom: 15px;
        }

        .welcome-section p {
            font-size: 15px; /* Menyesuaikan ukuran font */
            line-height: 1.6;
            margin-bottom: 25px;
            max-width: 320px; /* Menyesuaikan lebar maks */
        }

        .welcome-section img {
            max-width: 75%; /* Menyesuaikan ukuran gambar */
            height: auto;
            margin-top: 15px;
        }

        .input-icon-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-container input {
            padding-right: 35px;
        }

        .input-icon-container .icon {
            position: absolute;
            right: 10px;
            color: #aaa;
            font-size: 18px;
            pointer-events: none; /* Agar ikon tidak bisa diklik/fokus */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-form-section">
            <div class="logo-container">
                <div class="brand-name">K. DOSEN</div>
                <div class="section-info">Section 4</div>
            </div>

            <h2>Login</h2>

            <form>
                <div class="form-group">
                    <div class="input-icon-container">
                        <input type="email" id="email" placeholder="Email" required>
                        <span class="icon">✉️</span> </div>
                </div>
                <div class="form-group">
                    <div class="input-icon-container">
                        <input type="password" id="password" placeholder="Password" required>
                        <span class="icon">🔒</span> </div>
                </div>
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#">Forgot the password?</a>
                    </div>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
            <div class="register-link">
                Don't have an account yet? <a href="#">Register</a>
            </div>
        </div>
        <div class="welcome-section">
            <div class="welcome-content">
                <h1>Hallo, Selamat Datang Kembali di Ruang Dosen !</h1>
                <p>Silakan masuk untuk melanjutkan aktivitas belajar Anda ~</p>
                <img src="your-illustration.svg" alt="Ilustrasi Belajar">
            </div>
        </div>
    </div>

</body>
</html>