import '../scss/style.scss';
import { displayResponse, getEl, getForm, getBtn, asyncData } from './functions';
import { IConfig } from './types/interfaces';

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

    const config:IConfig = {
        method: 'POST'
    }
    const response = await asyncData('http://localhost/sign/routes/auth/logout.php', config)
    
    displayResponse(response, editForm, logoutBtn);
})