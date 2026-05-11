<!-- Coralie -->
<?php
$session = session();
$userId = $session->get('user_id') ?: 0;
$userNom = $session->get('user_nom') ?: 'Utilisateur';
$userPrenom = $session->get('user_prenom') ?: '';
$userEmail = $session->get('user_email') ?: 'example@example.com';
$userSolde = $session->get('user_solde') ?: 0;
$userRole = $session->get('user_role') ?: 'user';
$initials = strtoupper(substr($userPrenom ?: $userNom, 0, 1) . substr($userNom, 0, 1));
$pageTitle = $page ?? match ($activeMenu ?? '') {
    'dashboard' => 'Tableau de bord',
    'profil' => 'Mon Profil',
    'objectif' => 'Mon Objectif',
    'objectifs' => 'Suggestions',
    'monregime' => 'Mon Régime',
    'porte_monnaie' => 'Porte-monnaie',
    'gold' => 'Option Gold',
    'regimes' => 'Régimes',
    'sports' => 'Sports',
    'codes' => 'Codes Promo',
    default => 'IT-enForme',
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle) ?></title>
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
    <div class="app" id="app-shell" style="display:flex;">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand"><div class="brand-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#activity') ?>"></use></svg></div> IT-enForme</div>

        <?php if ($userRole === 'admin'): ?>
        <div class="nav-section">
        <div class="nav-label">Administration</div>
        <a class="nav-item <?php echo ($activeMenu === 'dashboard') ? 'active' : ''; ?>" href="/dashboard">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#speedometer2') ?>"></use></svg></div> Tableau de bord
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'regimes') ? 'active' : ''; ?>" href="/regimes">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#egg-fried') ?>"></use></svg></div> Régimes
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'sports') ? 'active' : ''; ?>" href="/sports">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#bicycle') ?>"></use></svg></div> Sports
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'codes') ? 'active' : ''; ?>" href="/codes">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#tag') ?>"></use></svg></div> Codes Promo
        </a>
        </div>
        <?php else: ?>
        <div class="nav-section">
        <div class="nav-label">Utilisateur</div>
        <a class="nav-item <?php echo ($activeMenu === 'profil') ? 'active' : ''; ?>" href="/profil">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#person') ?>"></use></svg></div> Profil
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'objectif') ? 'active' : ''; ?>" href="/objectif">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#bullseye') ?>"></use></svg></div> Objectifs
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'monregime') ? 'active' : ''; ?>" href="/monRegime">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#clipboard2-check') ?>"></use></svg></div> Mon régime
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'porte_monnaie') ? 'active' : ''; ?>" href="/porte_monnaie">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#wallet2') ?>"></use></svg></div> Porte monnaie
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'gold') ? 'active' : ''; ?>" href="/gold">
            <div class="icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#star') ?>"></use></svg></div> Gold
        </a>
        </div>
        <?php endif; ?>

        <div class="sidebar-footer">
        <div class="user-card">
            <div class="avatar"><?= $initials ?: 'U' ?></div>
            <div class="user-info">
            <div class="name"><?= esc(trim($userPrenom . ' ' . $userNom)) ?: 'Utilisateur' ?></div>
            <div class="email"><?= esc($userEmail) ?: 'Aucun email' ?></div>
            </div>
        </div>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- TOP BAR -->
        <div class="topbar">
            <div class="topbar-title" id="topbar-title"><?= esc($pageTitle) ?></div>
            <div class="topbar-actions">
                <div class="wallet-badge" onclick="navigate('wallet', null)">
                <svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#wallet2') ?>"></use></svg> <span class="amount"><?= esc((string) $userSolde) ?></span>
                </div>
                <?php if ($session->get('user_gold')): ?>
                    <div class="gold-badge"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#star-fill') ?>"></use></svg> GOLD</div>
                <?php endif; ?>
                <a href="/logout"><button class="btn btn-icon"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#box-arrow-right') ?>"></use></svg></button></a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-message success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash-message error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <script src="<?= base_url('assets/js/neon-bg.js') ?>"></script>
        <script src="<?= base_url('assets/js/ui.js') ?>"></script>
