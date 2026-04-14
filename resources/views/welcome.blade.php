<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Pengaduan Sekolah</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #6366f1;
            --secondary: #a855f7;
            --bg-dark: #020617;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.15) 0px, transparent 50%);
            overflow: hidden;
            color: white;
        }

        .card {
            background: var(--glass);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 60px 40px;
            border-radius: 40px;
            width: 550px; /* Sedikit diperlebar agar muat 3 tombol */
            text-align: center;
            border: 1px solid var(--glass-border);
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
            animation: floating 6s ease-in-out infinite;
            position: relative;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .card h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: -1.5px;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card p {
            font-size: 15px;
            margin-bottom: 40px;
            color: #94a3b8;
            line-height: 1.7;
        }

        .button-group {
            display: flex;
            gap: 12px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 24px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Tombol Home (Minimalist) */
        .btn-home:hover {
    background: rgb(165, 158, 158);
    color: var(--bg-dark);
    transform: translateY(-2px);
}

        /* Tombol Login (Solid Glow) */
        .btn-login {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        /* Tombol Register (Outline) */
        .btn-register {
            background: transparent;
            color: white;
            border: 1px solid var(--glass-border);
        }

        .btn:hover {
            transform: scale(1.05) translateY(-3px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
        }

     .btn-home:hover {
    background: rgb(134, 130, 130);
    color: var(--bg-dark);
    transform: translateY(-2px);
}

        @media (max-width: 550px) {
            .card { width: 90%; padding: 40px 20px; }
            .button-group { flex-direction: column; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>
</head>

<body>

    <div class="card">
        <h1>Welcome Pengaduan Sekolah.</h1>
        <p>
            Sampaikan laporan atau aspirasimu secara transparan. Kami siap mendengarkan untuk sekolah yang lebih baik.
        </p>

        <div class="button-group">
            <a href="/" class="btn btn-home">
                <i class="fas fa-home"></i> Home
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-login">
                    <i class="fas fa-gauge"></i> Dashboard
                </a>
                
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-register">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-register">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            @endauth
        </div>
    </div>

</body>
</html>