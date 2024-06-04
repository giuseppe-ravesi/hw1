document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const email = document.querySelector('input[name="email"]');
    const pass = document.querySelector('input[name="pass"]');

    form.addEventListener('input', (event) => {
        validateField(event.target);
    });

    form.addEventListener('submit', function(event) {
        let isValid = true;
        isValid &= validateField(email);
        isValid &= validateField(pass);

        if (!isValid) {
            event.preventDefault();
        }
    });

    function validateField(field) {
        let isValid = true;
        let errorMessage = '';

        switch (field.name) {
            case 'email':
                if (field.value.trim() === '') {
                    isValid = false;
                    errorMessage = 'Campo obbligatorio';
                }
                break;
            case 'pass':
                if (field.value.trim() === '') {
                    isValid = false;
                    errorMessage = 'Campo obbligatorio';                }
                break;
        }

        if (isValid) {
            clearError(field);
        } else {
            showError(field, errorMessage);
        }

        return isValid;
    }

    function showError(element, message) {
        clearError(element);
        const error = document.createElement('div');
        error.className = 'error';
        error.style.color = 'red';
        error.textContent = message;
        element.parentNode.insertBefore(error, element.nextSibling);
    }

    function clearError(element) {
        const error = element.parentNode.querySelector('.error');
        if (error) {
            error.remove();
        }
    }
});