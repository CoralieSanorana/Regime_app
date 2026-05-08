    <?= view('header', ['activeMenu' => 'monregime']) ?>
    <?php 
    $regime = $monRegime['regime'];
    $sport = $monRegime['sport'];
    ?>
    <div class="page" id="pg-monregime">
      <div class="page-header">
        <h1>Mon Régime Actuel</h1>
        <p>Détails et suivi de votre programme en cours</p>
      </div>

      <div class="export-bar">
        <div>
          <div style="font-weight:600;margin-bottom:2px;"><?= $regime['nom_regime'] ?> · Jour <?= $monRegime['duree_restante'] ?>/<?= $monRegime['achat']['duree_jours'] ?></div>
          <p>Exportez votre programme complet au format PDF</p>
        </div>
        <button class="btn btn-primary btn-sm">📄 Exporter en PDF</button>
      </div>

      <div class="grid-2 section-gap">
        <div class="card">
          <div class="card-title">📋 Détails du régime</div>
          <table>
            <tbody>
              <tr><td style="color:var(--text-muted);width:140px;">Nom du régime</td><td><strong><?= $regime['nom_regime'] ?></strong></td></tr>
              <tr><td style="color:var(--text-muted);">Durée</td><td><?= $monRegime['achat']['duree_jours'] ?> jours</td></tr>
              <tr><td style="color:var(--text-muted);">Effet/jour</td><td style="color:var(--accent);"><?= $regime['poids_impact_journalier'] ?> kg</td></tr>
              <tr><td style="color:var(--text-muted);">Prix/jour</td><td> <?= $regime['prix_journalier'] ?> Ar</td></tr>
              <tr><td style="color:var(--text-muted);">Prix total</td><td style="color:var(--accent);font-weight:700;"><?= $monRegime['achat']['prix_total_paye'] ?> Ar</td></tr>
              <tr><td style="color:var(--text-muted);">% Viande</td><td><span class="badge badge-red"><?= $regime['pourcentage_viande'] ?>%</span></td></tr>
              <tr><td style="color:var(--text-muted);">% Poisson</td><td><span class="badge badge-blue"><?= $regime['pourcentage_poisson'] ?>%</span></td></tr>
              <tr><td style="color:var(--text-muted);">% Volaille</td><td><span class="badge badge-gold"><?= $regime['pourcentage_volaille'] ?>%</span></td></tr>
            </tbody>
          </table>
        </div>

        <div class="card">
          <div class="card-title">📊 Avancement</div>
          <div style="text-align:center;padding:20px 0;">
            <div style="font-family:var(--font-display);font-size:3.5rem;font-weight:700;color:var(--accent);letter-spacing:-0.05em;"><?= $monRegime['duree_restante'] / $monRegime['achat']['duree_jours'] * 100 ?>%</div>
            <div style="color:var(--text-muted);margin-bottom:20px;">Jour <?= $monRegime['duree_restante'] ?> sur <?= $monRegime['achat']['duree_jours'] ?></div>
            <div style="background:var(--surface2);border-radius:100px;height:12px;overflow:hidden;margin-bottom:12px;">
              <div style="width:47%;height:100%;background:linear-gradient(90deg,var(--accent),var(--accent2));border-radius:100px;transition:width 1s;"></div>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:0.78rem;color:var(--text-muted);">
              <span>Début : <?= $monRegime['achat']['date_debut'] ?></span>
              <span>Fin : <?= $monRegime['date_fin'] ?></span>
            </div>
          </div>
          <div style="display:flex;gap:12px;margin-top:12px;">
            <div style="flex:1;text-align:center;padding:14px;background:var(--surface2);border-radius:10px;">
              <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--accent);"><?= $monRegime['achat']['poids_depart']?>kg</div>
              <div style="font-size:0.72rem;color:var(--text-muted);">Poids de depart</div>
            </div>
            <div style="flex:1;text-align:center;padding:14px;background:var(--surface2);border-radius:10px;">
              <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--info);"><?= $monRegime['poids_estime'] ?>kg</div>
              <div style="font-size:0.72rem;color:var(--text-muted);">Poids estimer actuel</div>
            </div>
          </div>
        </div>
      </div>

      <div class="grid-2 section-gap" style="margin-top:24px;">
        <div class="card">
          <div class="card-title">🏃 Activité Sportive</div>
          <table>
            <tbody>
              <tr><td style="color:var(--text-muted);width:140px;">Nom de l'activité</td><td><strong><?= $sport['nom_activite'] ?? 'Non défini' ?></strong></td></tr>
              <tr><td style="color:var(--text-muted);">Description</td><td><?= $sport['description'] ?? 'Aucune description' ?></td></tr>
              <tr><td style="color:var(--text-muted);">Effet/jour</td><td style="color:var(--accent);"><?= $sport['effet_jour'] ?? 0 ?> kg</td></tr>
            </tbody>
          </table>
        </div>

        <div class="card">
          <div class="card-title">⚖️ Récapitulatif Poids</div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;padding:16px 0;">
            <div style="text-align:center;padding:16px;background:var(--surface2);border-radius:10px;">
              <div style="color:var(--text-muted);font-size:0.85rem;margin-bottom:8px;">Poids de départ</div>
              <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--accent);"><?= $monRegime['achat']['poids_depart'] ?></div>
              <div style="color:var(--text-muted);font-size:0.75rem;margin-top:4px;">kg</div>
            </div>
            <div style="text-align:center;padding:16px;background:var(--surface2);border-radius:10px;">
              <div style="color:var(--text-muted);font-size:0.85rem;margin-bottom:8px;">Poids estimé actuel</div>
              <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--info);"><?= $monRegime['poids_estime'] ?></div>
              <div style="color:var(--text-muted);font-size:0.75rem;margin-top:4px;">kg</div>
            </div>
            <div style="text-align:center;padding:16px;background:var(--surface2);border-radius:10px;">
              <div style="color:var(--text-muted);font-size:0.85rem;margin-bottom:8px;">Objectif</div>
              <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--success);"><?= $monRegime['achat']['poids_objectif'] ?></div>
              <div style="color:var(--text-muted);font-size:0.75rem;margin-top:4px;">kg</div>
            </div>
            <div style="text-align:center;padding:16px;background:var(--surface2);border-radius:10px;">
              <div style="color:var(--text-muted);font-size:0.85rem;margin-bottom:8px;">À perdre</div>
              <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:700;color:var(--warning);"><?= $monRegime['achat']['poids_depart'] - $monRegime['achat']['poids_objectif'] ?></div>
              <div style="color:var(--text-muted);font-size:0.75rem;margin-top:4px;">kg</div>
            </div>
          </div>
        </div>
      </div>
    </div>