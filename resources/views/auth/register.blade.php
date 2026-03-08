<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Créez votre compte StockMaster">

    <title>Inscription - StockMaster</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: #333;
        }

        /* Image de fond */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -2;
        }

        /* Overlay sombre */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        /* Container principal */
        .register-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Carte d'inscription */
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2.5rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* En-tête */
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #F37335, #FDC830);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(243, 115, 53, 0.3);
        }

        .logo-icon i {
            font-size: 2rem;
            color: white;
        }

        .logo span {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #F37335, #FDC830);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .register-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: #666;
            font-size: 0.95rem;
        }

        /* Formulaire */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-label i {
            color: #F37335;
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 2.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #F37335;
            box-shadow: 0 0 0 4px rgba(243, 115, 53, 0.1);
        }

        .form-input.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-message i {
            font-size: 0.85rem;
        }

        /* Grille pour deux colonnes (optionnel) */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* Bouton d'inscription */
        .btn-register {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #F37335, #FDC830);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            box-shadow: 0 10px 20px rgba(243, 115, 53, 0.3);
            margin-top: 1rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(243, 115, 53, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .btn-register:hover i {
            transform: translateX(5px);
        }

        /* Lien de connexion */
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .login-link p {
            color: #666;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #F37335;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .login-link a:hover {
            color: #FDC830;
        }

        .login-link a i {
            font-size: 0.9rem;
        }

        /* Indicateur de force du mot de passe (optionnel) */
        .password-strength {
            margin-top: 0.5rem;
            display: flex;
            gap: 0.3rem;
        }

        .strength-bar {
            height: 4px;
            flex: 1;
            background: #e0e0e0;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .strength-bar.active {
            background: #F37335;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                padding: 1rem;
            }

            .register-card {
                padding: 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
<div class="register-container">
    <div class="register-card">
        <!-- En-tête -->
        <div class="register-header">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <span>StockMaster</span>
            </a>
            <h1>Créer un compte</h1>
            <p>Rejoignez StockMaster pour gérer votre stock</p>
        </div>

        <!-- Formulaire d'inscription -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nom complet -->
            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i>
                    Nom complet
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input id="name"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autofocus
                           autocomplete="name"
                           class="form-input @error('name') error @enderror"
                           placeholder="Jean Dupont">
                </div>
                @error('name')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i>
                    Adresse email
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="username"
                           class="form-input @error('email') error @enderror"
                           placeholder="exemple@email.com">
                </div>
                @error('email')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i>
                    Mot de passe
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           autocomplete="new-password"
                           class="form-input @error('password') error @enderror"
                           placeholder="••••••••"
                           onkeyup="checkPasswordStrength(this.value)">
                </div>
                @error('password')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror

                <!-- Indicateur de force du mot de passe (optionnel) -->
                <div class="password-strength" id="passwordStrength">
                    <div class="strength-bar"></div>
                    <div class="strength-bar"></div>
                    <div class="strength-bar"></div>
                </div>
            </div>

            <!-- Confirmation mot de passe -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">
                    <i class="fas fa-lock"></i>
                    Confirmer le mot de passe
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-check-circle input-icon"></i>
                    <input id="password_confirmation"
                           type="password"
                           name="password_confirmation"
                           required
                           autocomplete="new-password"
                           class="form-input @error('password_confirmation') error @enderror"
                           placeholder="••••••••">
                </div>
                @error('password_confirmation')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Bouton d'inscription -->
            <button type="submit" class="btn-register">
                <span>Créer mon compte</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <!-- Lien vers connexion -->
        <div class="login-link">
            <p>
                Déjà un compte ?
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</div>

<!-- Script pour la force du mot de passe (optionnel) -->
<script>
    function checkPasswordStrength(password) {
        const bars = document.querySelectorAll('.strength-bar');
        let strength = 0;

        if (password.length >= 8) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        if (password.match(/[$@#&!]+/)) strength++;

        // Réinitialiser les barres
        bars.forEach(bar => {
            bar.classList.remove('active');
            bar.style.background = '#e0e0e0';
        });

        // Activer les barres selon la force
        for (let i = 0; i < Math.min(strength, 3); i++) {
            bars[i].classList.add('active');
            if (strength <= 2) {
                bars[i].style.background = '#dc3545';
            } else if (strength <= 4) {
                bars[i].style.background = '#F37335';
            } else {
                bars[i].style.background = '#28a745';
            }
        }
    }
</script>
</body>
</html>
