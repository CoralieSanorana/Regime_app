<?php $pageTitle = 'Export PDF - Régimes'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <style>
    body{font-family:Arial,Helvetica,sans-serif;margin:0;background:#eef2f7;color:#0f172a}
    .sheet{max-width:1100px;margin:24px auto;background:#fff;border-radius:16px;box-shadow:0 12px 40px rgba(15,23,42,.12);padding:24px}
    .head{display:flex;justify-content:space-between;gap:16px;align-items:flex-start;border-bottom:2px solid #e2e8f0;padding-bottom:16px;margin-bottom:20px}
    .brand{font-size:26px;font-weight:800;color:#0f766e}
    .meta{font-size:13px;color:#64748b;text-align:right;line-height:1.6}
    table{width:100%;border-collapse:collapse;font-size:13px}
    th,td{padding:12px 10px;border-bottom:1px solid #e2e8f0;text-align:left;vertical-align:top}
    th{background:#f8fafc;font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:#64748b}
    .badge{display:inline-block;padding:4px 10px;border-radius:999px;background:#dcfce7;color:#166534;font-weight:700;font-size:12px}
    .toolbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
    .btn{border:0;border-radius:10px;padding:10px 14px;font-weight:700;cursor:pointer;background:#0f172a;color:#fff}
    @media print {.toolbar{display:none}.sheet{box-shadow:none;margin:0;border-radius:0}body{background:#fff}}
  </style>
</head>
<body>
  <div class="sheet">
    <div class="head">
      <div>
        <div class="brand">NutriPath</div>
        <div style="color:#475569;margin-top:4px;">Liste complète des régimes</div>
      </div>
      <div class="meta">
        <div><strong>Date :</strong> <?= date('d/m/Y H:i') ?></div>
        <div><strong>Total :</strong> <?= count($regimes) ?> régimes</div>
      </div>
    </div>

    <div class="toolbar">
      <div style="color:#475569;font-size:14px;">Export imprimable de la base des régimes</div>
      <button class="btn" onclick="window.print()">Imprimer / PDF</button>
    </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Description</th>
          <th>Viande</th>
          <th>Volaille</th>
          <th>Poisson</th>
          <th>Impact/jour</th>
          <th>Prix journalier</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($regimes as $regime): ?>
          <tr>
            <td>#<?= esc($regime['id']) ?></td>
            <td><strong><?= esc($regime['nom_regime'] ?? '') ?></strong></td>
            <td><?= esc($regime['description'] ?? '') ?></td>
            <td><span class="badge"><?= esc($regime['pourcentage_viande'] ?? 0) ?>%</span></td>
            <td><span class="badge"><?= esc($regime['pourcentage_volaille'] ?? 0) ?>%</span></td>
            <td><span class="badge"><?= esc($regime['pourcentage_poisson'] ?? 0) ?>%</span></td>
            <td><?= esc($regime['poids_impact_journalier'] ?? 0) ?></td>
            <td><?= esc($regime['prix_journalier'] ?? 0) ?> Ar</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script>window.addEventListener('load',()=>setTimeout(()=>window.print(),350));</script>
</body>
</html>