<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
    .password-field { position: relative; }
    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        border: 0;
        background: transparent;
        color: var(--text-muted);
        cursor: pointer;
        font-size: 1rem;
        line-height: 1;
        padding: 4px;
    }
    .password-toggle:hover { color: var(--text); }
    .password-field input[type="password"],
    .password-field input[type="text"] { padding-right: 44px; }
    .flash-message {
        margin: 0 0 18px;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.92rem;
        font-weight: 600;
        border: 1px solid transparent;
    }
    .flash-message.success {
        background: rgba(74, 222, 128, 0.14);
        color: #14532d;
        border-color: rgba(74, 222, 128, 0.3);
    }
    .flash-message.error {
        background: rgba(248, 113, 113, 0.14);
        color: #7f1d1d;
        border-color: rgba(248, 113, 113, 0.3);
    }
    </style>
</head>
<body>
    <div class="auth-shell active" id="page-login">
        <div class="auth-visual">
            <div class="auth-visual-brand">🌿 NutriPath</div>
            <p>Atteignez vos objectifs santé avec un régime alimentaire personnalisé, conçu pour vous.</p>
            <div class="auth-features">
            <div class="auth-feature">
                <div class="auth-feature-icon">📊</div>
                <span>Calcul automatique de votre IMC</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon">🥗</div>
                <span>Régimes personnalisés selon vos objectifs</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon">🏃</div>
                <span>Plans sportifs adaptés à votre profil</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon">📄</div>
                <span>Export PDF de votre programme</span>
            </div>
            </div>
        </div>
        <div class="auth-form-wrap">
            <h2>Bon retour 👋</h2>
            <p class="auth-subtitle">Connectez-vous pour accéder à votre espace santé.</p>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="flash-message success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="flash-message error"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <form action="/singIn" method="post">
                <div class="form-group">
                    <label>Adresse Email</label>
                    <input type="email" name="email" placeholder="exemple@gmail.com" value="user@example.com" required >
                </div>
                <div class="form-group password-field">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" placeholder="••••••••" value="user" required autocomplete="current-password">
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">👁️</button>
                </div>
    
                <input type="submit" class="btn btn-primary" style="width:100%; justify-content:center; margin-bottom:16px;"
                value="Se connecter →">
            </form>

            <p style="text-align:center; font-size:0.85rem; color:var(--text-muted);">
            Pas encore de compte ? <a class="auth-link" href="/singUp"> Créer un compte </a>
            </p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(button) {
            const field = button.closest('.password-field');
            if (!field) return;

            const input = field.querySelector('input');
            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            button.textContent = isPassword ? '🙈' : '👁️';
            button.setAttribute('aria-label', isPassword ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
        }
    </script>
</body>
</html>