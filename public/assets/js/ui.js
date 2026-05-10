(function(){
  const SVG_EYE = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
  const SVG_EYE_OFF = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a18.6 18.6 0 0 1 4.11-5.17"></path><path d="M1 1l22 22"></path><path d="M9.88 9.88a3 3 0 0 0 4.24 4.24"></path></svg>`;

  function setButtonIcon(button, input) {
    const isPwd = input.type === 'password';
    button.innerHTML = isPwd ? SVG_EYE : SVG_EYE_OFF;
    button.setAttribute('aria-label', isPwd ? 'Afficher le mot de passe' : 'Masquer le mot de passe');
  }

  window.togglePasswordVisibility = function(button) {
    const field = button.closest('.password-field');
    if (!field) return;
    const input = field.querySelector('input');
    if (!input) return;

    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    setButtonIcon(button, input);
  }

  document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.password-toggle').forEach(function(btn){
      const field = btn.closest('.password-field');
      const input = field ? field.querySelector('input') : null;
      if (input) setButtonIcon(btn, input);
    });
  });
})();
