
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

function navigate(page, el) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById('pg-' + page).classList.add('active');
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    if (el) el.classList.add('active');
    document.getElementById('topbar-title').textContent = titles[page] || '';
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
