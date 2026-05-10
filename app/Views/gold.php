<!--
<?= view('header', ['activeMenu' => 'gold']) ?>

<div class="page active" id="pg-gold">
    <div class="page-header">
        <h1>Option Gold</h1>
        <p>Suivez l'état de votre formule Gold et ses avantages.</p>
    </div>

    <div class="card">
        <div class="card-title">⭐ Statut Gold</div>
        <?php if (!empty($user['is_gold'])): ?>
            <div style="padding:16px;border-radius:14px;background:rgba(74,222,128,0.12);color:#dcfce7;font-size:1.05rem;line-height:1.6;">
                Votre compte est actuellement en mode Gold. Vous bénéficiez déjà des avantages premium.
            </div>
        <?php else: ?>
            <div style="padding:16px;border-radius:14px;background:rgba(96,165,250,0.12);color:#dbeafe;font-size:1.05rem;line-height:1.6;">
                Votre compte n'est pas encore Gold. Cette page peut servir de point d'entrée pour afficher ou activer des avantages premium.
            </div>
        <?php endif; ?>
    </div>
</div>

    </div>
    </div>
        -->
<!-- Jean Pierre -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriPath — Option Gold</title>
    <link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=Satoshi:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<div class="app" id="app-shell" style="display: flex;">

  <?= view('sidebar') ?>

  <div class="main">
    
    <?= view('header') ?>

    <div class="page active" id="pg-gold">
      <div class="page-header">
        <h1>Option Gold ⭐</h1>
        <?php if(!empty($is_gold) && (int) $is_gold === 1): ?>
        <?php else: ?>
          <p>Débloquez des avantages exclusifs en une seule fois</p>
        <?php endif; ?>
      </div>

      <div class="gold-promo">
        <div class="gold-crown">👑</div>
        <div class="gold-promo-content">
          <?php if(!empty($is_gold) && (int) $is_gold === 1): ?>
            <h3>Vous bénéficiez déjà de l'Option Gold !</h3>
          <?php else: ?>
            <h3>Passez à l'Option Gold dès aujourd'hui !</h3>
          <?php endif; ?>  
          <p>Profitez de 15% de remise sur tous les régimes, des recommandations avancées, et d'un accès prioritaire aux nouveaux programmes.</p>
          <?php if(!empty($is_gold) && (int) $is_gold === 1): ?>
            <span class="badge badge-gold">⭐ GOLD ACTIF</span>
          <?php endif; ?>
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
        <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--gold);margin-bottom:6px;">Prix Gold : <?php if(!empty($prix)) { echo number_format($prix, 0, ',', ' '); } ?> Ar</div>
        <div style="font-size:0.85rem;color:var(--text-muted);margin-bottom:16px;">Paiement unique — Accès à vie · Remboursable sur le porte-monnaie NutriPath</div>

        <?php if(!empty($is_gold) && (int) $is_gold === 1): ?>
          <button class="btn btn-gold" style="opacity:0.5;cursor:default;">✓ Déjà actif sur votre compte</button>
        <?php else: ?>
          <button class="btn btn-gold" onclick="activateGold()" style="opacity:1;cursor:default;">Activer sur votre compte</button>
        <?php endif; ?>
        
      </div>
    </div>

  </div></div><div class="notif" id="toast">
  <span class="notif-icon">✅</span>
  <span id="toast-msg">Opération réussie</span>
</div>

<?= view('footer') ?>

<script>
    // 1. Définition des titres (indispensable pour que titles['gold'] fonctionne)
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
        const targetPage = document.getElementById('pg-' + page);
        if (targetPage) targetPage.classList.add('active');

        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        if (el) el.classList.add('active');

        const topbarTitle = document.getElementById('topbar-title');
        if (topbarTitle) topbarTitle.textContent = titles[page] || '';
    }

    function activateGold() {
        // Simuler une activation (dans une vraie app, on ferait une requête AJAX ici)
        const BASE_URL = "<?= base_url(); ?>";

        fetch(BASE_URL + 'gold/activate', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = BASE_URL + 'gold';
            } else {
                alert("Erreur lors de l'enregistrement : " + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert("Une erreur réseau est survenue.");
        });


        showToast('Option Gold activée avec succès !');
        // Après activation, on pourrait aussi mettre à jour l'interface pour refléter le changement
    }

    window.addEventListener('load', () => {
        // 2. Sélection automatique du menu "Option Gold" dans le sidebar
        // On cherche le lien qui appelle la fonction navigate avec 'gold'
        const goldNavItem = document.querySelector('.nav-item[onclick*="gold"]');
        
        // 3. On exécute la navigation vers gold pour mettre à jour le titre ET le menu
        navigate('gold', goldNavItem);

        // Animation des barres (si elles existent)
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