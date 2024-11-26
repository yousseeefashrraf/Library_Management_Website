

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

const the_animation = document.querySelectorAll('.animation')

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('scroll-animation')
        }
            else {
                entry.target.classList.remove('scroll-animation')
            }

    })
},
   { threshold: 0.5
   });
//
  for (let i = 0; i < the_animation.length; i++) {
   const elements = the_animation[i];

    observer.observe(elements);
  }