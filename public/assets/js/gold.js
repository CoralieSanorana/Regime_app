// Page Option Gold - Activation Gold

function activateGold() {
    // Récupérer base_url depuis la variable globale ou par défaut
    const baseUrl = (typeof window.NUTRIPATH_BASE_URL !== 'undefined') 
                    ? window.NUTRIPATH_BASE_URL 
                    : (typeof BASE_URL !== 'undefined' ? BASE_URL : '/');

    fetch(baseUrl + 'gold/activate', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = baseUrl + 'gold';
        } else {
            alert("Erreur lors de l'enregistrement : " + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert("Une erreur réseau est survenue.");
    });
}

window.addEventListener('load', () => {
    // Page chargée
});
