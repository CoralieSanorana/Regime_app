<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NutriPath — Votre parcours santé</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=Satoshi:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<!-- ══════════════════════════════════ -->
<!--        AUTH: LOGIN PAGE           -->
<!-- ══════════════════════════════════ -->
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

    <div class="form-group">
      <label>Adresse Email</label>
      <input type="email" placeholder="exemple@email.com">
    </div>
    <div class="form-group">
      <label>Mot de passe</label>
      <input type="password" placeholder="••••••••">
    </div>

    <button class="btn btn-primary" style="width:100%; justify-content:center; margin-bottom:16px;" onclick="showApp()">
      Se connecter →
    </button>

    <p style="text-align:center; font-size:0.85rem; color:var(--text-muted);">
      Pas encore de compte ? <a class="auth-link" onclick="showRegister()">Créer un compte</a>
    </p>
  </div>
</div>

<!-- ══════════════════════════════════ -->
<!--      AUTH: REGISTER STEP 1        -->
<!-- ══════════════════════════════════ -->
<div class="auth-shell" id="page-register1">
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

<!-- ══════════════════════════════════ -->
<!--      AUTH: REGISTER STEP 2        -->
<!-- ══════════════════════════════════ -->
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

<!-- ══════════════════════════════════ -->
<!--      AUTH: REGISTER STEP 3        -->
<!-- ══════════════════════════════════ -->
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

    <div class="form-group">
      <label>Mot de passe</label>
      <input type="password" placeholder="Au moins 8 caractères">
    </div>
    <div class="form-group">
      <label>Confirmer le mot de passe</label>
      <input type="password" placeholder="Répétez votre mot de passe">
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

<!-- ══════════════════════════════════ -->
<!--           MAIN APP SHELL          -->
<!-- ══════════════════════════════════ -->
<div class="app" id="app-shell" style="display:none;">

  <!-- SIDEBAR -->
    <?= view('sidebar') ?>

  <!-- MAIN -->
  <div class="main">

    <!-- TOP BAR -->
    <?= view('header') ?>

    <!-- ──────────── PAGE: DASHBOARD ──────────── -->
    <div class="page active" id="pg-dashboard">
      <div class="page-header">
        <h1><span class="accent-dot"></span>Tableau de bord</h1>
        <p>Vue d'ensemble de votre parcours santé — Semaine 3</p>
      </div>

      <div class="grid-4 section-gap">
        <div class="stat-card green">
          <div class="stat-label"><div class="stat-icon">⚖️</div> Poids actuel</div>
          <div class="stat-value">70<span style="font-size:1rem;">kg</span></div>
          <div class="stat-sub">Objectif : 65 kg · −5 kg restants</div>
        </div>
        <div class="stat-card blue">
          <div class="stat-label"><div class="stat-icon">📏</div> IMC</div>
          <div class="stat-value">22.9</div>
          <div class="stat-sub">Poids normal · Zone idéale</div>
        </div>
        <div class="stat-card gold">
          <div class="stat-label"><div class="stat-icon">🥗</div> Régime actif</div>
          <div class="stat-value">J14</div>
          <div class="stat-sub">Régime Méditerranéen · 30j</div>
        </div>
        <div class="stat-card red">
          <div class="stat-label"><div class="stat-icon">💰</div> Solde</div>
          <div class="stat-value">85K</div>
          <div class="stat-sub">Ariary · Porte-monnaie</div>
        </div>
      </div>

      <div class="grid-2 section-gap">
        <div class="card">
          <div class="card-title">📈 Évolution du poids (kg)</div>
          <div class="chart-bar-wrap">
            <div class="chart-bar bar-green" style="height:65%"></div>
            <div class="chart-bar bar-green" style="height:72%"></div>
            <div class="chart-bar bar-green" style="height:68%"></div>
            <div class="chart-bar bar-green" style="height:80%"></div>
            <div class="chart-bar bar-green" style="height:75%"></div>
            <div class="chart-bar bar-green" style="height:70%"></div>
            <div class="chart-bar bar-green" style="height:62%"></div>
          </div>
          <div style="display:flex;justify-content:space-between;margin-top:10px;font-size:0.72rem;color:var(--text-muted);">
            <span>Lun</span><span>Mar</span><span>Mer</span><span>Jeu</span><span>Ven</span><span>Sam</span><span>Dim</span>
          </div>
        </div>
        <div class="card">
          <div class="card-title">🏃 Activités cette semaine</div>
          <div class="chart-bar-wrap">
            <div class="chart-bar bar-blue" style="height:40%"></div>
            <div class="chart-bar bar-blue" style="height:0%"></div>
            <div class="chart-bar bar-blue" style="height:60%"></div>
            <div class="chart-bar bar-blue" style="height:80%"></div>
            <div class="chart-bar bar-blue" style="height:0%"></div>
            <div class="chart-bar bar-blue" style="height:55%"></div>
            <div class="chart-bar bar-blue" style="height:30%"></div>
          </div>
          <div style="display:flex;justify-content:space-between;margin-top:10px;font-size:0.72rem;color:var(--text-muted);">
            <span>Lun</span><span>Mar</span><span>Mer</span><span>Jeu</span><span>Ven</span><span>Sam</span><span>Dim</span>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-title">⚡ Programme en cours</div>
        <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
          <div style="flex:1;min-width:200px;">
            <div style="font-family:var(--font-display);font-size:1.1rem;margin-bottom:6px;">Régime Méditerranéen</div>
            <div style="font-size:0.82rem;color:var(--text-muted);margin-bottom:14px;">Jour 14 sur 30 · −0.2kg/jour</div>
            <div style="background:var(--surface2);border-radius:100px;height:8px;overflow:hidden;">
              <div style="width:47%;height:100%;background:linear-gradient(90deg,var(--accent),var(--accent2));border-radius:100px;"></div>
            </div>
            <div style="font-size:0.75rem;color:var(--text-muted);margin-top:6px;">47% complété</div>
          </div>
          <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <div style="text-align:center;padding:12px 20px;background:var(--surface2);border-radius:12px;">
              <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--accent);">−2.8<span style="font-size:0.9rem;">kg</span></div>
              <div style="font-size:0.72rem;color:var(--text-muted);">Perdu</div>
            </div>
            <div style="text-align:center;padding:12px 20px;background:var(--surface2);border-radius:12px;">
              <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--info);">16j</div>
              <div style="font-size:0.72rem;color:var(--text-muted);">Restants</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ──────────── PAGE: PROFIL ──────────── -->
    <div class="page" id="pg-profil">
      <div class="page-header">
        <h1>Mon Profil</h1>
        <p>Gérez vos informations personnelles et de santé</p>
      </div>

      <div class="grid-2 section-gap">
        <div class="card">
          <div class="card-title">👤 Informations personnelles</div>
          <div class="form-row">
            <div class="form-group"><label>Prénom</label><input type="text" value="Jean"></div>
            <div class="form-group"><label>Nom</label><input type="text" value="Dupont"></div>
          </div>
          <div class="form-group"><label>Date de naissance</label><input type="date" value="1995-06-15"></div>
          <div class="form-group"><label>Email</label><input type="email" value="jean.dupont@mail.com"></div>
          <div class="form-group"><label>Adresse</label><input type="text" value="123 Rue de la Santé, Antananarivo"></div>
          <button class="btn btn-primary btn-sm">💾 Sauvegarder</button>
        </div>

        <div>
          <div class="card section-gap">
            <div class="card-title">🏥 Informations de santé</div>
            <div class="form-row">
              <div class="form-group"><label>Genre</label><select><option>Homme</option><option>Femme</option></select></div>
              <div class="form-group"><label>Poids actuel (kg)</label><input type="number" value="70"></div>
            </div>
            <div class="form-group"><label>Taille (cm)</label><input type="number" value="175"></div>
            <button class="btn btn-outline btn-sm">🔄 Recalculer l'IMC</button>
          </div>

          <div class="imc-display">
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
              <div style="font-size:0.82rem;color:var(--text-muted);">IMC idéal : 18.5 – 24.9<br>Votre IMC est dans la zone saine.</div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-title">🔒 Sécurité</div>
        <div class="form-row">
          <div class="form-group"><label>Mot de passe actuel</label><input type="password" placeholder="••••••••"></div>
          <div class="form-group"><label>Nouveau mot de passe</label><input type="password" placeholder="••••••••"></div>
        </div>
        <button class="btn btn-outline btn-sm">🔑 Changer le mot de passe</button>
      </div>
    </div>

    <!-- ──────────── PAGE: OBJECTIF ──────────── -->
    <div class="page" id="pg-objectif">
      <div class="page-header">
        <h1>Mon Objectif</h1>
        <p>Définissez votre objectif pour recevoir des régimes adaptés</p>
      </div>

      <div class="objective-grid section-gap">
        <div class="obj-card selected" onclick="selectObj(this)">
          <div class="obj-emoji">📉</div>
          <div class="obj-title">Perdre du poids</div>
          <div class="obj-desc">Réduisez votre poids corporel avec un programme adapté à votre métabolisme.</div>
        </div>
        <div class="obj-card" onclick="selectObj(this)">
          <div class="obj-emoji">📈</div>
          <div class="obj-title">Augmenter son poids</div>
          <div class="obj-desc">Prenez de la masse musculaire ou retrouvez un poids sain grâce à des régimes riches.</div>
        </div>
        <div class="obj-card" onclick="selectObj(this)">
          <div class="obj-emoji">⚖️</div>
          <div class="obj-title">Atteindre l'IMC idéal</div>
          <div class="obj-desc">Atteignez et maintenez un IMC optimal entre 18.5 et 24.9.</div>
        </div>
      </div>

      <div class="card section-gap">
        <div class="card-title">🎯 Définir votre poids cible</div>
        <div class="form-row">
          <div class="form-group">
            <label>Poids actuel (kg)</label>
            <input type="number" value="70" readonly style="opacity:0.6;">
          </div>
          <div class="form-group">
            <label>Poids cible (kg)</label>
            <input type="number" placeholder="65">
          </div>
        </div>
        <div style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:14px 18px;margin-bottom:20px;font-size:0.85rem;">
          📊 Différence à combler : <strong style="color:var(--accent);">−5 kg</strong> &nbsp;·&nbsp;
          Durée estimée : <strong style="color:var(--info);">~30 à 45 jours</strong>
        </div>
        <button class="btn btn-primary" onclick="navigate('suggestions', null); showNotif('Objectif défini ! Voici vos suggestions personnalisées.')">
          Voir mes suggestions →
        </button>
      </div>
    </div>

    <!-- ──────────── PAGE: SUGGESTIONS ──────────── -->
    <div class="page" id="pg-suggestions">
      <div class="page-header">
        <h1>Suggestions Personnalisées</h1>
        <p>Régimes et activités adaptés à votre objectif : perdre 5 kg</p>
      </div>

      <div class="toggle">
        <button class="toggle-btn active" onclick="switchTab(this,'tab-regimes')">🥗 Régimes</button>
        <button class="toggle-btn" onclick="switchTab(this,'tab-activites')">🏃 Activités sportives</button>
      </div>

      <div id="tab-regimes">
        <div class="export-bar">
          <div>
            <div style="font-weight:600;margin-bottom:2px;">5 régimes disponibles pour votre profil</div>
            <p>Choisissez un régime pour obtenir votre plan complet exportable en PDF</p>
          </div>
          <button class="btn btn-outline btn-sm">📄 Exporter PDF</button>
        </div>

        <div class="regime-list">
          <div class="regime-card selected" onclick="selectRegime(this)">
            <div>
              <div class="regime-name">🌿 Régime Méditerranéen</div>
              <div class="regime-nutrients">
                <span class="nutrient-pill n-viande">🥩 Viande 30%</span>
                <span class="nutrient-pill n-poisson">🐟 Poisson 45%</span>
                <span class="nutrient-pill n-volaille">🍗 Volaille 25%</span>
              </div>
              <div class="regime-effect">Effet : −0.2 kg/jour · Durée recommandée : 30 jours</div>
            </div>
            <div class="regime-price">
              <div class="price-total">42 000 Ar</div>
              <div class="price-sub">1 400 Ar/jour</div>
              <div class="duration-tag">30 jours</div>
            </div>
          </div>

          <div class="regime-card" onclick="selectRegime(this)">
            <div>
              <div class="regime-name">🥦 Régime Végétarien Actif</div>
              <div class="regime-nutrients">
                <span class="nutrient-pill n-viande">🥩 Viande 10%</span>
                <span class="nutrient-pill n-poisson">🐟 Poisson 20%</span>
                <span class="nutrient-pill n-volaille">🍗 Volaille 70%</span>
              </div>
              <div class="regime-effect">Effet : −0.15 kg/jour · Durée recommandée : 45 jours</div>
            </div>
            <div class="regime-price">
              <div class="price-total">54 000 Ar</div>
              <div class="price-sub">1 200 Ar/jour</div>
              <div class="duration-tag">45 jours</div>
            </div>
          </div>

          <div class="regime-card" onclick="selectRegime(this)">
            <div>
              <div class="regime-name">💪 Régime Protéiné Sport</div>
              <div class="regime-nutrients">
                <span class="nutrient-pill n-viande">🥩 Viande 50%</span>
                <span class="nutrient-pill n-poisson">🐟 Poisson 20%</span>
                <span class="nutrient-pill n-volaille">🍗 Volaille 30%</span>
              </div>
              <div class="regime-effect">Effet : −0.25 kg/jour · Durée recommandée : 20 jours</div>
            </div>
            <div class="regime-price">
              <div class="price-total">36 000 Ar</div>
              <div class="price-sub">1 800 Ar/jour</div>
              <div class="duration-tag">20 jours</div>
            </div>
          </div>
        </div>
      </div>

      <div id="tab-activites" style="display:none;">
        <div class="activity-grid">
          <div class="activity-card">
            <div class="activity-icon">🏃</div>
            <div class="activity-name">Course à pied</div>
            <div class="activity-detail">30–45 min/jour · Brûle ~300 kcal · Intensité modérée<br><span style="color:var(--accent);">Très compatible avec votre régime</span></div>
          </div>
          <div class="activity-card">
            <div class="activity-icon">🚴</div>
            <div class="activity-name">Vélo / Cyclisme</div>
            <div class="activity-detail">45 min/jour · Brûle ~280 kcal · Faible impact<br><span style="color:var(--accent);">Idéal pour débutants</span></div>
          </div>
          <div class="activity-card">
            <div class="activity-icon">🏊</div>
            <div class="activity-name">Natation</div>
            <div class="activity-detail">30 min/jour · Brûle ~350 kcal · Haute efficacité<br><span style="color:var(--info);">Recommandé par le système</span></div>
          </div>
          <div class="activity-card">
            <div class="activity-icon">🧘</div>
            <div class="activity-name">Yoga & Stretching</div>
            <div class="activity-detail">20 min/jour · Réduit le stress · Tonifie<br><span style="color:var(--text-muted);">En complément</span></div>
          </div>
          <div class="activity-card">
            <div class="activity-icon">🏋️</div>
            <div class="activity-name">Musculation légère</div>
            <div class="activity-detail">3x/semaine · Construit la masse · Brûle +kcal<br><span style="color:var(--gold);">Option Gold recommandée</span></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ──────────── PAGE: MON RÉGIME ──────────── -->
    <div class="page" id="pg-monregime">
      <div class="page-header">
        <h1>Mon Régime Actuel</h1>
        <p>Détails et suivi de votre programme en cours</p>
      </div>

      <div class="export-bar">
        <div>
          <div style="font-weight:600;margin-bottom:2px;">Régime Méditerranéen · Jour 14/30</div>
          <p>Exportez votre programme complet au format PDF</p>
        </div>
        <button class="btn btn-primary btn-sm" onclick="showNotif('📄 PDF généré avec succès !')">📄 Exporter en PDF</button>
      </div>

      <div class="grid-2 section-gap">
        <div class="card">
          <div class="card-title">📋 Détails du régime</div>
          <table>
            <tbody>
              <tr><td style="color:var(--text-muted);width:140px;">Nom</td><td><strong>Régime Méditerranéen</strong></td></tr>
              <tr><td style="color:var(--text-muted);">Durée</td><td>30 jours</td></tr>
              <tr><td style="color:var(--text-muted);">Effet/jour</td><td style="color:var(--accent);">−0.2 kg</td></tr>
              <tr><td style="color:var(--text-muted);">Prix/jour</td><td>1 400 Ar</td></tr>
              <tr><td style="color:var(--text-muted);">Prix total</td><td style="color:var(--accent);font-weight:700;">42 000 Ar</td></tr>
              <tr><td style="color:var(--text-muted);">% Viande</td><td><span class="badge badge-red">30%</span></td></tr>
              <tr><td style="color:var(--text-muted);">% Poisson</td><td><span class="badge badge-blue">45%</span></td></tr>
              <tr><td style="color:var(--text-muted);">% Volaille</td><td><span class="badge badge-gold">25%</span></td></tr>
            </tbody>
          </table>
        </div>

        <div class="card">
          <div class="card-title">📊 Avancement</div>
          <div style="text-align:center;padding:20px 0;">
            <div style="font-family:var(--font-display);font-size:3.5rem;font-weight:700;color:var(--accent);letter-spacing:-0.05em;">47%</div>
            <div style="color:var(--text-muted);margin-bottom:20px;">Jour 14 sur 30</div>
            <div style="background:var(--surface2);border-radius:100px;height:12px;overflow:hidden;margin-bottom:12px;">
              <div style="width:47%;height:100%;background:linear-gradient(90deg,var(--accent),var(--accent2));border-radius:100px;transition:width 1s;"></div>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.78rem;color:var(--text-muted);">
              <span>Début : 22 Avr</span>
              <span>Fin : 22 Mai</span>
            </div>
          </div>
          <div style="display:flex;gap:12px;margin-top:12px;">
            <div style="flex:1;text-align:center;padding:14px;background:var(--surface2);border-radius:10px;">
              <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--accent);">−2.8kg</div>
              <div style="font-size:0.72rem;color:var(--text-muted);">Perdu</div>
            </div>
            <div style="flex:1;text-align:center;padding:14px;background:var(--surface2);border-radius:10px;">
              <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--info);">−2.2kg</div>
              <div style="font-size:0.72rem;color:var(--text-muted);">Restant</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ──────────── PAGE: WALLET ──────────── -->
    <div class="page" id="pg-wallet">
      <div class="page-header">
        <h1>Porte-monnaie</h1>
        <p>Gérez votre solde et rechargez avec un code</p>
      </div>

      <div class="wallet-display">
        <div class="wallet-balance-label">Solde disponible</div>
        <div class="wallet-balance">85 000 <span class="wallet-currency">Ar</span></div>
        <div style="font-size:0.82rem;color:var(--text-muted);">Dernière recharge : +20 000 Ar — 3 mai 2026</div>
      </div>

      <div class="grid-2 section-gap">
        <div class="card">
          <div class="card-title">🔑 Recharger avec un code</div>
          <div class="form-group">
            <label>Code de recharge</label>
            <input type="text" placeholder="Ex: NUTRI-XXXX-XXXX" style="text-transform:uppercase;letter-spacing:0.05em;">
          </div>
          <button class="btn btn-primary" style="width:100%;justify-content:center;" onclick="showNotif('✅ Code validé ! +20 000 Ar ajoutés.')">
            💳 Valider le code
          </button>
          <div style="margin-top:14px;padding:12px 16px;background:var(--surface2);border-radius:10px;font-size:0.8rem;color:var(--text-muted);">
            ℹ️ Les codes de recharge sont disponibles auprès de nos partenaires ou en ligne.
          </div>
        </div>

        <div class="card">
          <div class="card-title">📜 Historique des transactions</div>
          <div class="wallet-transactions">
            <div class="transaction-item tx-credit">
              <div class="tx-info"><div class="tx-icon">➕</div><div><div class="tx-label">Recharge code</div><div class="tx-date">3 mai 2026</div></div></div>
              <div class="tx-amount">+20 000 Ar</div>
            </div>
            <div class="transaction-item tx-debit">
              <div class="tx-info"><div class="tx-icon">🥗</div><div><div class="tx-label">Achat régime méditerranéen</div><div class="tx-date">1 mai 2026</div></div></div>
              <div class="tx-amount">−42 000 Ar</div>
            </div>
            <div class="transaction-item tx-credit">
              <div class="tx-info"><div class="tx-icon">➕</div><div><div class="tx-label">Recharge code</div><div class="tx-date">28 avr 2026</div></div></div>
              <div class="tx-amount">+50 000 Ar</div>
            </div>
            <div class="transaction-item tx-credit">
              <div class="tx-info"><div class="tx-icon">➕</div><div><div class="tx-label">Recharge code</div><div class="tx-date">15 avr 2026</div></div></div>
              <div class="tx-amount">+57 000 Ar</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ──────────── PAGE: GOLD ──────────── -->
    <div class="page" id="pg-gold">
      <div class="page-header">
        <h1>Option Gold ⭐</h1>
        <p>Débloquez des avantages exclusifs en une seule fois</p>
      </div>

      <div class="gold-promo">
        <div class="gold-crown">👑</div>
        <div class="gold-promo-content">
          <h3>Vous bénéficiez déjà de l'Option Gold !</h3>
          <p>Profitez de 15% de remise sur tous les régimes, des recommandations avancées, et d'un accès prioritaire aux nouveaux programmes.</p>
          <span class="badge badge-gold">⭐ GOLD ACTIF</span>
        </div>
      </div>

      <div class="grid-3">
        <div class="card" style="border-color:rgba(245,158,11,0.2);">
          <div style="font-size:2rem;margin-bottom:12px;">💰</div>
          <div style="font-family:var(--font-display);font-weight:600;margin-bottom:6px;">-15% sur les régimes</div>
          <div style="font-size:0.82rem;color:var(--text-muted);">Réduction automatique appliquée sur chaque achat de régime.</div>
        </div>
        <div class="card" style="border-color:rgba(245,158,11,0.2);">
          <div style="font-size:2rem;margin-bottom:12px;">🎯</div>
          <div style="font-family:var(--font-display);font-weight:600;margin-bottom:6px;">Recommandations avancées</div>
          <div style="font-size:0.82rem;color:var(--text-muted);">Algorithme de suggestion plus précis avec suivi personnalisé.</div>
        </div>
        <div class="card" style="border-color:rgba(245,158,11,0.2);">
          <div style="font-size:2rem;margin-bottom:12px;">📊</div>
          <div style="font-family:var(--font-display);font-weight:600;margin-bottom:6px;">Statistiques détaillées</div>
          <div style="font-size:0.82rem;color:var(--text-muted);">Accès à l'historique complet et aux graphiques d'évolution.</div>
        </div>
      </div>

      <div style="margin-top:24px;padding:24px;background:var(--surface);border:1px dashed rgba(245,158,11,0.25);border-radius:var(--radius);text-align:center;">
        <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--gold);margin-bottom:6px;">Prix Gold : 30 000 Ar</div>
        <div style="font-size:0.85rem;color:var(--text-muted);margin-bottom:16px;">Paiement unique — Accès à vie · Remboursable sur le porte-monnaie NutriPath</div>
        <button class="btn btn-gold" style="opacity:0.5;cursor:default;">✓ Déjà actif sur votre compte</button>
      </div>
    </div>

  </div><!-- /main -->
</div><!-- /app -->

<!-- NOTIFICATION TOAST -->
<div class="notif" id="toast">
  <span class="notif-icon">✅</span>
  <span id="toast-msg">Opération réussie</span>
</div>

    <?= view('footer') ?>

<script>
  // ── NAVIGATION AUTH ──
  function showLogin() {
    document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
    document.getElementById('page-login').classList.add('active');
  }
  function showRegister() {
    document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
    document.getElementById('page-register1').classList.add('active');
  }
  function showRegister2() {
    document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
    document.getElementById('page-register2').classList.add('active');
  }
  function showRegister3() {
    document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
    document.getElementById('page-register3').classList.add('active');
  }

  function showApp() {
    document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
    document.getElementById('app-shell').style.display = 'flex';
    showNotif('🌿 Bienvenue sur NutriPath, Jean !');
  }

  function showLogout() {
    document.getElementById('app-shell').style.display = 'none';
    showLogin();
  }

  // ── MAIN NAV ──
  const titles = {
    dashboard: 'Tableau de bord',
    profil: 'Mon Profil',
    objectif: 'Mon Objectif',
    suggestions: 'Régimes & Activités',
    monregime: 'Mon Régime Actuel',
    wallet: 'Porte-monnaie',
    gold: 'Option Gold ⭐'
  };

  function navigate(page, el) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById('pg-' + page).classList.add('active');
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    if (el) el.classList.add('active');
    document.getElementById('topbar-title').textContent = titles[page] || '';
  }

  // ── TABS ──
  function switchTab(btn, tabId) {
    document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('tab-regimes').style.display = tabId === 'tab-regimes' ? 'block' : 'none';
    document.getElementById('tab-activites').style.display = tabId === 'tab-activites' ? 'block' : 'none';
  }

  // ── SELECTION ──
  function selectObj(el) {
    document.querySelectorAll('.obj-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
  }

  function selectRegime(el) {
    document.querySelectorAll('.regime-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    showNotif('✅ Régime sélectionné ! Consultez "Mon Régime Actuel".');
  }

  // ── TOAST ──
  let toastTimer;
  function showNotif(msg) {
    const toast = document.getElementById('toast');
    document.getElementById('toast-msg').textContent = msg;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('show'), 3500);
  }

  // ── ANIMATE BARS ON LOAD ──
  window.addEventListener('load', () => {
    const bars = document.querySelectorAll('.chart-bar');
    bars.forEach((b, i) => {
      const h = b.style.height;
      b.style.height = '0';
      setTimeout(() => b.style.height = h, 200 + i * 60);
    });
  });
</script>
</body>
</html>
