
  // ── SELECTION ──
let objectSelectionner = null;
function selectObj(el, name) {
    document.querySelectorAll('.obj-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    showNotif("🎯 Objectif choisi : " + name);

    objectSelectionner = name;
    console.log("Objectif sélectionné :", objectSelectionner);
}
  // ── TOAST ──
let toastTimer;
function showNotif(msg) {
    const toast = document.getElementById('toast');
    document.getElementById('toast-msg').textContent = msg;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('show'), 3500);
}

function navigateToRegime() {

    const objectif = objectSelectionner; 
    const poidsCibleInput = document.getElementsByName('poids_cible')[0];
    const poidsCibleValeur = poidsCibleInput ? poidsCibleInput.value : null;

    if (!objectif || !poidsCibleValeur) {
        alert("Veuillez choisir un objectif et un poids cible.");
        return;
    }

    // 2. Préparation des données à envoyer
    const formData = new FormData();
    formData.append('objectif', objectif);
    formData.append('poids_cible', poidsCibleValeur);

    // 3. Appel AJAX vers ton contrôleur
    fetch(BASE_URL + 'regime/save', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            //alert("Objectif enregistré avec succès !");
            window.location.href = BASE_URL + 'regime/suggestions';
        } else {
            alert("Erreur lors de l'enregistrement : " + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert("Une erreur réseau est survenue.");
    });
}

// 1. Définition des titres pour la barre supérieure
const titles = {
    dashboard: 'Tableau de bord',
    profil: 'Mon Profil',
    objectif: 'Mon Objectif',
    suggestions: 'Régimes & Activités',
    monregime: 'Mon Régime Actuel',
    wallet: 'Porte-monnaie',
    gold: 'Option Gold ⭐'
};

// Fonction de navigation principale
function navigate(page, el) {
    // Masquer toutes les pages et afficher la page demandée
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    const targetPage = document.getElementById('pg-' + page);
    if (targetPage) targetPage.classList.add('active');

    // Gérer l'état actif dans le sidebar
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    if (el) el.classList.add('active');

    // Mettre à jour le titre dans le header (topbar)
    const topbarTitle = document.getElementById('topbar-title');
    if (topbarTitle) topbarTitle.textContent = titles[page] || '';
}

// Exécution au chargement de la page
window.addEventListener('load', () => {
    // 2. Sélection automatique du menu "Mon Objectif" dans le sidebar
    // On cherche le lien qui possède l'action onclick pour 'objectif'
    const objectifNavItem = document.querySelector('.nav-item[onclick*="objectif"]');
        
    // 3. On appelle la fonction navigate pour initialiser l'affichage sur "Objectif"
    navigate('objectif', objectifNavItem);

    // Animation optionnelle des barres (si présentes sur la page)
    const bars = document.querySelectorAll('.chart-bar');
    bars.forEach((b, i) => {
        const h = b.style.height;
        b.style.height = '0';
        setTimeout(() => b.style.height = h, 200 + i * 60);
    });
});
