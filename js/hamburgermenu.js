const togglebutton = document.getElementById('toggle__button');
const navilist = document.getElementById('navi__list');

togglebutton.addEventListener('click', () => {
    navilist.classList.toggle('activelist');
})