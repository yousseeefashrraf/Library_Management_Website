
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const email = document.getElementById('email').value; //
    const password = document.getElementById('password').value; 

  
    console.log('Email:', email);
    console.log('Password:', password);
    alert('Login functionality not implemented.');
});


document.getElementById('forgotPassword').addEventListener('click', function(event) {
    event.preventDefault(); 
    alert('Forgot password functionality not implemented.');
});

document.getElementById('signUpLink').addEventListener('click', function(event) {
    event.preventDefault(); 
    document.getElementById('loginForm').style.display = 'none';  
    document.getElementById('signUpForm').style.display = 'flex'; 
});


document.getElementById('loginLink').addEventListener('click', function(event) {
    event.preventDefault(); 
    document.getElementById('signUpForm').style.display = 'none'; 
    document.getElementById('loginForm').style.display = 'flex'; 
});

document.getElementById('signUpForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const signUpEmail = document.getElementById('signUpEmail').value; 
    const signUpPassword = document.getElementById('signUpPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value; 

    console.log('Sign Up Email:', signUpEmail);
    console.log('Sign Up Password:', signUpPassword);
    console.log('Confirm Password:', confirmPassword);

});

function checkPassword(){
    const pass = document.getElementById("signUpPassword").value;
    const confirmPass = document.getElementById("confirmPassword").value;

    if(pass != confirmPass){
        alert("Password doesn't match");

    } else {
        alert('Sign-up functionality not implemented.');
    }
}