
        function openForm() {
            const formSection = document.querySelector('.home');
            formSection.classList.add('show');
        }

        function closeForm() {
            const formSection = document.querySelector('.home');
            formSection.classList.remove('show');
        }

        function showSignupForm() {
            const loginForm = document.querySelector('h2:not(.show)');
            const signupForm = document.querySelector('h2.show');

            loginForm.classList.remove('show');
            signupForm.classList.add('show');
        }

        function showLoginForm() {
            const loginForm = document.querySelector('h2:not(.show)');
            const signupForm = document.querySelector('h2.show');

            loginForm.classList.add('show');
            signupForm.classList.remove('show');
        }

        function togglePasswordVisibility() {
            const passwordInput = document.querySelector('input[name="Password"]');
            const passwordIcon = document.querySelector('.pw_hide');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('uil-eye-slash');
                passwordIcon.classList.add('uil-eye');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('uil-eye');
                passwordIcon.classList.add('uil-eye-slash');
            }
        }
    