document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('registerForm');
    const nameInput = form.elements['name'];
    const emailInput = form.elements['email'];
    const numberInput = form.elements['number'];
    const passInput = form.elements['pass'];
    const cpassInput = form.elements['cpass'];

    function validateName() {
        const name = nameInput.value.trim();
        if (name === "") {
            document.getElementById('nameError').textContent = "Il nome non può essere vuoto.";
            return false;
        }
        document.getElementById('nameError').textContent = "";
        return true;
    }

    function validateEmail() {
        const email = emailInput.value.trim();
        if (email === "") {
            document.getElementById('emailError').textContent = "L'email non può essere vuota.";
            return false;
        }
        checkEmailExists(email);
        return true;
    }

    function validateNumber() {
        const number = numberInput.value.trim();
        if (number === "") {
            document.getElementById('numberError').textContent = "Il numero non può essere vuoto.";
            return false;
        }
        checkNumberExists(number);
        return true;
    }

    function validatePassword() {
        const password = passInput.value.trim();
        const passwordRegex = /^(?=.*[0-9])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}$/;
        if (!passwordRegex.test(password)) {
            document.getElementById('passError').textContent = "La password deve contenere almeno 8 caratteri, un numero, una maiuscola e un carattere speciale.";
            return false;
        }
        document.getElementById('passError').textContent = "";
        return true;
    }

    function validateConfirmPassword() {
        const password = passInput.value.trim();
        const confirmPassword = cpassInput.value.trim();
        if (password !== confirmPassword) {
            document.getElementById('cpassError').textContent = "Le password non coincidono.";
            return false;
        }
        document.getElementById('cpassError').textContent = "";
        return true;
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const isNameValid = validateName();
        const isEmailValid = validateEmail();
        const isNumberValid = validateNumber();
        const isPasswordValid = validatePassword();
        const isConfirmPasswordValid = validateConfirmPassword();

        if (isNameValid && isEmailValid && isNumberValid && isPasswordValid && isConfirmPasswordValid) {
            form.submit();
        }
    });

    function checkEmailExists(email) {
        fetch(`components/check_email.php?email=${encodeURIComponent(email)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    document.getElementById('emailError').textContent = "L'email è già in uso.";
                } else {
                    document.getElementById('emailError').textContent = "";
                }
            })
            .catch(error => {
                console.error('Errore:', error);
            });
    }

    function checkNumberExists(number) {
        fetch(`components/check_number.php?number=${encodeURIComponent(number)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    document.getElementById('numberError').textContent = "Il numero è già in uso.";
                } else {
                    document.getElementById('numberError').textContent = "";
                }
            })
            .catch(error => {
                console.error('Errore:', error);
            });
        }

    nameInput.addEventListener('input', validateName);
    emailInput.addEventListener('input', validateEmail);
    numberInput.addEventListener('input', validateNumber);
    passInput.addEventListener('input', validatePassword);
    cpassInput.addEventListener('input', validateConfirmPassword);
});
