const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.getElementById('btnPopup'); 

registerLink.addEventListener('click' , ()=>{
    wrapper.classList.add('active');
});

loginLink.addEventListener('click' , ()=>{
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', () => {
    wrapper.classList.add('active-btnPopup');
});

// validar email e senha do usuario no front 







