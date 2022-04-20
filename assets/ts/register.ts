import { getEl, createEl, getInput, displayResponse, getForm, getBtn } from './functions'
import { IRegister, ResData } from './types/interfaces'

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
    data.append('name', payload.name)
    data.append('email', payload.email)
    data.append('password', payload.password)
    data.append('confirm_password', payload.confirm_password)
    
    const response:ResData = await fetch('http://localhost/sign/routes/users/create.php', {
        method: 'POST',
        body: data
    }).then(res => res.json())
    .then((data:Response) => data)
    
    displayResponse(response, form, registerBtn);
})

