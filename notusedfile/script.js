document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);
        formData.append('rememberMe', document.getElementById('rememberMe').checked);
        try {
            const response = await fetch('process_login.php', { method: 'POST', body: formData });
            const data = await response.json();
            if (data.success) window.location.href = 'dashboard.html';
            else alert(data.message);
        } catch (error) {
            console.error(error);
            alert('Error during login.');
        }
    });

    signupForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(signupForm);
        try {
            const response = await fetch('process_signup.php', { method: 'POST', body: formData });
            const data = await response.json();
            if (data.success) window.location.href = 'dashboard.html';
            else alert(data.message);
        } catch (error) {
            console.error(error);
            alert('Error during signup.');
        }
    });
});
