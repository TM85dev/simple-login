import '../scss/style.scss';
import { getEl, getInput, createEl } from './functions';
import { ILogin, ResData } from './types/interfaces';

const loginBtn = getEl('form button');
const form = getEl('form');

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

    if(getEl('.error')) getEl('.error').remove();
    if(getEl('.success')) getEl('.success').remove();

    let infoEl:HTMLElement;
    if(response.error) {
        infoEl = createEl('div', 'error', `<p>${response.error}</p>`);
    } else {
        infoEl = createEl('div', 'success', `<p>${response.msg}</p>`);
        setTimeout(() => window.location.reload() , 1000);
    }
    form.appendChild(infoEl);
})

