<?php
$session = session();
$userId = $session->get('user_id') ?: 0;
$userNom = $session->get('user_nom') ?: 'Utilisateur';
$userPrenom = $session->get('user_prenom') ?: '';
$userEmail = $session->get('user_email') ?: 'example@example.com';
$userSolde = $session->get('user_solde') ?: 0;
$initials = strtoupper(substr($userPrenom ?: $userNom, 0, 1) . substr($userNom, 0, 1));
?>
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
    <div class="app" id="app-shell" style="display:flex;">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand"><div class="brand-icon">🌿</div> NutriPath</div>

        <div class="nav-section">
        <div class="nav-label">Principal</div>
        <a class="nav-item <?php echo ($activeMenu === 'dashboard') ? 'active' : ''; ?>" onclick="navigate('dashboard', this)">
            <div class="icon">📊</div> Tableau de bord
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'profil') ? 'active' : ''; ?>" href="/profil/<?= $userId ?>">
            <div class="icon">👤</div> Mon Profil
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'objectif') ? 'active' : ''; ?>" onclick="navigate('objectif', this)">
            <div class="icon">🎯</div> Mon Objectif
        </a>
        </div>

        <div class="nav-section">
        <div class="nav-label">Programme</div>
        <a class="nav-item <?php echo ($activeMenu === 'suggestions') ? 'active' : ''; ?>" onclick="navigate('suggestions', this)">
            <div class="icon">🥗</div> Régimes & Activités
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'monregime') ? 'active' : ''; ?>" onclick="navigate('monregime', this)">
            <div class="icon">📋</div> Mon Régime Actuel
        </a>
        </div>

        <div class="nav-section">
        <div class="nav-label">Compte</div>
        <a class="nav-item <?php echo ($activeMenu === 'porte_monnaie') ? 'active' : ''; ?>" href="/porte_monnaie/<?= $userId ?>">
            <div class="icon">💰</div> Porte-monnaie
        </a>
        <a class="nav-item <?php echo ($activeMenu === 'gold') ? 'active' : ''; ?>" onclick="navigate('gold', this)">
            <div class="icon">⭐</div> Option Gold
        </a>
        </div>

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
            <div class="topbar-title" id="topbar-title">Tableau de bord</div>
            <div class="topbar-actions">
                <div class="wallet-badge" onclick="navigate('wallet', null)">
                💰 <span class="amount"><?= esc((string) $userSolde) ?></span>
                </div>
                <div class="gold-badge">⭐ GOLD</div>
                <a href="/logout"><button class="btn btn-icon">🚪</button></a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-message success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash-message error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

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