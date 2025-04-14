<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            width: 400px;
            background: white;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 
                        0 5px 15px rgba(0, 0, 0, 0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12), 
                        0 10px 20px rgba(0, 0, 0, 0.08);
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h2 {
            color: #000;
            font-size: 28px;
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
        
        .container:hover .header h2::after {
            transform: scaleX(1);
        }
        
        .header p {
            color: #666;
            margin-top: 15px;
            font-size: 15px;
        }
        
        .form-group {
            margin-bottom: 22px;
            position: relative;
        }
        
        .form-group i {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #000;
            transition: color 0.3s ease;
        }
        
        .form-control {
            width: 100%;
            height: 50px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            padding: 0 15px 0 45px;
            font-size: 16px;
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
        
        .btn {
            width: 100%;
            height: 50px;
            background: #000;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.5s ease;
        }
        
        .btn:hover {
            background: #333;
        }
        
        .btn:active::after {
            transform: translate(-50%, -50%) scale(20);
            opacity: 0;
        }
        
        .footer {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
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
            <h2>Buat Akun Baru</h2>
            <p>Silahkan isi form di bawah untuk mendaftar</p>
        </div>
        
        <form method="POST" action="/register">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required>
                <i class="fas fa-user"></i>
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <i class="fas fa-at"></i>
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                <i class="fas fa-map-marker-alt"></i>
            </div>
            
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            
            <button type="submit" class="btn">Daftar</button>
        </form>
        
        <div class="footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a>
        </div>
    </div>