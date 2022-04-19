import { getEl, getInput, createEl, displayResponse, getForm, getBtn } from './functions';
import { ILogin, ResData } from './types/interfaces';

const loginBtn = getBtn('form button');
const form = getForm('form');

loginBtn.addEventListener('click', async (e) => {
    e.preventDefault();
    const emailInput= getInput('email');
    const passwordInput = getInput('password');
    const payload:ILogin = {
        email: emailInput.value,
        password: passwordInput.value
    };
    const data:FormData = new FormData();
    data.append('email', payload.email);
    data.append('password', payload.password);
    loginBtn.setAttribute('disabled', 'true');
    const response:ResData = await fetch('http://localhost/sign/routes/auth/login.php', {
        method: 'POST',
        body: data
    }).then(res => res.json())
    .then((data:Response) => data);

    displayResponse(response, form, loginBtn);
})

