<?php $regime = $monRegime['regime']; $sport = $monRegime['sport']; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Export PDF - <?= esc($regime['nom_regime'] ?? 'Mon régime') ?></title>
  <style>
    :root{--bg:#0b0f0c;--surface:#111614;--surface2:#171d19;--border:#253027;--accent:#4ade80;--accent2:#86efac;--text:#e8f5ec;--text-muted:#a7b8ad;--gold:#f59e0b;--danger:#f87171;--info:#60a5fa;--success:#22c55e}
    *{box-sizing:border-box}
    body{margin:0;font-family:Arial,Helvetica,sans-serif;background:#e9ecef;color:#111}
    .sheet{max-width:980px;margin:24px auto;padding:24px;background:#fff;border-radius:16px;box-shadow:0 12px 40px rgba(0,0,0,.12)}
    .header{display:flex;justify-content:space-between;gap:16px;align-items:flex-start;border-bottom:2px solid #edf2f7;padding-bottom:16px;margin-bottom:20px}
    .brand{font-size:26px;font-weight:800;color:#0f766e}
    .meta{color:#475569;font-size:14px;line-height:1.6;text-align:right}
    .hero{background:linear-gradient(135deg,#ecfeff,#f0fdf4);border:1px solid #d1fae5;border-radius:14px;padding:18px 20px;margin-bottom:20px}
    .hero h1{margin:0 0 6px;font-size:28px}
    .hero p{margin:0;color:#334155}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .card{border:1px solid #e2e8f0;border-radius:14px;padding:18px;background:#fff}
    .card h2{margin:0 0 12px;font-size:18px;color:#0f172a}
    table{width:100%;border-collapse:collapse;font-size:14px}
    td{padding:10px 0;border-bottom:1px solid #eef2f7;vertical-align:top}
    td:first-child{color:#64748b;width:42%}
    .pill{display:inline-block;padding:6px 10px;border-radius:999px;font-weight:700;font-size:12px}
    .pill.accent{background:#dcfce7;color:#166534}
    .pill.info{background:#dbeafe;color:#1d4ed8}
    .pill.gold{background:#fef3c7;color:#92400e}
    .pill.danger{background:#fee2e2;color:#991b1b}
    .progress{height:12px;background:#e2e8f0;border-radius:999px;overflow:hidden}
    .progress > div{height:100%;background:linear-gradient(90deg,#4ade80,#86efac)}
    .footer{display:flex;justify-content:space-between;gap:12px;align-items:center;margin-top:20px;color:#64748b;font-size:12px}
    .actions{display:flex;gap:10px}
    .btn{border:0;border-radius:10px;padding:10px 14px;font-weight:700;cursor:pointer}
    .btn.print{background:#0f172a;color:#fff}
    .btn.close{background:#e2e8f0;color:#0f172a}
    @media print {
      body{background:#fff}
      .sheet{box-shadow:none;margin:0;max-width:none;border-radius:0}
      .actions{display:none}
    }
  </style>
</head>
<body>
  <div class="sheet">
    <div class="header">
      <div>
        <div class="brand">NutriPath</div>
        <div style="color:#64748b;font-size:14px;margin-top:4px;">Export détaillé de votre régime actif</div>
      </div>
      <div class="meta">
        <div><strong>Date d'achat :</strong> <?= date('d/m/Y', strtotime($monRegime['achat']['date_achat'])) ?></div>
        <div><strong>Fin prévue :</strong> <?= esc($monRegime['date_fin']) ?></div>
        <div><strong>Jour courant :</strong> <?= (int) $monRegime['jour_actuel'] ?>/<?= (int) $monRegime['achat']['duree_jours'] ?></div>
      </div>
    </div>

    <div class="hero">
      <h1><?= esc($regime['nom_regime'] ?? 'Régime personnalisé') ?></h1>
      <p>Progression actuelle : <strong><?= number_format($monRegime['pourcentage_avancement'], 1) ?>%</strong> · Poids estimé : <strong><?= number_format($monRegime['poids_estime'], 1) ?> kg</strong></p>
    </div>

    <div class="grid">
      <div class="card">
        <h2>Détails du régime</h2>
        <table>
          <tr><td>Nom</td><td><strong><?= esc($regime['nom_regime'] ?? '-') ?></strong></td></tr>
          <tr><td>Description</td><td><?= esc($regime['description'] ?? '—') ?></td></tr>
          <tr><td>Durée</td><td><?= (int) $monRegime['achat']['duree_jours'] ?> jours</td></tr>
          <tr><td>Prix journalier</td><td><?= number_format((float) ($regime['prix_journalier'] ?? 0), 0, ',', ' ') ?> Ar</td></tr>
          <tr><td>Prix total payé</td><td><strong><?= number_format((float) ($monRegime['achat']['prix_total_paye'] ?? 0), 0, ',', ' ') ?> Ar</strong></td></tr>
          <tr><td>Composition</td><td>
            <span class="pill danger">Viande <?= (int) ($regime['pourcentage_viande'] ?? 0) ?>%</span>
            <span class="pill info">Poisson <?= (int) ($regime['pourcentage_poisson'] ?? 0) ?>%</span>
            <span class="pill gold">Volaille <?= (int) ($regime['pourcentage_volaille'] ?? 0) ?>%</span>
          </td></tr>
        </table>
      </div>

      <div class="card">
        <h2>Détails du sport</h2>
        <table>
          <tr><td>Nom</td><td><strong><?= esc($sport['nom_activite'] ?? '-') ?></strong></td></tr>
          <tr><td>Description</td><td><?= esc($sport['description'] ?? '—') ?></td></tr>
          <tr><td>Effet/jour</td><td><span class="pill accent"><?= number_format((float) ($sport['poids_impact_journalier'] ?? 0), 1) ?> kg</span></td></tr>
          <tr><td>Impact total/jour</td><td><?= number_format((float) (($regime['poids_impact_journalier'] ?? 0) + ($sport['poids_impact_journalier'] ?? 0)), 1) ?> kg</td></tr>
          <tr><td>Objectif poids</td><td><?= number_format((float) ($monRegime['achat']['poids_objectif'] ?? 0), 1) ?> kg</td></tr>
          <tr><td>Poids de départ</td><td><?= number_format((float) ($monRegime['achat']['poids_depart'] ?? 0), 1) ?> kg</td></tr>
        </table>
      </div>
    </div>

    <div class="card" style="margin-top:16px;">
      <h2>Avancement du programme</h2>
      <div class="progress"><div style="width: <?= number_format((float) $monRegime['pourcentage_avancement'], 1, '.', '') ?>%;"></div></div>
      <div style="display:flex;justify-content:space-between;color:#64748b;font-size:13px;margin-top:10px;">
        <span>Début : <?= date('d/m/Y', strtotime($monRegime['achat']['date_achat'])) ?></span>
        <span>Jour <?= (int) $monRegime['jour_actuel'] ?> / <?= (int) $monRegime['achat']['duree_jours'] ?></span>
      </div>
    </div>

    <div class="footer">
      <div>Document généré automatiquement par NutriPath.</div>
      <div class="actions">
        <button class="btn print" onclick="window.print()">Imprimer / Enregistrer en PDF</button>
        <button class="btn close" onclick="window.close()">Fermer</button>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener('load', () => {
      setTimeout(() => window.print(), 350);
    });
  </script>
</body>
</html>