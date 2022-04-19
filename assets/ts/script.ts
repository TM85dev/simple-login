import '../scss/style.scss';
import { displayResponse, getEl, getForm, getBtn } from './functions';
import { ResData } from './types/interfaces';

const deleteForm = getEl('.toggle-delete');
const logoutForm = getForm('form.logout-form');
const editForm = getForm('.edit-form>form');

const deleteBtn = getBtn('#toggleDelete');
const closeBtn = getBtn('.close');
const logoutBtn = getBtn('form .logout-btn');

deleteBtn.addEventListener('click', () => {
    deleteForm.classList.toggle('show');
});
closeBtn.addEventListener('click', () => {
    deleteForm.classList.remove('show');
})

logoutBtn.addEventListener('click', async e => {
    e.preventDefault();

    const response:ResData = await fetch('http://localhost/sign/routes/auth/logout.php', {
        method: 'POST',
    }).then(res => res.json())
    .then((data:Response) => data)
    
    displayResponse(response, editForm, logoutBtn);
})