    <?php $page = 'Objectif'; ?>
    <?= view('header', ['activeMenu' => 'objectif']) ?>

    <div class="page active" id="pg-objectif">
      <div class="page-header">
        <h1>Mon Objectif</h1>
        <p>Définissez votre objectif pour recevoir des régimes adaptés</p>
      </div>

      <!-- Affichage du poids actuel et IMC -->
      <div class="card" style="background: linear-gradient(135deg, var(--accent), var(--success)); color: white; margin-bottom: 2rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; padding: 1.5rem;">
          <div>
            <div style="font-size: 0.9rem; opacity: 0.9;">Poids actuel</div>
            <div style="font-size: 2.5rem; font-weight: 700;"><?= $poids_actuel ?> <span style="font-size: 1.2rem;">kg</span></div>
          </div>
          <div>
            <div style="font-size: 0.9rem; opacity: 0.9;">IMC (Indice de Masse Corporelle)</div>
            <div style="font-size: 2.5rem; font-weight: 700;"><?= $imc ?> <span style="font-size: 1.2rem;">kg/m²</span></div>
            <div style="font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.85;">
              <?php 
                if ($imc < 18.5) echo "Insuffisance pondérale";
                elseif ($imc < 25) echo "Poids normal";
                elseif ($imc < 30) echo "Surpoids";
                else echo "Obésité";
              ?>
            </div>
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
            <input type="number" id="poids-cible" placeholder="Saisir le poids cible" style="border-color: var(--border);">
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
  const BASE_URL = "<?= base_url(); ?>";
  const POIDS_ACTUEL = <?= $poids_actuel ?>;
  const TAILLE = <?= $taille ?>;
  const POIDS_IDEAL = <?= $poids_ideal ?>;
  const IMC = <?= $imc ?>;

  let objectifChoisi = null;
  let poidsChoisi = null;

  // ========== SÉLECTION D'OBJECTIF ==========
  function selectObjectif(element, objectif) {
    console.log('selectObjectif appelée avec:', objectif);
    
    objectifChoisi = objectif;
    poidsChoisi = null;
    
    // Retirer la sélection de toutes les cartes et ajouter à celle-ci
    document.querySelectorAll('.obj-card').forEach(card => {
      card.classList.remove('selected');
    });
    
    element.classList.add('selected');
    console.log('Classe selected ajoutée à:', element);

    // Afficher/masquer les sections selon l'objectif
    const imcSection = document.getElementById('imc-ideal-section');
    const poidsInput = document.getElementById('poids-cible');
    const poidsFormGroup = poidsInput.closest('.form-group');

    if (objectif === 'Atteindre son IMC idéal') {
      imcSection.style.display = 'block';
      poidsFormGroup.style.display = 'none';
    } else {
      imcSection.style.display = 'none';
      poidsFormGroup.style.display = 'block';
      document.getElementById('use-imc-ideal').checked = false;
      document.getElementById('imc-ideal-info').style.display = 'none';
      poidsInput.value = '';
      poidsInput.disabled = false;
    }

    showNotif(`🎯 Objectif choisi : ${objectif}`);
    validateAndUpdateResume();
  }

  // ========== IMC IDÉAL ==========
  function handleIMCIdeal() {
    const useIdeal = document.getElementById('use-imc-ideal').checked;
    const poidsInput = document.getElementById('poids-cible');
    const infoSection = document.getElementById('imc-ideal-info');

    if (useIdeal) {
      poidsChoisi = POIDS_IDEAL;
      poidsInput.value = POIDS_IDEAL;
      poidsInput.disabled = true;
      infoSection.style.display = 'block';
      calculateDifference();
    } else {
      poidsInput.disabled = false;
      poidsInput.value = '';
      infoSection.style.display = 'none';
      poidsChoisi = null;
    }
    validateAndUpdateResume();
  }

  // ========== VALIDATION ET RÉSUMÉ ==========
  function validateAndUpdateResume() {
    const poidsInput = document.getElementById('poids-cible');
    const errorDiv = document.getElementById('poids-cible-error');
    const resumeSection = document.getElementById('resume-section');
    const useIdeal = document.getElementById('use-imc-ideal').checked;

    if (!objectifChoisi) {
      resumeSection.style.display = 'none';
      return;
    }

    let isValid = false;
    errorDiv.style.display = 'none';
    errorDiv.textContent = '';

    // Cas IMC idéal
    if (objectifChoisi === 'Atteindre son IMC idéal') {
      poidsChoisi = POIDS_IDEAL;
      isValid = true;
    } 
    // Autres cas
    else if (poidsInput.value) {
      const poids = parseFloat(poidsInput.value);
      poidsChoisi = poids;

      if (objectifChoisi === 'Perdre du Poids') {
        if (poids < POIDS_ACTUEL) {
          isValid = true;
        } else {
          errorDiv.textContent = '⚠️ Le poids cible doit être inférieur au poids actuel';
          errorDiv.style.display = 'block';
        }
      } else if (objectifChoisi === 'Augmenter son Poids') {
        if (poids > POIDS_ACTUEL) {
          isValid = true;
        } else {
          errorDiv.textContent = '⚠️ Le poids cible doit être supérieur au poids actuel';
          errorDiv.style.display = 'block';
        }
      }
    }

    if (isValid && poidsChoisi) {
      calculateDifference();
      resumeSection.style.display = 'block';
      document.getElementById('resume-objectif').textContent = objectifChoisi;
    } else {
      resumeSection.style.display = 'none';
    }
  }

  // ========== CALCUL DIFFÉRENCE ==========
  function calculateDifference() {
    if (!poidsChoisi) return;

    const diff = Math.abs(poidsChoisi - POIDS_ACTUEL);
    const estimatedDays = Math.ceil(diff / 0.5);
    const estimatedWeeks = Math.ceil(estimatedDays / 7);

    let diffText = '';
    if (poidsChoisi < POIDS_ACTUEL) {
      diffText = `−${diff.toFixed(1)} kg à perdre`;
    } else {
      diffText = `+${diff.toFixed(1)} kg à gagner`;
    }

    document.getElementById('resume-diff').textContent = diffText;
    document.getElementById('resume-duree').textContent = `~${estimatedWeeks} semaines`;
    document.getElementById('diff-poids').textContent = diffText;
  }

  // ========== ÉCOUTEUR POIDS CIBLE ==========
  document.getElementById('poids-cible').addEventListener('input', function() {
    console.log('Poids cible saisi:', this.value);
    validateAndUpdateResume();
  });

  // ========== TOAST NOTIFICATIONS ==========
  let toastTimer;
  function showNotif(msg) {
    const toast = document.getElementById('toast');
    const toastMsg = document.getElementById('toast-msg');
    if (toast && toastMsg) {
      toastMsg.textContent = msg;
      toast.classList.add('show');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(() => toast.classList.remove('show'), 3500);
    }
  }

  // ========== NAVIGATION VERS SUGGESTIONS ==========
  function navigateToRegime() {
    console.log('navigateToRegime appelée');
    console.log('objectifChoisi:', objectifChoisi);
    console.log('poidsChoisi:', poidsChoisi);

    if (!objectifChoisi) {
      alert('⚠️ Veuillez choisir un objectif.');
      return;
    }

    if (!poidsChoisi) {
      alert('⚠️ Veuillez saisir un poids cible.');
      return;
    }

    // Préparation des données
    const formData = new FormData();
    formData.append('objectif', objectifChoisi);
    formData.append('poids_cible', poidsChoisi);

    // Ajouter le token CSRF si disponible
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                      || document.querySelector('[name="csrf_token"]')?.value;
    if (csrfToken) {
      formData.append('<?= csrf_token() ?>', csrfToken);
    }

    console.log('Envoi des données...');

    fetch(BASE_URL + 'regime/save', {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    .then(response => {
      console.log('Réponse reçue, status:', response.status);
      if (!response.ok) {
        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
      }
      return response.json();
    })
    .then(data => {
      console.log('Données JSON reçues:', data);
      if (data.status === 'success') {
        showNotif('✅ Objectif enregistré ! Redirection...');
        setTimeout(() => {
          window.location.href = BASE_URL + 'regimes/suggestions';
        }, 500);
      } else {
        alert('❌ Erreur : ' + (data.message || 'Erreur inconnue'));
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      alert('❌ Erreur réseau : ' + error.message);
    });
  }

  // ========== INITIALISATION ==========
  window.addEventListener('load', () => {
    console.log('Page objectif chargée avec succès');
    console.log('POIDS_ACTUEL:', POIDS_ACTUEL);
    console.log('IMC:', IMC);
  });
</script>
</script>