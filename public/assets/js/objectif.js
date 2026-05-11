// Page Objectif - Gestion des objectifs et poids cible

let objectifChoisi = null;
let poidsChoisi = null;

// Récupérer BASE_URL depuis la variable globale ou par défaut
function getBaseUrl() {
    return (typeof window.NUTRIPATH_BASE_URL !== 'undefined') 
           ? window.NUTRIPATH_BASE_URL 
           : (typeof BASE_URL !== 'undefined' ? BASE_URL : '/');
}

// ========== MISE À JOUR AFFICHAGE IMC ==========
function updateIMCDisplay() {
    const imc = window.NUTRIPATH_OBJECTIF.imc;
    const imcValue = document.getElementById('imc-value-objectif');
    const imcCategory = document.getElementById('imc-category-objectif');
    const imcStatus = document.getElementById('imc-status-objectif');
    const imcDesc = document.getElementById('imc-description-objectif');
    const imcRing = document.getElementById('imc-ring-progress-objectif');
    const imcRingSvg = document.getElementById('imc-ring-objectif');

    let color = '#4ade80';
    let categoryText = 'Poids normal';
    let statusText = '✓ IMC Sain';
    let descText = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est dans la zone saine.';
    let strokeColor = '#4ade80';
    let glowColor = 'rgba(74, 222, 128, 0.3)';

    if (imc < 18.5) {
        color = '#ef4444';
        categoryText = 'Poids insuffisant';
        statusText = '⚠️ IMC Bas';
        descText = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est en dessous du poids normal.';
        strokeColor = '#ef4444';
        glowColor = 'rgba(239, 68, 68, 0.3)';
    } else if (imc < 25) {
        color = '#4ade80';
        categoryText = 'Poids normal';
        statusText = '✓ IMC Sain';
        descText = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est dans la zone saine.';
        strokeColor = '#4ade80';
        glowColor = 'rgba(74, 222, 128, 0.3)';
    } else if (imc < 30) {
        color = '#f97316';
        categoryText = 'Surpoids';
        statusText = '⚠️ IMC Élevé';
        descText = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est au-dessus du poids normal.';
        strokeColor = '#f97316';
        glowColor = 'rgba(249, 115, 22, 0.3)';
    } else {
        color = '#ef4444';
        categoryText = 'Obésité';
        statusText = '❌ IMC Critique';
        descText = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est au-dessus des normes saines.';
        strokeColor = '#ef4444';
        glowColor = 'rgba(239, 68, 68, 0.3)';
    }

    if (imcValue) {
        imcValue.textContent = imc.toFixed(1);
        imcValue.style.color = color;
    }
    if (imcCategory) imcCategory.textContent = categoryText;
    if (imcStatus) {
        imcStatus.textContent = statusText;
        imcStatus.style.color = color;
    }
    if (imcDesc) imcDesc.innerHTML = descText;
    if (imcRing) imcRing.style.stroke = strokeColor;
    if (imcRingSvg) imcRingSvg.style.filter = `drop-shadow(0 0 15px ${glowColor})`;
}

// ========== SÉLECTION D'OBJECTIF ==========
function selectObjectif(element, objectif) {
    objectifChoisi = objectif;
    poidsChoisi = null;
    
    document.querySelectorAll('.obj-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    element.classList.add('selected');

    const imcSection = document.getElementById('imc-ideal-section');
    const poidsInput = document.getElementById('poids-cible');
    const poidsFormGroup = poidsInput.closest('.form-group');

    // Vérifier si c'est l'objectif IMC idéal (accepter les variantes)
    const isIMCIdeal = objectif.includes('IMC idéal');
    
    if (isIMCIdeal) {
        // Calculer le poids cible pour un IMC sain (20)
        // Formule: poids = IMC * (taille en mètres)^2
        const tailleEnMetres = window.NUTRIPATH_OBJECTIF.taille / 100;
        const poidsIdeal = 20 * (tailleEnMetres * tailleEnMetres);
        
        poidsChoisi = Math.round(poidsIdeal * 10) / 10; // Arrondir à 1 décimale
        poidsInput.value = poidsChoisi;
        poidsInput.disabled = true;
        
        imcSection.style.display = 'block';
        poidsFormGroup.style.display = 'none';
        
        document.getElementById('use-imc-ideal').checked = true;
        document.getElementById('imc-ideal-info').style.display = 'block';
        document.getElementById('poids-ideal-value').textContent = poidsChoisi;
        calculateDifference();
    } else {
        imcSection.style.display = 'none';
        poidsFormGroup.style.display = 'block';
        document.getElementById('use-imc-ideal').checked = false;
        document.getElementById('imc-ideal-info').style.display = 'none';
        poidsInput.value = '';
        poidsInput.disabled = false;
        poidsChoisi = null;
    }

    showNotif(`🎯 Objectif choisi : ${objectif}`);
    updateIMCDisplay();
    validateAndUpdateResume();
}

// ========== IMC IDÉAL ==========
function handleIMCIdeal() {
    const useIdeal = document.getElementById('use-imc-ideal').checked;
    const poidsInput = document.getElementById('poids-cible');
    const infoSection = document.getElementById('imc-ideal-info');

    if (useIdeal) {
        // Calculer le poids cible pour un IMC sain (20)
        const tailleEnMetres = window.NUTRIPATH_OBJECTIF.taille / 100;
        const poidsIdeal = 20 * (tailleEnMetres * tailleEnMetres);
        poidsChoisi = Math.round(poidsIdeal * 10) / 10; // Arrondir à 1 décimale
        
        poidsInput.value = poidsChoisi;
        poidsInput.disabled = true;
        infoSection.style.display = 'block';
        document.getElementById('poids-ideal-value').textContent = poidsChoisi;
        calculateDifference();
    } else {
        poidsInput.disabled = false;
        poidsInput.value = '';
        infoSection.style.display = 'none';
        poidsChoisi = null;
    }
    updateIMCDisplay();
    validateAndUpdateResume();
}

// ========== VALIDATION ET RÉSUMÉ ==========
function validateAndUpdateResume() {
    const poidsInput = document.getElementById('poids-cible');
    const errorDiv = document.getElementById('poids-cible-error');
    const POIDS_ACTUEL = window.NUTRIPATH_OBJECTIF.poidsActuel;

    if (!objectifChoisi) {
        return;
    }

    let isValid = false;
    errorDiv.style.display = 'none';
    errorDiv.textContent = '';

    const isIMCIdeal = objectifChoisi.includes('IMC idéal');
    
    if (isIMCIdeal) {
        isValid = true;
    } else if (poidsInput.value) {
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
    }
}

// ========== CALCUL DIFFÉRENCE ==========
function calculateDifference() {
    if (!poidsChoisi) return;

    const POIDS_ACTUEL = window.NUTRIPATH_OBJECTIF.poidsActuel;
    const diff = Math.abs(poidsChoisi - POIDS_ACTUEL);
    const estimatedDays = Math.ceil(diff / 0.5);
    const estimatedWeeks = Math.ceil(estimatedDays / 7);

    let diffText = '';
    if (poidsChoisi < POIDS_ACTUEL) {
        diffText = `−${diff.toFixed(1)} kg à perdre`;
    } else {
        diffText = `+${diff.toFixed(1)} kg à gagner`;
    }

    const diffElement = document.getElementById('diff-poids');
    if (diffElement) {
        diffElement.textContent = diffText;
    }
}

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
    if (!objectifChoisi) {
        alert('⚠️ Veuillez choisir un objectif.');
        return;
    }

    if (!poidsChoisi) {
        alert('⚠️ Veuillez saisir un poids cible.');
        return;
    }

    const formData = new FormData();
    formData.append('objectif', objectifChoisi);
    formData.append('poids_cible', poidsChoisi);

    const BASE_URL = getBaseUrl();
    fetch(BASE_URL + 'regime/save', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
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
document.getElementById('poids-cible').addEventListener('input', function() {
    validateAndUpdateResume();
});

window.addEventListener('load', () => {
    updateIMCDisplay();
    const bars = document.querySelectorAll('.chart-bar');
    bars.forEach((b, i) => {
        const h = b.style.height;
        b.style.height = '0';
        setTimeout(() => b.style.height = h, 200 + i * 60);
    });
});
