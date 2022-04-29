import '../scss/style.scss'
import { displayResponse, getEl, getForm, getBtn, asyncData, getInput } from './functions'
import { IConfig, IDelete, IEdit } from './types/interfaces'

const deleteForm = getForm('.toggle-delete')
const editForm = getForm('.edit-form>form')

const toggleDeleteBtn = getBtn('#toggleDelete')
const closeBtn = getBtn('.close')
const logoutBtn = getBtn('form .logout-btn')
const editBtn = getBtn('form .edit-btn')
const deleteBtn = getBtn('form .delete-btn')


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
    const response = await asyncData('http://localhost/sign/routes/auth/logout', config)
    
    displayResponse(response, editForm, logoutBtn)
})

editBtn.addEventListener('click', async e => {
    e.preventDefault()

    const data:IEdit = {
        old_password: getInput('old_password').value,
        new_name: getInput('name').value,
        new_email: getInput('email').value,
        new_password: getInput('new_password').value
    }
    
    const config = {
        method: 'PATCH',
        body: JSON.stringify(data)
    }

    const response = await asyncData('http://localhost/sign/routes/users/update', config)
    
    displayResponse(response, editForm, editBtn)
    
})

deleteBtn.addEventListener('click', async e => {
    e.preventDefault()

    const data:IDelete = {
        confirm_password: getInput('confirm_password').value
    }

    const config:IConfig = {
        method: 'DELETE',
        body: JSON.stringify(data)
    }

    const response = await asyncData('http://localhost/sign/routes/users/delete', config)

    displayResponse(response, editForm, deleteBtn)
    
})