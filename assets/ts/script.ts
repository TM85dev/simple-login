import { getEl } from './functions';

const deleteForm = getEl('.toggle-delete');
const deleteBtn = getEl('#toggleDelete');
const closeBtn = getEl('.close');

deleteBtn.addEventListener('click', () => {
    deleteForm.classList.toggle('show');
});
closeBtn.addEventListener('click', () => {
    deleteForm.classList.remove('show');
})