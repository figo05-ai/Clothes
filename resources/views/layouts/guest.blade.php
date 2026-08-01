<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kaira') }} - Luxury Auth</title>

        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        
        <!-- Google Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;700&family=Marcellus&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Expensive & Cozy Auth Styles -->
        <style>
            :root {
                --gold: #c5a975;
                --gold-hover: #e0c592;
                --text-light: #fdfdfd;
                --text-muted: #a3a3a3;
                --glass-bg: rgba(20, 20, 20, 0.45);
                --glass-border: rgba(197, 169, 117, 0.25);
            }
            body { 
                font-family: 'Jost', sans-serif; 
                color: var(--text-light); 
                margin: 0; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                min-height: 100vh; 
                overflow-x: hidden;
            }
            .auth-bg {
                background: url('{{ asset("images/bg-newsletter.jpg") }}') no-repeat center center/cover;
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                z-index: -2;
                transform: scale(1.05); /* Slight scale to prevent blur edges */
                filter: blur(8px);
            }
            .auth-overlay {
                background: linear-gradient(135deg, rgba(15,15,18,0.7) 0%, rgba(25,20,15,0.85) 100%);
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                z-index: -1;
            }
            .font-marcellus { font-family: 'Marcellus', serif; }
            .auth-card { 
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 24px; 
                box-shadow: 0 30px 60px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.1); 
                padding: 3.5rem 3rem; 
                width: 100%; 
                max-width: 480px; 
                position: relative; 
            }
            .input-group-text {
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid var(--glass-border);
                border-right: none;
                color: var(--gold);
                border-top-left-radius: 12px;
                border-bottom-left-radius: 12px;
                padding-left: 1.25rem;
                padding-right: 0.75rem;
            }
            .form-control { 
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid var(--glass-border);
                border-left: none;
                color: var(--text-light); 
                padding: 14px 15px 14px 0; 
                border-top-right-radius: 12px;
                border-bottom-right-radius: 12px;
                font-size: 0.95rem;
            }
            .form-control:focus { 
                background: rgba(255, 255, 255, 0.08); 
                color: var(--text-light); 
                border-color: var(--gold); 
                box-shadow: none;
            }
            .form-control::placeholder {
                color: rgba(255, 255, 255, 0.3);
            }
            .input-group:focus-within .input-group-text {
                background: rgba(255, 255, 255, 0.08);
                border-color: var(--gold);
            }
            .form-label { 
                color: var(--gold); 
                font-size: 0.8rem; 
                letter-spacing: 1.5px; 
                text-transform: uppercase; 
                margin-bottom: 8px; 
                display: block; 
                font-weight: 500;
            }
            .btn-gold { 
                background: linear-gradient(135deg, var(--gold) 0%, #a68b56 100%);
                color: #fff; 
                border: none; 
                font-weight: 500; 
                padding: 15px; 
                border-radius: 12px; 
                transition: all 0.4s ease; 
                width: 100%; 
                letter-spacing: 2px; 
                text-transform: uppercase; 
                font-size: 0.95rem;
                box-shadow: 0 10px 20px rgba(197, 169, 117, 0.2);
            }
            .btn-gold:hover { 
                background: linear-gradient(135deg, var(--gold-hover) 0%, var(--gold) 100%);
                color: #fff; 
                box-shadow: 0 15px 25px rgba(197, 169, 117, 0.4); 
                transform: translateY(-2px); 
            }
            .auth-link { 
                color: var(--gold); 
                text-decoration: none; 
                font-size: 0.9rem; 
                transition: color 0.3s; 
                position: relative;
            }
            .auth-link::after {
                content: '';
                position: absolute;
                width: 100%;
                transform: scaleX(0);
                height: 1px;
                bottom: -2px;
                left: 0;
                background-color: var(--gold);
                transform-origin: bottom right;
                transition: transform 0.25s ease-out;
            }
            .auth-link:hover::after {
                transform: scaleX(1);
                transform-origin: bottom left;
            }
            .auth-link:hover { color: var(--gold-hover); }
            
            .logo-text { 
                font-family: 'Marcellus', serif; 
                font-size: 2.8rem; 
                color: #fff; 
                text-align: center; 
                letter-spacing: 6px; 
                margin-bottom: 10px; 
                display: block; 
                text-decoration: none; 
                text-shadow: 0 2px 10px rgba(0,0,0,0.5);
            }
            .subtitle {
                text-align: center;
                color: var(--gold);
                font-size: 0.9rem;
                letter-spacing: 3px;
                text-transform: uppercase;
                margin-bottom: 40px;
            }
            
            /* Custom Checkbox */
            .form-check-input {
                background-color: rgba(255,255,255,0.1);
                border: 1px solid var(--glass-border);
            }
            .form-check-input:checked {
                background-color: var(--gold);
                border-color: var(--gold);
            }
        </style>
    </head>
    <body>
        <div class="auth-bg"></div>
        <div class="auth-overlay"></div>
        
        <div class="container d-flex justify-content-center">
            <div class="auth-card">
                <a href="/" class="logo-text">KAIRA</a>
                <div class="subtitle">{{ __('Exclusive Collection') }}</div>
                
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
