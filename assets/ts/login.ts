import { getInput, displayResponse, getForm, getBtn, asyncData } from './functions';
import { IConfig, ILogin } from './types/interfaces';

const loginBtn = getBtn('form button');
const form = getForm('form');

loginBtn.addEventListener('click', async e => {
    e.preventDefault();
    loginBtn.setAttribute('disabled', 'true');

    const emailInput= getInput('email');
    const passwordInput = getInput('password');
    const data:ILogin = {
        email: emailInput.value,
        password: passwordInput.value
    };
    const config:IConfig = {
        method: 'POST',
        body: JSON.stringify(data)
    }
    const response = await asyncData('http://localhost/sign/routes/auth/login.php', config);
    
    displayResponse(response, form, loginBtn);
})

