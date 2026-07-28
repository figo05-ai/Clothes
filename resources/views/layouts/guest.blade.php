<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kaira') }} - Executive Auth</title>

        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;700&family=Marcellus&display=swap" rel="stylesheet">

        <!-- Luxury Auth Styles -->
        <style>
            :root {
                --bg-dark: #0f0f11;
                --bg-card: #1a1a1c;
                --gold: #c5a975;
                --gold-hover: #d4b884;
                --text-muted: #888888;
                --text-light: #f4f4f4;
                --border-color: #2a2a2c;
            }
            body { 
                font-family: 'Jost', sans-serif; 
                background-color: var(--bg-dark); 
                background-image: radial-gradient(circle at center, #1a1a1c 0%, #0f0f11 100%);
                color: var(--text-light); 
                margin: 0; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                min-height: 100vh; 
            }
            .font-marcellus { font-family: 'Marcellus', serif; }
            .auth-card { 
                background-color: var(--bg-card); 
                border: 1px solid var(--border-color); 
                border-radius: 12px; 
                box-shadow: 0 15px 40px rgba(0,0,0,0.8); 
                padding: 50px 40px; 
                width: 100%; 
                max-width: 450px; 
                position: relative; 
                overflow: hidden; 
            }
            .auth-card::before { 
                content: ''; 
                position: absolute; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 2px; 
                background: linear-gradient(to right, transparent, var(--gold), transparent); 
                opacity: 0.8; 
            }
            .form-control { 
                background-color: #111; 
                border: 1px solid var(--border-color); 
                color: var(--text-light); 
                padding: 12px 15px; 
                border-radius: 6px; 
                font-size: 0.95rem;
            }
            .form-control:focus { 
                background-color: #111; 
                color: var(--text-light); 
                border-color: var(--gold); 
                box-shadow: 0 0 0 0.2rem rgba(197, 169, 117, 0.2); 
            }
            .form-label { 
                color: var(--text-muted); 
                font-size: 0.85rem; 
                letter-spacing: 1px; 
                text-transform: uppercase; 
                margin-bottom: 8px; 
                display: block; 
            }
            .btn-gold { 
                background-color: var(--gold); 
                color: #000; 
                border: none; 
                font-weight: 500; 
                padding: 14px; 
                border-radius: 6px; 
                transition: all 0.3s; 
                width: 100%; 
                letter-spacing: 1.5px; 
                text-transform: uppercase; 
                font-size: 0.9rem;
            }
            .btn-gold:hover { 
                background-color: var(--gold-hover); 
                color: #000; 
                box-shadow: 0 4px 20px rgba(197,169,117,0.3); 
                transform: translateY(-2px); 
            }
            .auth-link { 
                color: var(--gold); 
                text-decoration: none; 
                font-size: 0.9rem; 
                transition: color 0.3s; 
            }
            .auth-link:hover { color: var(--text-light); }
            .logo-text { 
                font-family: 'Marcellus', serif; 
                font-size: 2.2rem; 
                color: var(--gold); 
                text-align: center; 
                letter-spacing: 4px; 
                margin-bottom: 40px; 
                display: block; 
                text-decoration: none; 
            }
            .logo-text:hover { color: var(--gold-hover); }
        </style>
    </head>
    <body>
        <div class="auth-card">
            <a href="/" class="logo-text">KAIRA</a>
            {{ $slot }}
        </div>
    </body>
</html>
