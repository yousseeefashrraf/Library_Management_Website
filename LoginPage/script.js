
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


function showPassword(){
    if(document.getElementById("loginForm").style.display != "none"){
        const password = document.getElementById('password').value; 
        const secondIcon = document.getElementById('eyeOff');
        const icon = document.getElementById('eyeShown'); 
    
        if(password != ""){
            icon.style.display = 'block';
        } else {
            document.getElementById('password').type = "password";
            icon.style.display = 'none';
            secondIcon.style.display = 'none'
        }
    }

    if(document.getElementById("signUpForm").style.display != "none"){
        const password = document.getElementById('signUpPassword').value; 
        const secondIcon = document.getElementById('eyeOff2');
        const icon = document.getElementById('eyeShown2'); 

        const secondIcon3 = document.getElementById('eyeOff3');
        const icon3 = document.getElementById('eyeShown3'); 
        const confirm = document.getElementById('confirmPassword').value; 
        if(password != ""){
            icon.style.display = 'block';
        } else {
            document.getElementById("signUpPassword").type = "password";
            icon.style.display = 'none';
            secondIcon.style.display = 'none'
        }

        if(confirm != ""){
            icon3.style.display = 'block';
        } else {
            document.getElementById("confirmPassword").type = "password";
            icon3.style.display = 'none';
            secondIcon3.style.display = 'none'
        }
    }

}
function showPasswordContent(){
    if(document.getElementById("loginForm").style.display != "none"){
        const icon = document.getElementById('eyeShown'); 
        const secondIcon = document.getElementById('eyeOff'); 
        document.getElementById("password").type = "text";
        icon.style.display = 'none';
        secondIcon.style.display = 'block'
    }

    if(document.getElementById("signUpForm").style.display != "none"){
        const icon = document.getElementById('eyeShown2'); 
        const secondIcon = document.getElementById('eyeOff2'); 
        document.getElementById("signUpPassword").type = "text";
        icon.style.display = 'none';
        secondIcon.style.display = 'block'
    }
}

function hidePasswordContent(){

    if(document.getElementById("loginForm").style.display != "none"){
        const icon = document.getElementById('eyeShown'); 
        const secondIcon = document.getElementById('eyeOff'); 
        const password = document.getElementById('password');
        document.getElementById("password").type = "password";
        icon.style.display = 'block';
        secondIcon.style.display = 'none'
    }

    if(document.getElementById("signUpForm").style.display != "none"){
        const icon = document.getElementById('eyeShown2'); 
        const secondIcon = document.getElementById('eyeOff2'); 
        const password = document.getElementById('signUpPassword');
        document.getElementById("signUpPassword").type = "password";
        icon.style.display = 'block';
        secondIcon.style.display = 'none'
    }

}




function showConfirmContent(){
    const icon = document.getElementById('eyeShown3'); 
    const secondIcon = document.getElementById('eyeOff3'); 
    document.getElementById("confirmPassword").type = "text";
    icon.style.display = 'none';
    secondIcon.style.display = 'block'
}
function hideConfirm(){
        const icon = document.getElementById('eyeShown3'); 
        const secondIcon = document.getElementById('eyeOff3'); 
        const password = document.getElementById('confirmPassword');
        document.getElementById("confirmPassword").type = "password";
        icon.style.display = 'block';
        secondIcon.style.display = 'none'


}
