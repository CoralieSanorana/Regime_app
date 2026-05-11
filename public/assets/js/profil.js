// Page Profil - Calcul IMC réactif

function calculerIMC() {
    const poids = parseFloat(document.getElementById('poids-input').value);
    const taille = parseFloat(document.getElementById('taille-input').value);

    if (!poids || !taille || poids <= 0 || taille <= 0) {
        return;
    }

    const tailleEnMetres = taille / 100;
    const imc = poids / (tailleEnMetres * tailleEnMetres);

    let category = '';
    let status = '';
    let description = '';
    let strokeColor = '#4ade80';
    let numberColor = '#4ade80';
    let shadowColor = 'rgba(74, 222, 128, 0.3)';

    if (imc < 18.5) {
        category = 'Poids insuffisant';
        status = '⚠️ IMC Bas';
        description = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est en dessous du poids normal.';
        strokeColor = '#ef4444';
        numberColor = '#ef4444';
        shadowColor = 'rgba(239, 68, 68, 0.3)';
    } else if (imc >= 18.5 && imc < 25) {
        category = 'Poids Normal';
        status = '✓ IMC Sain';
        description = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est dans la zone saine.';
        strokeColor = '#4ade80';
        numberColor = '#4ade80';
        shadowColor = 'rgba(74, 222, 128, 0.3)';
    } else if (imc >= 25 && imc < 30) {
        category = 'Surpoids';
        status = '⚠️ IMC Élevé';
        description = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est au-dessus du poids normal.';
        strokeColor = '#f97316';
        numberColor = '#f97316';
        shadowColor = 'rgba(249, 115, 22, 0.3)';
    } else {
        category = 'Obésité';
        status = '❌ IMC Critique';
        description = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est au-dessus des normes saines.';
        strokeColor = '#ef4444';
        numberColor = '#ef4444';
        shadowColor = 'rgba(239, 68, 68, 0.3)';
    }

    document.getElementById('imc-value').textContent = imc.toFixed(1);
    document.getElementById('imc-value').style.color = numberColor;
    document.getElementById('imc-category').textContent = category;
    document.getElementById('imc-status').textContent = status;
    document.getElementById('imc-description').innerHTML = description;

    const progressCircle = document.getElementById('imc-ring-progress');
    if (progressCircle) {
        progressCircle.setAttribute('stroke', strokeColor);
    }

    const svgElement = document.getElementById('imc-ring-svg');
    if (svgElement) {
        svgElement.style.filter = `drop-shadow(0 0 15px ${shadowColor})`;
    }
}

// Ajouter des écouteurs d'événement pour les changements automatiques
document.getElementById('poids-input').addEventListener('input', calculerIMC);
document.getElementById('taille-input').addEventListener('input', calculerIMC);

// Gérer le checkbox "Recalculer l'IMC"
const recalcToggle = document.getElementById('recalc-imc-toggle');
if (recalcToggle) {
    recalcToggle.addEventListener('change', function() {
        if (this.checked) {
            calculerIMC();
        }
    });
}

window.addEventListener('DOMContentLoaded', function() {
    const appShell = document.getElementById('app-shell');
    if (appShell) {
        appShell.style.display = 'flex';
    }
    calculerIMC();
});
