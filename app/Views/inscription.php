<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IT-enForme — Votre parcours santé</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=Satoshi:wght@300;400;500;700&display=swap" rel="stylesheet">
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
</style>
</head>
<body>

<canvas id="bg"></canvas>

<?php
    $validation = session('validation') ?? [];
    
    // Logique de détection de l'étape active après erreur
    $activeStep = 'page-register1'; // Étape par défaut
    if (isset($validation['poids_actuel']) || isset($validation['taille'])) {
        $activeStep = 'page-register2';
    } elseif (isset($validation['mot_de_passe']) || isset($validation['mot_de_passe_confirmer'])) {
        $activeStep = 'page-register3';
    }
?>

    <form action="<?= base_url('/inscription/save') ?>" method="post">
        <?= csrf_field() ?>

        <!-- ══════════════════════════════════ -->
        <!--      AUTH: REGISTER STEP 1        -->
        <!-- ══════════════════════════════════ -->
        <div class="auth-shell <?= $activeStep === 'page-register1' ? 'active' : '' ?>" id="page-register1">
            <div class="auth-visual">
                <div class="auth-visual-brand"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#activity') ?>"></use></svg> IT-enForme</div>
                <p>Rejoignez des milliers d'utilisateurs qui ont transformé leur alimentation et leur corps.</p>
                <div class="auth-features">
                    <div class="auth-feature"><div class="auth-feature-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#check2-circle') ?>"></use></svg></div><span>Inscription gratuite</span></div>
                    <div class="auth-feature"><div class="auth-feature-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#shield-lock') ?>"></use></svg></div><span>Vos données restent privées</span></div>
                    <div class="auth-feature"><div class="auth-feature-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#lightning-charge') ?>"></use></svg></div><span>Résultats dès le premier jour</span></div>
                </div>
            </div>
            <div class="auth-form-wrap">
                <?php if (isset($validation['db'])): ?>
                    <div class="error-message" style="margin-bottom: 16px;">
                        <span style="font-size: 14px;">!</span> <?= $validation['db'] ?>
                    </div>
                <?php endif; ?>

                <div class="step-progress">
                    <div class="step active"><div class="step-circle">1</div><div class="step-label">Infos personnelles</div></div>
                    <div class="step-line"></div>
                    <div class="step"><div class="step-circle">2</div><div class="step-label">Santé</div></div>
                    <div class="step-line"></div>
                    <div class="step"><div class="step-circle">3</div><div class="step-label">Sécurité</div></div>
                </div>

                <h2>Créer un compte</h2>
                <p class="auth-subtitle">Étape 1 — Vos informations personnelles & contact.</p>

                <div class="form-row">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" placeholder="Jean" class="<?= isset($validation['prenom']) ? 'input-error' : '' ?>" value="<?= old('prenom') ?>">
                        <?php if (isset($validation['prenom'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['prenom'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" placeholder="Dupont" class="<?= isset($validation['nom']) ? 'input-error' : '' ?>" value="<?= old('nom') ?>">
                        <?php if (isset($validation['nom'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['nom'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Genre</label>
                        <select name="genre" class="<?= isset($validation['genre']) ? 'input-error' : '' ?>">
                            <option value="">— Choisir —</option>
                            <option value="M" <?= old('genre') === 'M' ? 'selected' : '' ?>>Homme</option>
                            <option value="F" <?= old('genre') === 'F' ? 'selected' : '' ?>>Femme</option>
                        </select>
                        <?php if (isset($validation['genre'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['genre'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" name="date_naissance" class="<?= isset($validation['date_naissance']) ? 'input-error' : '' ?>" value="<?= old('date_naissance') ?>">
                        <?php if (isset($validation['date_naissance'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['date_naissance'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Adresse Email</label>
                    <input type="email" name="email" placeholder="jean.dupont@mail.com" class="<?= isset($validation['email']) ? 'input-error' : '' ?>" value="<?= old('email') ?>">
                    <?php if (isset($validation['email'])): ?>
                        <div class="error-message"><span>⚠️</span> <?= $validation['email'] ?></div>
                    <?php endif; ?>
                </div>

                <button type="button" class="btn btn-primary" style="width:100%; justify-content:center;" onclick="showStep(2)">Continuer →</button>
                <div style="text-align:center; margin-top:14px; font-size:0.82rem; color:var(--text-muted);">
                  Déjà inscrit ? <a href="<?= base_url('/') ?>" class="auth-link" >Se connecter</a>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════ -->
        <!--      AUTH: REGISTER STEP 2        -->
        <!-- ══════════════════════════════════ -->
        <div class="auth-shell <?= $activeStep === 'page-register2' ? 'active' : '' ?>" id="page-register2">
            <div class="auth-visual">
                <div class="auth-visual-brand"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#activity') ?>"></use></svg> IT-enForme</div>
                <p>Ces informations nous permettent de calculer votre IMC et de vous proposer les meilleurs régimes.</p>
            </div>
            <div class="auth-form-wrap">
                <div class="step-progress">
                    <div class="step done"><div class="step-circle">✓</div><div class="step-label">Infos</div></div>
                    <div class="step-line done"></div>
                    <div class="step active"><div class="step-circle">2</div><div class="step-label">Santé</div></div>
                    <div class="step-line"></div>
                    <div class="step"><div class="step-circle">3</div><div class="step-label">Sécurité</div></div>
                </div>

                <h2>Informations de santé</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Poids actuel (kg)</label>
                        <input type="number" name="poids_actuel" placeholder="70" value="<?= old('poids_actuel') ?>" step="any">
                        <?php if (isset($validation['poids_actuel'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['poids_actuel'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Taille (cm)</label>
                        <input type="number" name="taille" placeholder="175" value="<?= old('taille') ?>" step="any">
                        <?php if (isset($validation['taille'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['taille'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top: 20px;">
                    <button type="button" class="btn btn-outline" onclick="showStep(1)">← Retour</button>
                    <button type="button" class="btn btn-primary" style="flex:1; justify-content:center;" onclick="showStep(3)">Continuer →</button>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════ -->
        <!--      AUTH: REGISTER STEP 3        -->
        <!-- ══════════════════════════════════ -->
        <div class="auth-shell <?= $activeStep === 'page-register3' ? 'active' : '' ?>" id="page-register3">
            <div class="auth-visual">
                <div class="auth-visual-brand"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#activity') ?>"></use></svg> IT-enForme</div>
                <p>Choisissez un mot de passe sécurisé pour protéger votre compte.</p>
            </div>
            <div class="auth-form-wrap">
                <div class="step-progress">
                    <div class="step done"><div class="step-circle">✓</div><div class="step-label">Infos</div></div>
                    <div class="step-line done"></div>
                    <div class="step done"><div class="step-circle">✓</div><div class="step-label">Santé</div></div>
                    <div class="step-line done"></div>
                    <div class="step active"><div class="step-circle">3</div><div class="step-label">Sécurité</div></div>
                </div>

                <h2>Sécurité du compte</h2>
                <div class="form-group password-field">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" class="<?= isset($validation['mot_de_passe']) ? 'input-error' : '' ?>" value="<?= old('mot_de_passe') ?>">
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                    <?php if (isset($validation['mot_de_passe'])): ?>
                        <div class="error-message"><span>⚠️</span> <?= $validation['mot_de_passe'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group password-field">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="mot_de_passe_confirmer" class="<?= isset($validation['mot_de_passe_confirmer']) ? 'input-error' : '' ?>" value="<?= old('mot_de_passe_confirmer') ?>">
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                    <?php if (isset($validation['mot_de_passe_confirmer'])): ?>
                        <div class="error-message"><span>⚠️</span> <?= $validation['mot_de_passe_confirmer'] ?></div>
                    <?php endif; ?>
                </div>

                <div style="display:flex; gap:12px; margin-top: 20px;">
                    <button type="button" class="btn btn-outline" onclick="showStep(2)">← Retour</button>
                    <button type="submit" class="btn btn-primary" style="flex:1; justify-content:center;">Créer mon compte ✓</button>
                </div>
            </div>
        </div>
    </form>

    <script src="<?= base_url('assets/js/neon-bg.js') ?>"></script>
    <script src="<?= base_url('assets/js/ui.js') ?>"></script>
    <script src="<?= base_url('assets/js/inscription.js') ?>"></script>
</body>
</html>