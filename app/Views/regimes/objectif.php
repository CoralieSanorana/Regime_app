    <?php $page = 'Objectif'; ?>
    <?= view('header', ['activeMenu' => 'objectif']) ?>

    <div class="page active" id="pg-objectif">
      <div class="page-header">
        <h1>Mon Objectif</h1>
        <p>Définissez votre objectif pour recevoir des régimes adaptés</p>
      </div>

      <!-- Affichage du poids actuel et IMC -->
      <div class="card" style="background: var(--surface); padding: 1.5rem; margin-bottom: 2rem;">
        <div style="display: grid; grid-template-columns: auto 1fr; gap: 2rem; align-items: center;">
          <!-- Cercle IMC -->
          <div style="position: relative; width: 140px; height: 140px; flex-shrink: 0;">
            <svg id="imc-ring-objectif" width="140" height="140" viewBox="0 0 140 140" style="filter: drop-shadow(0 0 15px rgba(74, 222, 128, 0.3)); position: absolute; top: 0; left: 0;">
              <circle cx="70" cy="70" r="60" fill="none" stroke="#1f2b23" stroke-width="12"/>
              <circle id="imc-ring-progress-objectif" cx="70" cy="70" r="60" fill="none" stroke="#4ade80" stroke-width="12"
              stroke-dasharray="260 376.99" stroke-linecap="round" stroke-dashoffset="0"/>
            </svg>
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
              <div id="imc-value-objectif" style="font-size: 2.5rem; font-weight: 700; line-height: 1; color: #4ade80;"><?= $imc ?></div>
              <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px;">IMC</div>
            </div>
          </div>
          
          <!-- Infos IMC -->
          <div>
            <h3 id="imc-category-objectif" style="margin: 0 0 8px 0; font-size: 1.2rem; color: white;">Poids normal</h3>
            <div id="imc-status-objectif" style="font-size: 0.92rem; margin-bottom: 8px; color: #4ade80;">✓ IMC Sain</div>
            <div id="imc-description-objectif" style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">IMC idéal : 18.5 – 24.9<br>Votre IMC est dans la zone saine.</div>
          </div>
        </div>
      </div>

      <!-- Sélection de l'objectif -->
      <div class="card" style="margin-bottom: 2rem;">
        <div class="card-title" style="margin-bottom: 1.5rem; font-weight: 600;">🎯 Choisir votre objectif</div>
        <div class="objective-grid">
          <?php if(!empty($objectifs)): ?>
            <?php foreach($objectifs as $obj): ?>
              <div class="obj-card" onclick="selectObjectif(this, '<?= addslashes($obj['libelle']) ?>');" style="cursor: pointer;">
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
      </div>

      <!-- Définition du poids cible -->
      <div class="card">
        <div class="card-title" style="margin-bottom: 1.5rem; font-weight: 600;">🎯 Définir votre poids cible</div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
          <div class="form-group">
            <label>Poids actuel (kg)</label>
            <input type="number" id="poids-actuel-display" value="<?= $poids_actuel ?>" readonly style="opacity: 0.6;"> 
          </div>
          <div class="form-group">
            <label>Poids cible (kg)</label>
            <input type="number" id="poids-cible" placeholder="Saisir le poids cible" style="border-color: var(--border);" step="any">
            <div id="poids-cible-error" style="color: #f87171; font-size: 0.85rem; margin-top: 0.5rem; display: none;"></div>
          </div>
        </div>

        <!-- Options spéciales pour IMC idéal -->
        <div id="imc-ideal-section" style="display: none; margin-bottom: 1.5rem;">
          <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-weight: 500;">
              <input type="checkbox" id="use-imc-ideal" onchange="handleIMCIdeal()" style="cursor: pointer;">
              Atteindre un IMC idéal (25 kg/m²)
            </label>
            <div id="imc-ideal-info" style="background: var(--surface2); border: 1px solid var(--border); border-radius: 8px; padding: 12px; margin-top: 0.75rem; font-size: 0.9rem; display: none;">
              <strong>Poids cible calculé :</strong> <span id="poids-ideal-value"><?= $poids_ideal ?></span> kg
              <div style="margin-top: 0.5rem; color: var(--text-muted);">Vous devrez <span id="diff-poids" style="font-weight: 600; color: var(--accent);"></span></div>
            </div>
          </div>
        </div>

        <button class="btn btn-primary" onclick="navigateToRegime()" style="width: 100%; justify-content: center;">
          Voir mes suggestions →
        </button>
      </div>

      <?= view('footer') ?>
    </div>

    <div id="toast" class="toast">
        <span id="toast-msg"></span>
    </div>

    <script>
      window.NUTRIPATH_BASE_URL = "<?= base_url(); ?>";
      window.NUTRIPATH_OBJECTIF = {
        poidsActuel: <?= (float) $poids_actuel ?>,
        poidsIdeal: <?= (float) $poids_ideal ?>,
        taille: <?= (float) $taille ?>,
        imc: <?= (float) $imc ?>
      };
      window.NUTRIPATH_CSRF = {
        name: "<?= csrf_token() ?>",
        hash: "<?= csrf_hash() ?>"
      };
    </script>
    <script src="<?= base_url('assets/js/objectif.js') ?>"></script>

</body>
</html>