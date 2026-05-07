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
            <div class="form-group"><label>Adresse Email</label><input type="email" placeholder="exemple@email.com"></div>
            <div class="form-group password-field"><label>Mot de passe</label><input type="password" placeholder="••••••••"><button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">👁️</button></div>
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
            <div class="step-progress">
            <div class="step active">
                <div class="step-circle">1</div>
                <div class="step-label">Infos personnelles</div>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle">2</div>
                <div class="step-label">Santé</div>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle">3</div>
                <div class="step-label">Sécurité</div>
            </div>
            </div>

            <h2>Créer un compte</h2>
            <p class="auth-subtitle">Étape 1 — Vos informations personnelles & contact.</p>

            <div class="form-row">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" placeholder="Jean">
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" placeholder="Dupont">
            </div>
            </div>
            <div class="form-row">
            <div class="form-group">
                <label>Genre</label>
                <select>
                <option>— Choisir —</option>
                <option>Homme</option>
                <option>Femme</option>
                <option>Autre</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date de naissance</label>
                <input type="date">
            </div>
            </div>
            <div class="form-group">
            <label>Adresse Email</label>
            <input type="email" placeholder="jean.dupont@mail.com">
            </div>
            <div class="form-group">
            <label>Adresse</label>
            <input type="text" placeholder="123 Rue de la Santé, Antananarivo">
            </div>

            <button class="btn btn-primary" style="width:100%; justify-content:center;" onclick="showRegister2()">
            Continuer →
            </button>
            <div style="text-align:center; margin-top:14px; font-size:0.82rem; color:var(--text-muted);">
            Déjà inscrit ? <a class="auth-link" onclick="showLogin()">Se connecter</a>
            </div>
        </div>
    </div>
    
    <div class="auth-shell" id="page-register2">
        <div class="auth-visual">
            <div class="auth-visual-brand">🌿 NutriPath</div>
            <p>Ces informations nous permettent de calculer votre IMC et de vous proposer les meilleurs régimes.</p>
        </div>
        <div class="auth-form-wrap">
            <div class="step-progress">
            <div class="step done">
                <div class="step-circle">✓</div>
                <div class="step-label">Infos personnelles</div>
            </div>
            <div class="step-line done"></div>
            <div class="step active">
                <div class="step-circle">2</div>
                <div class="step-label">Santé</div>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle">3</div>
                <div class="step-label">Sécurité</div>
            </div>
            </div>

            <h2>Informations de santé</h2>
            <p class="auth-subtitle">Étape 2 — Ces données servent uniquement au calcul de votre IMC.</p>

            <div class="form-row">
            <div class="form-group">
                <label>Poids actuel (kg)</label>
                <input type="number" placeholder="70">
            </div>
            <div class="form-group">
                <label>Taille (cm)</label>
                <input type="number" placeholder="175">
            </div>
            </div>

            <div class="imc-display" style="margin-top:8px;">
            <div class="imc-ring">
                <svg width="120" height="120">
                <circle cx="60" cy="60" r="50" fill="none" stroke="#1f2b23" stroke-width="10"/>
                <circle cx="60" cy="60" r="50" fill="none" stroke="#4ade80" stroke-width="10"
                    stroke-dasharray="220 314" stroke-linecap="round"/>
                </svg>
                <div class="imc-value-wrap">
                <div class="imc-number">22.9</div>
                <div class="imc-unit">IMC</div>
                </div>
            </div>
            <div class="imc-info">
                <h3>Poids Normal</h3>
                <div class="imc-status status-normal">✓ IMC Sain</div>
                <div class="imc-scale">
                <span class="scale-seg" style="background:rgba(96,165,250,0.15);color:var(--info);">Insuffisant &lt;18.5</span>
                <span class="scale-seg" style="background:rgba(74,222,128,0.15);color:var(--accent);">Normal 18.5–24.9</span>
                <span class="scale-seg" style="background:rgba(245,158,11,0.15);color:var(--gold);">Surpoids 25–29.9</span>
                <span class="scale-seg" style="background:rgba(248,113,113,0.15);color:var(--danger);">Obésité ≥30</span>
                </div>
            </div>
            </div>

            <div style="display:flex;gap:12px;">
            <button class="btn btn-outline" onclick="showRegister()">← Retour</button>
            <button class="btn btn-primary" style="flex:1;justify-content:center;" onclick="showRegister3()">Continuer →</button>
            </div>
        </div>
    </div>
    
    <div class="auth-shell" id="page-register3">
        <div class="auth-visual">
            <div class="auth-visual-brand">🌿 NutriPath</div>
            <p>Choisissez un mot de passe sécurisé pour protéger votre compte.</p>
        </div>
        <div class="auth-form-wrap">
            <div class="step-progress">
            <div class="step done"><div class="step-circle">✓</div><div class="step-label">Infos personnelles</div></div>
            <div class="step-line done"></div>
            <div class="step done"><div class="step-circle">✓</div><div class="step-label">Santé</div></div>
            <div class="step-line done"></div>
            <div class="step active"><div class="step-circle">3</div><div class="step-label">Sécurité</div></div>
            </div>

            <h2>Sécurité du compte</h2>
            <p class="auth-subtitle">Étape 3 — Créez votre mot de passe.</p>

            <div class="form-group password-field">
            <label>Mot de passe</label>
            <input type="password" placeholder="Au moins 8 caractères">
            <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">👁️</button>
            </div>
            <div class="form-group password-field">
            <label>Confirmer le mot de passe</label>
            <input type="password" placeholder="Répétez votre mot de passe">
            <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">👁️</button>
            </div>

            <div style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:14px 18px;margin-bottom:20px;font-size:0.82rem;color:var(--text-muted);line-height:1.7;">
            🔒 Votre mot de passe doit contenir :<br>
            · Au moins 8 caractères · Une majuscule · Un chiffre
            </div>

            <div style="display:flex;gap:12px;">
            <button class="btn btn-outline" onclick="showRegister2()">← Retour</button>
            <button class="btn btn-primary" style="flex:1;justify-content:center;" onclick="showApp()">Créer mon compte ✓</button>
            </div>
        </div>
        </div>

</body>
<script>
    function clearAuth() { document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active')); }
    function showRegister() { clearAuth(); document.getElementById('page-register1').classList.add('active'); }
    function showRegister2() { clearAuth(); document.getElementById('page-register2').classList.add('active'); }
    function showRegister3() { clearAuth(); document.getElementById('page-register3').classList.add('active'); }
    function showLogin() { clearAuth(); document.getElementById('page-login').classList.add('active'); }
    function showApp() { window.location.href = "<?= base_url() ?>"; }
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