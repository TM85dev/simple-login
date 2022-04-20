import { getInput, displayResponse, getForm, getBtn, asyncData } from './functions';
import { IConfig, ILogin } from './types/interfaces';

const loginBtn = getBtn('form button');
const form = getForm('form');

loginBtn.addEventListener('click', async e => {
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

    const config:IConfig = {
        method: 'POST',
        body: data
    }
    const response = await asyncData('http://localhost/sign/routes/auth/login.php', config);

    displayResponse(response, form, loginBtn);
})

