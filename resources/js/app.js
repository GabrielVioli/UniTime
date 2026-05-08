document.querySelectorAll('[data-password-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const input = document.getElementById(button.dataset.passwordToggle);

        if (! input) {
            return;
        }

        input.type = input.type === 'password' ? 'text' : 'password';
    });
});

const passwordInput = document.querySelector('[data-password-strength]');
const strengthFeedback = document.querySelector('[data-strength-feedback]');
const confirmInput = document.querySelector('[data-password-confirm]');
const matchFeedback = document.querySelector('[data-match-feedback]');

const updateStrength = () => {
    if (! passwordInput || ! strengthFeedback) {
        return;
    }

    const value = passwordInput.value;
    const bars = strengthFeedback.querySelectorAll('span:not(:last-child)');
    const label = strengthFeedback.querySelector('span:last-child');
    const score = Math.min(3, Number(value.length >= 8) + Number(/[A-Z]/.test(value)) + Number(/\d/.test(value)));

    bars.forEach((bar, index) => {
        bar.className = `h-1.5 flex-1 rounded-full ${index < score ? 'bg-emerald-500' : 'bg-slate-200'}`;
    });

    if (label) {
        label.textContent = score >= 3 ? 'Senha forte' : 'Senha fraca';
        label.className = `ml-2 text-xs font-semibold ${score >= 3 ? 'text-emerald-600' : 'text-slate-500'}`;
    }
};

const updateMatch = () => {
    if (! passwordInput || ! confirmInput || ! matchFeedback) {
        return;
    }

    const matches = confirmInput.value.length > 0 && confirmInput.value === passwordInput.value;
    matchFeedback.className = `mt-2 flex items-center gap-2 text-xs font-semibold ${matches ? 'text-emerald-600' : 'text-slate-500'}`;
    matchFeedback.lastChild.textContent = matches ? ' Senhas coincidem' : ' Senhas ainda nao coincidem';
};

passwordInput?.addEventListener('input', () => {
    updateStrength();
    updateMatch();
});
confirmInput?.addEventListener('input', updateMatch);
