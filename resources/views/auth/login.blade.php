<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - EduPortal</title>

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
        radial-gradient(at 0% 0%, rgba(99,102,241,0.2), transparent),
        radial-gradient(at 100% 100%, rgba(168,85,247,0.2), transparent);
    color: white;
}

/* CARD */
.login-card {
    width: 380px;
    padding: 45px;
    border-radius: 30px;
    background: var(--glass);
    backdrop-filter: blur(25px);
    border: 1px solid var(--glass-border);
    box-shadow: 0 25px 50px rgba(0,0,0,0.5);
    text-align: center;
    animation: fadeIn 0.7s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px);}
    to { opacity: 1; transform: translateY(0);}
}

/* HEADER */
.logo {
    font-size: 40px;
    margin-bottom: 10px;
}

.title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 25px;
}

/* INPUT */
.input-group {
    text-align: left;
    margin-bottom: 15px;
}

.input-group label {
    font-size: 13px;
    color: #94a3b8;
}

.input-group input {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border-radius: 10px;
    border: 1px solid var(--glass-border);
    background: rgba(255,255,255,0.1);
    color: white;
}

/* OPTIONS */
.options {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    margin-bottom: 20px;
}

.options a {
    color: #94a3b8;
    text-decoration: none;
}

/* BASE BUTTON */
.btn {
    width: 100%;
    padding: 13px;
    border-radius: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 10px;

    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

/* PRIMARY (LOGIN / REGISTER) */
.btn-primary {
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    color: white;
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(99,102,241,0.4);
}

/* SECONDARY (HOME) */
.btn-secondary {
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--glass-border);
    color: white;
    backdrop-filter: blur(10px);
}

.btn-secondary:hover {
    background: white;
    color: var(--bg-dark);
    transform: translateY(-2px);
}

/* FOOTER */
.footer {
    margin-top: 15px;
    font-size: 13px;
}

.footer a {
    color: #cbd5f5;
}
</style>
</head>

<body>

<form method="POST" action="{{ route('login') }}" class="login-card">
    @csrf

    <div class="logo">🎓</div>
    <div class="title">Welcome Back</div>

    <div class="input-group">
        <label>Username</label>
        <input type="username" name="username" placeholder="Masukkan username">
    </div>

    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password">
    </div>

    <div class="options">
        <label><input type="checkbox"> Remember me</label>
        <a href="#">Forgot?</a>
    </div>

    <button class="btn btn-login">
        <i class="fas fa-sign-in-alt"></i> Login
    </button>

    <!-- 🔥 TOMBOL HOME -->
    <a href="/" class="btn btn-home">
        <i class="fas fa-home"></i> Kembali ke Home
    </a>

    <div class="footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
    </div>

</form>

</body>
</html> 