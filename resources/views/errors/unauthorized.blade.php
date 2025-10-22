<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
        }
        h1 {
            font-size: 60px;
            color: #ef4444;
            margin: 0;
        }
        p {
            margin: 10px 0 20px;
            font-size: 18px;
            color: #374151;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }
        a:hover {
            background: #2563eb;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>403</h1>
        <p>{{ $message ?? 'Akses ditolak. Anda tidak memiliki izin.' }}</p>

        @php
            use Illuminate\Support\Facades\Auth;

            $user = Auth::user();
            $redirectUrl = url('/'); // default

            if ($user) {
                switch (strtolower($user->role->name ?? '')) {
                    case 'administrator':
                        $redirectUrl = url('/panel/manage');
                        break;
                    case 'manager':
                        $redirectUrl = url('/panel/manager');
                        break;
                    case 'employee':
                        $redirectUrl = url('/panel/employee');
                        break;
                    case 'supervisor':
                        $redirectUrl = url('/panel/supervisor');
                        break;
                    default:
                        $redirectUrl = url('/');
                        break;
                }
            }
        @endphp

        <a href="{{ $redirectUrl }}">Kembali</a>
    </div>
</body>
</html>
