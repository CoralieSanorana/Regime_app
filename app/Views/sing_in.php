<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/neon-theme.css') ?>">
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
    <canvas id="bg"></canvas>
    <div class="auth-shell active" id="page-login">
        <div class="auth-visual">
            <div class="auth-visual-brand"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#activity') ?>"></use></svg> IT-enForme</div>
            <p>Atteignez vos objectifs santé avec un régime alimentaire personnalisé, conçu pour vous.</p>
            <div class="auth-features">
            <div class="auth-feature">
                <div class="auth-feature-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#bar-chart') ?>"></use></svg></div>
                <span>Calcul automatique de votre IMC</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#egg-fried') ?>"></use></svg></div>
                <span>Régimes personnalisés selon vos objectifs</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#activity') ?>"></use></svg></div>
                <span>Plans sportifs adaptés à votre profil</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#filetype-pdf') ?>"></use></svg></div>
                <span>Export PDF de votre programme</span>
            </div>
            </div>
        </div>
        <div class="auth-form-wrap">
            <h2>Bon retour</h2>
            <p class="auth-subtitle">Connectez-vous pour accéder à votre espace santé.</p>
            <span class="auth-subtitle">admin@example.com (admin)</span>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="flash-message success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="flash-message error"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <form action="/singIn" method="post">
                <div class="form-group">
                    <label>Adresse Email</label>
                    <input type="email" name="email" placeholder="exemple@gmail.com" value="user1@example.com" required >
                </div>
                <div class="form-group password-field">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" placeholder="••••••••" value="1234" required autocomplete="current-password">
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
    
                <input type="submit" class="btn btn-primary" style="width:100%; justify-content:center; margin-bottom:16px;"
                value="Se connecter →">
            </form>

            <p style="text-align:center; font-size:0.85rem; color:var(--text-muted);">
            Pas encore de compte ? <a class="auth-link" href="/inscription"> Créer un compte </a>
            </p>
        </div>
    </div>

    <script src="<?= base_url('assets/js/neon-bg.js') ?>"></script>
    <script src="<?= base_url('assets/js/ui.js') ?>"></script>
</body>
</html>