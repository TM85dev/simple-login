import { getInput, displayResponse, getForm, getBtn, asyncData } from './functions'
import { IConfig, IRegister } from './types/interfaces'

const registerBtn = getBtn('form button')
const form = getForm('form')

registerBtn.addEventListener('click', async e => {
    e.preventDefault()
    const data:IRegister = {
        name: getInput('name').value,
        email: getInput('email').value,
        password: getInput('password').value,
        confirm_password: getInput('confirm_password').value
    }

    const config:IConfig = {
        method: 'POST',
        body: JSON.stringify(data)
    }
    
    const response = await asyncData('http://localhost/sign/routes/users/create.php', config);
    
    displayResponse(response, form, registerBtn);
})

