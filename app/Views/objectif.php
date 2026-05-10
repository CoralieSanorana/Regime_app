<!-- Coralie -->
<!--
<?= view('header', ['activeMenu' => 'objectif']) ?>

<div class="page active" id="pg-objectif">
    <div class="page-header">
        <h1>Mon Objectif</h1>
        <p>Définissez votre poids cible pour recevoir des suggestions adaptées.</p>
    </div>

    <div class="grid-2 section-gap">
        <div class="card">
            <div class="card-title">🎯 Choisir un objectif</div>
            <form action="/regimes/suggestions" method="post">
                <div class="form-group">
                    <label>Poids actuel</label>
                    <input type="number" value="<?= esc((string) ($currentWeight ?? '')) ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Poids cible (kg)</label>
                    <input type="number" name="poids_cible" min="1" step="0.1" placeholder="Ex: 65" required>
                </div>
                <input type="hidden" name="user_id" value="<?= esc((string) $user['id']) ?>">
                <input type="submit" class="btn btn-primary" value="Voir les suggestions">
            </form>
        </div>

        <div class="card">
            <div class="card-title">📌 Conseils rapides</div>
            <div style="display:grid;gap:12px;color:var(--text-muted);font-size:0.92rem;line-height:1.6;">
                <div style="padding:14px;border-radius:12px;background:var(--surface2);">Choisissez un objectif réaliste pour recevoir des régimes cohérents.</div>
                <div style="padding:14px;border-radius:12px;background:var(--surface2);">Le système comparera votre poids actuel et vos besoins pour générer les suggestions.</div>
            </div>
        </div>
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
<title>NutriPath — Mon Objectif</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=Satoshi:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<div class="app" id="app-shell">

  <?= view('sidebar') ?>

  <div class="main">
    <?= view('header') ?>

    <div class="page active" id="pg-objectif">
      <div class="page-header">
        <h1>Mon Objectif</h1>
        <p>Définissez votre objectif pour recevoir des régimes adaptés</p>
      </div>

        
        <div class="objective-grid">
          <?php if(!empty($objectifs)): ?>
        
              <?php foreach($objectifs as $obj): ?>
              
                <div class="obj-card" onclick="selectObj(this, '<?= addslashes($obj['libelle']) ?>')">
                  <?php if($obj['libelle'] === 'Perdre du Poids'): ?>
                    <div class="obj-emoji">📉</div>
                  <?php elseif($obj['libelle'] === 'Augmenter son Poids'): ?>
                    <div class="obj-emoji">📈</div>  
                  <?php else: ?>
                    <div class="obj-emoji">⚖️</div>
                  <?php endif; ?>
                  <div class="obj-title"><?= $obj['libelle'] ?></div>
                  <div class="obj-desc"><?= $obj['description'] ?></div>
                </div>

              <?php endforeach; ?>
        
          <?php endif; ?>
        </div>
        
        <div class="card">
          <div class="card-title" style="margin-bottom:1rem; font-weight:600;">🎯 Définir votre poids cible</div>
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:1.5rem;">
            <div class="form-group">
              <label>Poids actuel (kg)</label>
              <input type="number" name="poids_actuel" value="<?php if(!empty($poids_actuel)) echo $poids_actuel; ?>" readonly style="opacity:0.6;"> 
              <!-- la valeur de poids est changer par l'user actif -->
            </div>
            <div class="form-group">
              <label>Poids cible (kg)</label>
              <!-- la valeur de poids cible doit calculer si l'user choisi l'IMC ideal --> 
              <input type="number" name="poids_cible" placeholder="65">
            </div>
          </div>
          <div style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:14px 18px;margin-bottom:20px;font-size:0.85rem;">
            📊 Différence à combler : <strong style="color:var(--accent);">−5 kg</strong> &nbsp;·&nbsp;
            Durée estimée : <strong style="color:var(--info);">~30 à 45 jours</strong>
          </div>
          <button class="btn btn-primary" onclick="navigateToRegime()">
            Voir mes suggestions →
          </button>
        </div>
    </div>

    <?= view('footer') ?>

  </div>
</div>

<div id="toast" class="toast">
    <span id="toast-msg"></span>
</div>

<script>
    const BASE_URL = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('assets/js/objectif.js') ?>"></script>

</body>
</html>