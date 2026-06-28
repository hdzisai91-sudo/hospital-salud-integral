<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Inicio de sesión - Sistema de Gestión de Mantenimiento y Servicios del Hospital Salud Integral, El Salvador">
    <title>Inicio de Sesión - Hospital Salud Integral</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ========================================
           RESET & BASE
           ======================================== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            -webkit-text-size-adjust: 100%;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #e8f0fe 0%, #dbeafe 30%, #eff6ff 60%, #f0f9ff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* ========================================
           BACKGROUND DECORATION
           ======================================== */
        body::before {
            content: '';
            position: fixed;
            top: -120px;
            right: -120px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* ========================================
           LOGIN CARD
           ======================================== */
        .login-container {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 35px 30px;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 10px 15px -3px rgba(0, 0, 0, 0.08),
                0 20px 40px -5px rgba(0, 0, 0, 0.06);
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========================================
           HEADER / BRANDING
           ======================================== */
        .brand-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .logo-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%);
            border-radius: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            position: relative;
            overflow: hidden;
        }

        .logo-icon::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.15) 100%);
            border-radius: inherit;
        }

        .logo-icon svg {
            width: 30px;
            height: 30px;
            fill: white;
            position: relative;
            z-index: 1;
        }

        .brand-text h1 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
            letter-spacing: -0.3px;
        }

        .brand-text .country {
            font-size: 12px;
            font-weight: 600;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 2px;
        }

        /* ========================================
           WELCOME TEXT
           ======================================== */
        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-section h2 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .welcome-section p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
        }

        /* ========================================
           ALERTS / ERRORS
           ======================================== */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-left: 4px solid #ef4444;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            animation: shakeError 0.4s ease-in-out;
        }

        .alert-error ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .alert-error li {
            font-size: 13px;
            color: #dc2626;
            display: flex;
            align-items: center;
            gap: 8px;
            line-height: 1.4;
        }

        .alert-error li::before {
            content: '';
            width: 6px;
            height: 6px;
            background: #ef4444;
            border-radius: 50%;
            flex-shrink: 0;
        }

        @keyframes shakeError {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #22c55e;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #166534;
        }

        .alert-throttle {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-left: 4px solid #f59e0b;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #92400e;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-throttle svg {
            width: 18px;
            height: 18px;
            fill: #f59e0b;
            flex-shrink: 0;
        }

        /* ========================================
           FORM ELEMENTS
           ======================================== */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .forgot-link {
            font-size: 12px;
            font-weight: 500;
            color: #3b82f6;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            width: 18px;
            height: 18px;
            fill: #94a3b8;
            pointer-events: none;
            transition: fill 0.2s ease;
            z-index: 2;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 14px 12px 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: all 0.25s ease;
        }

        .input-wrapper input::placeholder {
            color: #94a3b8;
        }

        .input-wrapper input:focus {
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .input-wrapper input:focus ~ .input-icon {
            fill: #3b82f6;
        }

        .input-wrapper input.input-error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .input-wrapper input.input-error:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Password toggle */
        .toggle-password {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        .toggle-password:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
            fill: #94a3b8;
            transition: fill 0.2s ease;
        }

        .toggle-password:hover svg {
            fill: #64748b;
        }

        /* Remember me */
        .remember-section {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .custom-checkbox {
            position: relative;
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            width: 18px;
            height: 18px;
            background: #f8fafc;
            border: 1.5px solid #d1d5db;
            border-radius: 5px;
            transition: all 0.2s ease;
        }

        .custom-checkbox input:checked ~ .checkmark {
            background: #3b82f6;
            border-color: #3b82f6;
        }

        .checkmark::after {
            content: '';
            position: absolute;
            display: none;
            left: 5.5px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-checkbox input:checked ~ .checkmark::after {
            display: block;
        }

        .remember-section span {
            font-size: 13px;
            color: #64748b;
            cursor: pointer;
            user-select: none;
        }

        /* ========================================
           SUBMIT BUTTON
           ======================================== */
        .btn-login {
            width: 100%;
            padding: 13px 24px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: white;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
            transform: translateY(-1px);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-login svg {
            width: 20px;
            height: 20px;
            fill: white;
            transition: transform 0.3s ease;
        }

        .btn-login:hover svg {
            transform: translateX(3px);
        }

        /* Loading spinner */
        .btn-login .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2.5px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        .btn-login.loading .spinner {
            display: block;
        }

        .btn-login.loading .btn-text,
        .btn-login.loading .btn-icon {
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ========================================
           FOOTER
           ======================================== */
        .footer {
            margin-top: 28px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }

        .footer p {
            font-size: 11px;
            color: #94a3b8;
            line-height: 1.6;
        }

        .footer p strong {
            color: #64748b;
            font-weight: 600;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            margin-top: 20px;
            padding-top: 16px;
        }

        .footer-link {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #3b82f6;
        }

        .footer-link svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
        }

        .footer-separator {
            width: 1px;
            height: 14px;
            background: #d1d5db;
        }

        /* ========================================
           FIELD-LEVEL ERRORS
           ======================================== */
        .field-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ========================================
           RESPONSIVE
           ======================================== */
        @media (max-width: 480px) {
            body {
                padding: 12px;
                justify-content: flex-start;
                padding-top: 40px;
            }

            .login-container {
                padding: 30px 24px 24px;
                border-radius: 16px;
            }

            .brand-header {
                gap: 12px;
            }

            .logo-icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
            }

            .logo-icon svg {
                width: 26px;
                height: 26px;
            }

            .brand-text h1 {
                font-size: 16px;
            }

            .welcome-section h2 {
                font-size: 20px;
            }
        }

        /* ========================================
           ACCESSIBILITY: Focus visible
           ======================================== */
        .btn-login:focus-visible,
        .forgot-link:focus-visible,
        .toggle-password:focus-visible {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        .input-wrapper input:focus-visible {
            outline: none;
        }
    </style>
</head>

<body>

<main class="login-container" role="main">

    {{-- ===== BRAND HEADER ===== --}}
    <div class="brand-header">
        <div class="logo-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 11h-4v4h-4v-4H6v-4h4V6h4v4h4v4z"/>
            </svg>
        </div>
        <div class="brand-text">
            <h1>Hospital Salud Integral</h1>
            <div class="country">El Salvador</div>
        </div>
    </div>

    {{-- ===== WELCOME ===== --}}
    <div class="welcome-section">
        <h2>Bienvenido de nuevo</h2>
        <p>Sistema de Gestión de Mantenimiento y Servicios</p>
    </div>

    {{-- ===== SESSION STATUS (ej. after password reset) ===== --}}
    @if (session('status'))
        <div class="alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{-- ===== VALIDATION ERRORS ===== --}}
    @if ($errors->any())
        <div class="alert-error" role="alert" aria-live="assertive">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ===== LOGIN FORM ===== --}}
    <form method="POST"
          action="{{ route('login') }}"
          id="loginForm"
          autocomplete="on"
          novalidate>

        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Usuario o Correo Electrónico</label>
            <div class="input-wrapper">
                <svg class="input-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="ejemplo@hospital.com"
                       required
                       autofocus
                       autocomplete="email"
                       class="{{ $errors->has('email') ? 'input-error' : '' }}"
                       aria-describedby="emailError"
                       maxlength="255">
            </div>
            @if ($errors->has('email'))
                <div class="field-error" id="emailError">{{ $errors->first('email') }}</div>
            @endif
        </div>

        {{-- Password --}}
        <div class="form-group">
            <div class="label-row">
                <label for="password">Contraseña</label>
                <a href="{{ route('password.request') }}" class="forgot-link">
                    ¿Olvidó su contraseña?
                </a>
            </div>
            <div class="input-wrapper">
                <svg class="input-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zM9 8V6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9z"/>
                </svg>
                <input type="password"
                       id="password"
                       name="password"
                       placeholder="••••••••"
                       required
                       autocomplete="current-password"
                       class="{{ $errors->has('password') ? 'input-error' : '' }}"
                       aria-describedby="passwordError"
                       minlength="6"
                       maxlength="128">
                <button type="button"
                        class="toggle-password"
                        id="togglePassword"
                        aria-label="Mostrar contraseña"
                        tabindex="0">
                    {{-- Eye icon (show) --}}
                    <svg id="eyeShow" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                    </svg>
                    {{-- Eye-off icon (hide) --}}
                    <svg id="eyeHide" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display:none;">
                        <path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>
                    </svg>
                </button>
            </div>
            @if ($errors->has('password'))
                <div class="field-error" id="passwordError">{{ $errors->first('password') }}</div>
            @endif
        </div>

        {{-- Remember Me --}}
        <div class="remember-section">
            <label class="custom-checkbox" for="remember">
                <input type="checkbox"
                       id="remember"
                       name="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
            <span onclick="document.getElementById('remember').click()">
                Recordar sesión en este equipo
            </span>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-login" id="btnLogin">
            <span class="btn-text">Iniciar Sesión</span>
            <svg class="btn-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.09 15.59L11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67l-2.58 2.59zM19 3H5c-1.11 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
            </svg>
            <div class="spinner"></div>
        </button>

    </form>

    {{-- ===== FOOTER ===== --}}
    <div class="footer">
        <p>
            &copy; {{ date('Y') }} <strong>Hospital Salud Integral</strong>. Todos los derechos reservados.<br>
            Uso exclusivo para personal autorizado.
        </p>
        <div class="footer-links">
            <a href="#" class="footer-link">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Sistema Operativo
            </a>
            <div class="footer-separator"></div>
            <a href="#" class="footer-link">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                </svg>
                Soporte TI
            </a>
        </div>
    </div>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ===== TOGGLE PASSWORD VISIBILITY =====
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeShow = document.getElementById('eyeShow');
        const eyeHide = document.getElementById('eyeHide');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeShow.style.display = isPassword ? 'none' : 'block';
                eyeHide.style.display = isPassword ? 'block' : 'none';
                this.setAttribute('aria-label',
                    isPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'
                );
            });
        }

        // ===== FORM SUBMIT: Prevent double-click =====
        const form = document.getElementById('loginForm');
        const btnLogin = document.getElementById('btnLogin');

        if (form && btnLogin) {
            form.addEventListener('submit', function (e) {
                // Client-side validation
                const email = document.getElementById('email');
                const password = document.getElementById('password');

                if (!email.value.trim()) {
                    e.preventDefault();
                    email.classList.add('input-error');
                    email.focus();
                    return;
                }

                if (!password.value) {
                    e.preventDefault();
                    password.classList.add('input-error');
                    password.focus();
                    return;
                }

                // Prevent double submit
                if (btnLogin.classList.contains('loading')) {
                    e.preventDefault();
                    return;
                }

                btnLogin.classList.add('loading');
                btnLogin.disabled = true;
            });
        }

        // ===== Clear error styling on input =====
        document.querySelectorAll('.input-wrapper input').forEach(function (input) {
            input.addEventListener('input', function () {
                this.classList.remove('input-error');
            });
        });

    });
</script>

</body>

</html>