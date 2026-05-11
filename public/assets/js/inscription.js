// Page d'inscription - Gestion des étapes

function showStep(stepNumber) {
    document.querySelectorAll('.auth-shell').forEach(shell => shell.classList.remove('active'));
    document.getElementById('page-register' + stepNumber).classList.add('active');
}

window.addEventListener('load', () => {
    // Pas d'action particulière à l'initialisation
});
