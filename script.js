// Add event listener for the form submission
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    const email = document.getElementById('email').value; // Get the value of the email input
    const password = document.getElementById('password').value; // Get the value of the password input

    // Example functionality for logging in (you can replace this with actual authentication logic)
    console.log('Email:', email);
    console.log('Password:', password);
    alert('Login functionality not implemented.');
});

// Add event listener for the "Forgot password?" link
document.getElementById('forgotPassword').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    alert('Forgot password functionality not implemented.');
});

// Add event listener for the "Sign Up" link to show the sign-up form
document.getElementById('signUpLink').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    document.getElementById('loginForm').style.display = 'none'; // Hide login form
    document.getElementById('signUpForm').style.display = 'block'; // Show sign-up form
});

// Add event listener for the "Sign In" link to show the login form
document.getElementById('loginLink').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    document.getElementById('signUpForm').style.display = 'none'; // Hide sign-up form
    document.getElementById('loginForm').style.display = 'block'; // Show login form
});

// Add event listener for the sign-up form submission
document.getElementById('signUpForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    const signUpEmail = document.getElementById('signUpEmail').value; // Get the value of the sign-up email input
    const signUpPassword = document.getElementById('signUpPassword').value; // Get the value of the sign-up password input
    const confirmPassword = document.getElementById('confirmPassword').value; // Get the value of the confirm password input

    // Example functionality for signing up (you can replace this with actual registration logic)
    console.log('Sign Up Email:', signUpEmail);
    console.log('Sign Up Password:', signUpPassword);
    console.log('Confirm Password:', confirmPassword);
    alert('Sign-up functionality not implemented.');
});
