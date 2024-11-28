

function changeStar(){
    let star = document.getElementsByClassName("imgStar");
    for(let i=0; i<star.length;i++){
        star[i].src = "../images/HomePage_images/starFilled.svg";
    }
}

function getBackToNormal(){
    let star = document.getElementsByClassName("imgStar");
    for(let i=0; i<star.length;i++){
        star[i].src = "../images/HomePage_images/starFilled2.svg";
    }
}

function changeStarForTwo(){
    let star = document.getElementsByClassName("imgStarTwo");
    for(let i=0; i<star.length;i++){
        star[i].src = "../images/HomePage_images/starFilled.svg";
    }
}

function getBackToNormalForTwo(){
    let star = document.getElementsByClassName("imgStarTwo");
    for(let i=0; i<star.length;i++){
        star[i].src = "../images/HomePage_images/starFilled2.svg";
    }
}

