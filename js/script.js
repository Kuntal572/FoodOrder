let searchForm = document.querySelector('.search-form-container');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    registerForm.classList.remove('active');
    cart.classList.remove('active');    
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
    forgotForm.classList.remove('active');
}

let cart = document.querySelector('.shopping-cart-container');

document.querySelector('#cart-btn').onclick = () =>{
    cart.classList.toggle('active');
    registerForm.classList.remove('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
    forgotForm.classList.remove('active');
}

let loginForm = document.querySelector('.login-form-container');

document.querySelector('#login-btn').onclick = () =>{  
    loginForm.classList.toggle('active');
    searchForm.classList.remove('active');
    cart.classList.remove('active');    
    navbar.classList.remove('active');
    registerForm.classList.remove('active');
    forgotForm.classList.remove('active');
}

let loginForm1 = document.querySelector('.login-form-container');

document.querySelector('#login-btn2').onclick = () =>{  
    loginForm1.classList.toggle('active');
    searchForm.classList.remove('active');
    cart.classList.remove('active');    
    navbar.classList.remove('active');
    registerForm.classList.remove('active');
    forgotForm.classList.remove('active');
}

let loginForm2 = document.querySelector('.login-form-container');

document.querySelector('#login-btn3').onclick = () =>{  
    loginForm2.classList.toggle('active');
    searchForm.classList.remove('active');
    cart.classList.remove('active');    
    navbar.classList.remove('active');
    registerForm.classList.remove('active');
    forgotForm.classList.remove('active');
}

let registerForm = document.querySelector('.register-form-container');

document.querySelector('#register-btn').onclick = () =>{
    registerForm.classList.toggle('active');
    loginForm.classList.remove('active');
    searchForm.classList.remove('active');
    cart.classList.remove('active');    
    navbar.classList.remove('active');
    forgotForm.classList.remove('active');
}

let forgotForm = document.querySelector('.forgot-form-container');

document.querySelector('#forgot-btn').onclick = () =>{
    forgotForm.classList.toggle('active');
    registerForm.classList.remove('active');
    loginForm.classList.remove('active');
    searchForm.classList.remove('active');
    cart.classList.remove('active');    
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    registerForm.classList.remove('active');
    searchForm.classList.remove('active');
    cart.classList.remove('active');    
    loginForm.classList.remove('active');
    forgotForm.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
}

document.querySelector('.home').onmousemove = (e) =>{

    let x = (window.innerWidth - e.pageX * 2) / 90;
    let y = (window.innerHeight - e.pageY * 2) / 90;

    document.querySelector('.home .home-parallax-img').style.transform = `translateX(${y}px) translateY(${x}px)`;
}

document.querySelector('.home').onmouseleave = () =>{

    document.querySelector('.home .home-parallax-img').style.transform = `translateX(0px) translateY(0px)`;
}   