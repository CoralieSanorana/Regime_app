<?php $date_max = date('Y-m-d'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        /* Minimal auth styles copied from nutri-template to ensure layout parity */
        .auth-shell { display: none; min-height: 100vh; background: var(--bg,#fff); position: relative; overflow: hidden; }
        .auth-shell.active { display: flex; align-items: stretch; }
        .auth-visual { width: 42%; background: linear-gradient(160deg, #0f2015 0%, #071009 60%, #0a0e0b 100%); display:flex;flex-direction:column;justify-content:center;padding:60px;border-right:1px solid rgba(0,0,0,0.06); }
        .auth-visual-brand { font-family: var(--font-display,Arial); font-size:2.5rem; font-weight:700; color:#4ade80; margin-bottom:16px; }
        .auth-form-wrap { flex:1; display:flex;flex-direction:column;justify-content:center;padding:60px;overflow-y:auto; }
        .step-progress { display:flex; align-items:center; gap:12px; margin-bottom:18px; }
        .step { display:flex; align-items:center; gap:10px; }
        .step-circle { width:34px;height:34px;border-radius:50%;display:grid;place-items:center;background:var(--surface,#f5f5f5);font-weight:700 }
        .step.active .step-circle { background:#111;color:#fff }
        .step-label { font-size:0.78rem; font-weight:600; color:#666 }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px }
        .form-group { margin-bottom:14px }
        .btn { padding:12px 18px; border:none; border-radius:8px; cursor:pointer }
        .btn-primary { background:#1f8a3d;color:#fff }
        .btn-outline { background:transparent;border:1px solid var(--border,#ddd); }
        .password-field { position: relative; }
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #777;
            cursor: pointer;
            font-size: 1rem;
            line-height: 1;
            padding: 4px;
        }
        .password-field input[type="password"],
        .password-field input[type="text"] { padding-right: 44px; }
        @media (max-width:900px) { .auth-visual{display:none} .auth-form-wrap{padding:40px 28px} }
    </style>
</head>
<body>

    <!-- Simple login shell so showLogin() works like in nutri-template -->
    <div class="auth-shell" id="page-login">
        <div class="auth-visual">
            <div class="auth-visual-brand">🌿 NutriPath</div>
            <p style="color:rgba(255,255,255,0.8)">Atteignez vos objectifs santé avec un régime personnalisé.</p>
        </div>
        <div class="auth-form-wrap">
            <h2>Bon retour 👋</h2>
            <p class="auth-subtitle">Connectez-vous pour accéder à votre espace santé.</p>
            <div class="form-group"><label>Adresse Email</label><input required type="email" placeholder="exemple@email.com"></div>
            <div class="form-group password-field"><label>Mot de passe</label><input required type="password" placeholder="••••••••"><button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">👁️</button></div>
            <button class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:16px;" onclick="showApp()">Se connecter →</button>
            <p style="text-align:center;color:#777">Pas encore de compte ? <a class="auth-link" onclick="showRegister()">Créer un compte</a></p>
        </div>
    </div>

    <div class="auth-shell active" id="page-register1">
        <div class="auth-visual">
            <div class="auth-visual-brand">🌿 NutriPath</div>
            <p>Rejoignez des milliers d'utilisateurs qui ont transformé leur alimentation et leur corps.</p>
            <div class="auth-features">
            <div class="auth-feature"><div class="auth-feature-icon">✅</div><span>Inscription gratuite</span></div>
            <div class="auth-feature"><div class="auth-feature-icon">🔒</div><span>Vos données restent privées</span></div>
            <div class="auth-feature"><div class="auth-feature-icon">⚡</div><span>Résultats dès le premier jour</span></div>
            </div>
        </div>
        <div class="auth-form-wrap">
            <form action="/singUp" method="post">
                <h2>Créer un compte</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Prénom</label>
                            <input required type="text" name="prenom" placeholder="Jean">
                        </div>
                        <div class="form-group">
                            <label>Nom</label>
                            <input required type="text" name="nom" placeholder="Dupont">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Genre</label>
                            <select name="genre" id="" required>
                                <option>— Choisir —</option>
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date de naissance</label>
                            <input required type="date" name="date_naissance" max="<?= $date_max ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Adresse Email</label>
                        <input required type="email" name="email" placeholder="jean.dupont@mail.com">
                    </div>
                    <div class="form-group">
                        <label>Adresse</label>
                        <input required type="text" name="adresse" placeholder="123 Rue de la Santé, Antananarivo">
                    </div>

                    <div class="form-group password-field">
                        <label>Mot de passe</label>
                        <input required type="password" name="password" placeholder="Au moins 3 caractères">
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">👁️</button>
                    </div>
                    <div class="form-group password-field">
                        <label>Confirmer le mot de passe</label>
                        <input required type="password" name="confirme_password"  placeholder="Répétez votre mot de passe">
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">👁️</button>
                    </div>
                    <div style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:14px 18px;margin-bottom:20px;font-size:0.82rem;color:var(--text-muted);line-height:1.7;">
                        🔒 Votre mot de passe doit contenir :<br>
                        · Au moins 3 caractères
                    </div>

                <input required type="submit" class="btn btn-primary" style="flex:1;justify-content:center;" value="Créer mon compte ✓">

            </form>
        
            <div style="text-align:center; margin-top:14px; font-size:0.82rem; color:var(--text-muted);">
            Déjà inscrit ? <a class="auth-link" onclick="showLogin()">Se connecter</a>
            </div>

            <div style="display:flex;gap:12px;">
            </div>
        </div>
    </div>
</body>
<script>
    function clearAuth() {
        document.querySelectorAll('.auth-shell').forEach((shell) => shell.classList.remove('active'));
    }

    function showLogin() {
        clearAuth();
        document.getElementById('page-login').classList.add('active');
    }

    function showRegister() {
        clearAuth();
        document.getElementById('page-register1').classList.add('active');
    }

    function showApp() {
        window.location.href = '/';
    }

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
</html>