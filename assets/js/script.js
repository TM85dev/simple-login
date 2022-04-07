const deleteForm = document.querySelector('.toggle-delete');
const deleteBtn = document.querySelector('#toggleDelete');
const closeBtn = document.querySelector('.close');

deleteBtn.addEventListener('click', () => {
    deleteForm.classList.toggle('show');
});
closeBtn.addEventListener('click', () => {
    deleteForm.classList.remove('show');
})