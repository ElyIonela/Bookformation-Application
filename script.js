const signUpBtn = document.getElementById('signUp');
const logInBtn = document.getElementById('logIn');
const main = document.getElementById('main');

signUpBtn.addEventListener('click', () => {
    main.classList.add("right-panel-active");
});
logInBtn.addEventListener('click', () => {
    main.classList.remove("right-panel-active");
});