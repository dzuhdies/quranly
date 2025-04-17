<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08), 
                        0 3px 10px rgba(0, 0, 0, 0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        @media (min-width: 768px) {
            .container {
                padding: 35px;
            }
            
            .container:hover {
                transform: translateY(-5px);
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12), 
                            0 10px 20px rgba(0, 0, 0, 0.08);
            }
            
            .container:hover .header h2::after {
                transform: scaleX(1);
            }
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .header h2 {
            color: #000;
            font-size: 24px;
            font-weight: 600;
            position: relative;
            display: inline-block;
        }
        
        .header h2::after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background-color: #000;
            bottom: -8px;
            left: 25%;
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .header p {
            color: #666;
            margin-top: 10px;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 18px;
            position: relative;
        }
        
        .form-group i {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #000;
            transition: color 0.3s ease;
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            height: 45px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            padding: 0 15px 0 40px;
            font-size: 15px;
            color: #333;
            transition: all 0.3s ease;
            background-color: #fbfbfb;
        }
        
        .form-control:focus {
            border-color: #000;
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            outline: none;
        }
        
        .form-control:focus + i {
            color: #000;
        }
        
        .form-control::placeholder {
            color: #aaa;
            transition: opacity 0.3s ease;
        }
        
        .form-control:focus::placeholder {
            opacity: 0.5;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .remember-me input {
            margin-right: 8px;
            accent-color: #000;
            width: 16px;
            height: 16px;
        }
        
        .remember-me label {
            color: #666;
            font-size: 13px;
        }
        
        .btn {
            width: 100%;
            height: 45px;
            background: #000;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.5s ease;
        }
        
        .btn:hover {
            background: #333;
        }
        
        .btn:active::after {
            transform: translate(-50%, -50%) scale(15);
            opacity: 0;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 13px;
        }
        
        .footer a {
            color: #000;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: color 0.3s ease;
        }
        
        .footer a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            background-color: #000;
            bottom: -2px;
            left: 0;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }
        
        .footer a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        
        .forgot-password {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 15px;
        }
        
        .forgot-password a {
            color: #666;
            font-size: 12px;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: #000;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .container {
            animation: fadeIn 0.6s ease forwards;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Selamat Datang</h2>
            <p>Silahkan login untuk melanjutkan</p>
        </div>
        
        <form method="POST" action="/login">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="login" placeholder="Username / Nama Lengkap" required>
                <i class="fas fa-user"></i>
            </div>
            
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>
            
            <div class="forgot-password">
                <a href="#">Lupa password?</a>
            </div>
            
            <button type="submit" class="btn">Masuk</button>
        </form>
        
        <div class="footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a>
        </div>
    </div>
</body>
</html>