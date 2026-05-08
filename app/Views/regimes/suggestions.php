    <?= view('header', ['activeMenu' => 'suggestions']) ?>
    
    <div class="page" id="pg-suggestions">
      <div class="page-header">
        <h1>Suggestions Personnalisées</h1>
        <p>Régimes et activités adaptés à votre objectif : perdre 5 kg</p>
      </div>

      <div class="toggle">
        <button class="toggle-btn active">🥗 Régimes + 🏃 Activités sportives</button>
      </div>

      <div id="tab-regimes">
        <div class="export-bar">
          <div>
            <div style="font-weight:600;margin-bottom:2px;">5 régimes disponibles pour votre profil</div>
            <p>Choisissez un régime pour obtenir votre plan complet exportable en PDF</p>
          </div>
        </div>

        <div class="regime-list">
            <?php foreach ($couples as $couple): ?>
                <?php $regime = $couple['regime']; ?>
                <?php $sport = $couple['sport']; ?>
                <div class="regime-card">
                    <div>
                        <div class="regime-name"><?= $regime['nom_regime'] ?></div>
                        <div class="regime-nutrients">
                            <span class="nutrient-pill n-viande">🥩 Viande <?= $regime['pourcentage_viande'] ?>%</span>
                            <span class="nutrient-pill n-poisson">🐟 Poisson <?= $regime['pourcentage_poisson'] ?>%</span>
                            <span class="nutrient-pill n-volaille">🍗 Volaille <?= $regime['pourcentage_volaille'] ?>%</span>
                        </div>
                        <div class="regime-effect">Effet : <?= $regime['poids_impact_journalier'] ?> kg/jour · Durée recommandée : <?= $couple['duree_jours'] ?> jours</div>
                    </div>
                    <div class="activity-card">
                    <div class="activity-icon">🏃</div>
                    <div class="activity-name"><?= $sport['nom_activite'] ?></div>
                    <div class="activity-detail"><?= $sport['description'] ?> · Brûle ~<?= $sport['effet_jour'] ?> kcal · Intensité modérée<br><span style="color:var(--accent);">Très compatible avec votre régime</span></div>
                    </div>
                    <div class="regime-price">
                    <div class="price-total"><?= $couple['prix_total'] ?> Ar</div>
                    <div class="price-sub"><?= $regime['prix_jour'] ?> Ar/jour</div>
                    <div class="duration-tag"><?= $couple['duree_jours'] ?> jours</div>
                    </div>
                    <form action="/regimes/achat" method="post">
                        <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
                        <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">
                        <input type="hidden" name="sport_id" value="<?= $sport['id'] ?>">
                        <input type="hidden" name="duree_jours" value="<?= $couple['duree_jours'] ?>">
                        <input type="hidden" name="prix_total" value="<?= $couple['prix_total'] ?>">
                        <input type="hidden" name="poids_cible" value="<?= $couple['poids_cible'] ?>">
                        <button type="submit" class="export-btn">Acheter le régime</button>
                    </form>
                </div>
            <?php endforeach; ?>

        </div>
      </div>
    </div>