import '../scss/style.scss'
import { displayResponse, getEl, getForm, getBtn, asyncData, getInput } from './functions'
import { IConfig, IEdit } from './types/interfaces'

const deleteForm = getForm('.toggle-delete')
const editForm = getForm('.edit-form>form')

const toggleDeleteBtn = getBtn('#toggleDelete')
const closeBtn = getBtn('.close')
const logoutBtn = getBtn('form .logout-btn')
const editBtn = getBtn('form .edit-btn')


toggleDeleteBtn.addEventListener('click', () => {
    deleteForm.classList.toggle('show')
})
closeBtn.addEventListener('click', () => {
    deleteForm.classList.remove('show')
})


logoutBtn.addEventListener('click', async e => {
    e.preventDefault()

    const config:IConfig = {
        method: 'POST'
    }
    const response = await asyncData('http://localhost/sign/routes/auth/logout.php', config)
    
    displayResponse(response, editForm, logoutBtn)
})

editBtn.addEventListener('click', async e => {
    e.preventDefault()

    const payload:IEdit = {
        old_password: getInput('old_password').value,
        new_name: getInput('name').value,
        new_email: getInput('email').value,
        new_password: getInput('new_password').value
    }
    
    const config = {
        method: 'PATCH',
        body: JSON.stringify(payload)
    }

    const response = await asyncData('http://localhost/sign/routes/users/update.php', config)
    
    displayResponse(response, editForm, editBtn)
    
})