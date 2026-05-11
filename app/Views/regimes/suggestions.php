<?php $page = 'Suggestions'; ?>
    <?= view('header', ['activeMenu' => 'objectifs']) ?>
    <div class="page active" id="pg-suggestions">
      <style>
        /* Styles locaux pour le bouton d'achat */
        .export-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border-radius:10px;border:0;cursor:pointer;font-weight:600;background:linear-gradient(90deg,#ff7a59,#ff4d8a);color:#fff;box-shadow:0 6px 18px rgba(255,77,138,0.18);transition:transform .15s ease,box-shadow .15s ease,opacity .15s ease}
        .export-btn:hover{transform:translateY(-3px);box-shadow:0 10px 26px rgba(255,77,138,0.22)}
        .export-btn:active{transform:translateY(-1px);opacity:0.95}
        .export-btn .icon{display:inline-block;width:18px;height:18px;font-size:14px;line-height:18px}
      </style>
      <?php 
        // Debug: vérifier que couples existe
        if (!isset($couples)) {
          $couples = [];
        }
      ?>
      <div class="page-header">
        <h1>Suggestions Personnalisées</h1>
        <p>Régimes et activités adaptés à votre objectif : 
          <?php 
            if (!empty($couples) && is_array($couples) && isset($couples[0]) && is_array($couples[0])) {
              $diff = abs($couples[0]['poids_cible'] - $couples[0]['poids_actuel']);
              $direction = $couples[0]['poids_cible'] < $couples[0]['poids_actuel'] ? 'perdre' : 'gagner';
              echo "$direction $diff kg";
            }
          ?>
        </p>
      </div>

      <div class="toggle">
        <button class="toggle-btn active"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#egg-fried') ?>"></use></svg> Régimes + 
          <img src="<?= base_url('assets/images/sport.png') ?>" width="20" height="20" alt="Activité sportive"> Activités sportives</button>
      </div>

      <div id="tab-regimes">
        <div class="export-bar">
          <div>
            <div style="font-weight:600;margin-bottom:2px;"><?= count($couples) ?? 0 ?> régimes disponibles pour votre profil</div>
            <p>Choisissez un régime pour obtenir votre plan complet exportable en PDF</p>
          </div>
        </div>

        <?php if (empty($couples)): ?>
          <div style="text-align: center; padding: 2rem; background: var(--surface); border-radius: 12px;">
            <div style="font-size: 3rem; margin-bottom: 1rem;"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#emoji-frown') ?>"></use></svg></div>
            <h3>Aucun régime trouvé</h3>
            <p style="color: var(--text-muted);">Impossible de trouver un régime correspondant à vos critères. Veuillez ajuster votre poids cible.</p>
            <a href="/objectif" class="btn btn-primary" style="margin-top: 1rem;">Modifier mon objectif</a>
          </div>
        <?php else: ?>
          <div class="regime-list">
            <?php 
            if (is_array($couples) && !empty($couples)):
              foreach ($couples as $couple): 
                if (!isset($couple['regime']) || !isset($couple['sport'])) {
                  continue;
                }
                $regime = $couple['regime'];
                $sport = $couple['sport'];
            ?>
                <div class="regime-card">
                    <div class="regime-info">
                        <div class="regime-name"><?= $regime['nom_regime'] ?? 'Régime sans nom' ?></div>
                        <div class="regime-nutrients">
                            <span class="nutrient-pill n-viande"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#egg') ?>"></use></svg> Viande <?= $regime['pourcentage_viande'] ?? '0' ?>%</span>
                            <span class="nutrient-pill n-poisson"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#droplet') ?>"></use></svg> Poisson <?= $regime['pourcentage_poisson'] ?? '0' ?>%</span>
                            <span class="nutrient-pill n-volaille"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#egg-fried') ?>"></use></svg> Volaille <?= $regime['pourcentage_volaille'] ?? '0' ?>%</span>
                        </div>
                        <div class="regime-effect">Effet : <?= $regime['poids_impact_journalier'] ?? '0' ?> kg/jour · Durée recommandée : <?= $couple['duree_jours'] ?? '0' ?> jours</div>
                    </div>
                    <div class="activity-card">
                        <div class="activity-icon"><img src="<?= base_url('assets/images/sport.png') ?>" width="50" height="50" alt="Activité sportive"></div>
                        <div class="activity-name"><?= $sport['nom_activite'] ?? 'Activité' ?></div>
                        <div class="activity-detail"><?= $sport['description'] ?? 'Description indisponible' ?> · Brûle ~<?= $sport['poids_impact_journalier'] ?? '0' ?> kcal · Intensité modérée<br><span style="color:var(--accent);">Très compatible avec votre régime</span></div>
                    </div>
                    <div class="regime-price">
                        <div class="price-total"><?= $couple['prix_total'] ?? '0' ?> Ar</div>
                        <div class="price-sub"><?= $regime['prix_journalier'] ?? '0' ?> Ar/jour</div>
                        <div class="duration-tag"><?= $couple['duree_jours'] ?? '0' ?> jours</div>
                    </div>
                    <form action="/regimes/achat" method="post">
                        <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?? '' ?>">
                        <input type="hidden" name="regime_id" value="<?= $regime['id'] ?? '' ?>">
                        <input type="hidden" name="sport_id" value="<?= $sport['id'] ?? '' ?>">
                        <input type="hidden" name="duree_jours" value="<?= $couple['duree_jours'] ?? '' ?>">
                        <input type="hidden" name="prix_total" value="<?= $couple['prix_total'] ?? '' ?>">
                        <input type="hidden" name="poids_cible" value="<?= $couple['poids_cible'] ?? '' ?>">
                        <button type="submit" class="export-btn">Acheter le régime</button>
                    </form>
                </div>
            <?php 
              endforeach;
            endif;
            ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?= view('footer') ?>
