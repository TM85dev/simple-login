import { getInput, displayResponse, getForm, getBtn, asyncData } from './functions'
import { IConfig, IRegister } from './types/interfaces'

const registerBtn = getBtn('form button')
const form = getForm('form')

registerBtn.addEventListener('click', async e => {
    e.preventDefault()
    const payload:IRegister = {
        name: getInput('name').value,
        email: getInput('email').value,
        password: getInput('password').value,
        confirm_password: getInput('confirm_password').value
    }
    let data = new FormData()
    Object.keys(payload).forEach(name => data.append(name, payload[name]));

    const config:IConfig = {
        method: 'POST',
        body: data
    }
    
    const response = await asyncData('http://localhost/sign/routes/users/create.php', config);
    
    displayResponse(response, form, registerBtn);
})

