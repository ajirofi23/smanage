<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AICC SHE Portal</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f9; /* Warna latar belakang yang lembut */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Mengisi seluruh tinggi layar */
        }

        .login-container {
            background-color: #ffffff;
            padding: 2.5rem 3rem; /* Padding lebih besar untuk ruang */
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px; /* Lebar maksimal form */
            text-align: center;
        }

        .login-logo {
            font-size: 2rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .login-logo .highlight {
            background-color: #e65100;
            color: #ffffff;
            padding: 0 8px;
            border-radius: 5px;
        }
        
        .login-container h2 {
            margin-bottom: 2rem;
            color: #555;
            font-weight: 500;
        }

        .input-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
        }
        
        .input-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Agar padding tidak menambah lebar total */
            transition: border-color 0.3s;
        }
        
        .input-group input:focus {
            outline: none;
            border-color: #364e68; /* Warna highlight saat input aktif */
        }

        .submit-button {
            width: 100%;
            padding: 0.9rem;
            border: none;
            background-color: #364e68; /* Warna biru gelap konsisten */
            color: #ffffff;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #1f2937; /* Warna lebih gelap saat disentuh mouse */
        }
        
        .extra-links {
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        
        .extra-links a {
            color: #555;
            text-decoration: none;
        }
        .extra-links a:hover {
            text-decoration: underline;
        }
        /* Animasi untuk efek fade-in */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Style untuk alert box modern */
    .alert-modern {
        --alert-bg: #FFF0F0;         /* Warna Latar */
        --alert-border: #FFBABA;     /* Warna Border */
        --alert-text: #D8000C;        /* Warna Teks & Ikon */
        
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 12px;
        background-color: var(--alert-bg);
        border: 1px solid var(--alert-border);
        color: var(--alert-text);
        
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        
        box-shadow: 0 4px 15px rgba(216, 0, 12, 0.1); /* Efek Shadow */
        animation: fadeIn 0.5s ease-out; /* Terapkan Animasi */
    }

    .alert-modern .icon {
        font-size: 1.25rem;
        flex-shrink: 0; /* Mencegah ikon menyusut */
        padding-top: 2px;
    }

    .alert-modern .content strong {
        display: block;
        margin-bottom: 0.25rem;
        font-size: 1rem;
        color: var(--alert-text);
    }
    
    .alert-modern .content ul {
        margin: 0;
        padding-left: 1.25rem;
        font-size: 0.9rem;
        color: #e53e3e; /* Warna sub-teks yang sedikit lebih gelap */
    }
</style>
</head>
<body>
    
    <div class="login-container">
        <div class="login-logo"><span class="highlight">AICC</span> SHE</div>
        <h2>Portal Dashboard Login</h2>

      @if ($errors->any())
    <div class="alert-modern">
        <div class="icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div class="content">
            <strong>Login Gagal</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

        <form action="" method="POST">
            @csrf  
            
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" placeholder="Masukkan Email Anda" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>
            
            <button type="submit" class="submit-button">Login</button>
        </form>
        <div class="extra-links">
            <a href="#">Lupa Password?</a>
        </div>
    </div>

</body>
</html>