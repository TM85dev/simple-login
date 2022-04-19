import { IEl, IInput, IElCreate, IDisplayResponse, IForm, IBtn } from './types/interfaces'


export const getEl:IEl = el => <HTMLElement>document.querySelector(el);

export const getForm:IForm = form => <HTMLFormElement>document.querySelector(form);

export const getBtn:IBtn = form => <HTMLButtonElement>document.querySelector(form);

export const getInput:IInput = name => <HTMLInputElement>document.querySelector(`input[name="${name}"]`)

export const createEl:IElCreate = (elementName, className, htmlText) => {
    const el = <HTMLElement>document.createElement(elementName)
    el.setAttribute('class', className)
    el.innerHTML = htmlText
    return el
}

export const displayResponse:IDisplayResponse = (response, form, btn) => {
    let infoEl:HTMLElement;
    
    if(getEl('.error')) getEl('.error').remove();
    if(getEl('.success')) getEl('.success').remove();
    
    if(response.error) {
        infoEl = createEl('div', 'error', `<p>${response.error}</p>`);
        btn.removeAttribute('disabled');
    } else {
        infoEl = createEl('div', 'success', `<p>${response.msg}</p>`);
        setTimeout(() => window.location.reload() , 1000);
    }
    form.appendChild(infoEl);
}
