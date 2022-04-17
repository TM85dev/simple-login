import { IEl, IInput, IElCreate } from './types/interfaces'


export const getEl:IEl = el => <HTMLElement>document.querySelector(el);

export const getInput:IInput = name => <HTMLInputElement>document.querySelector(`input[name="${name}"]`)

export const createEl:IElCreate = (elementName, className, htmlText) => {
    const el = <HTMLElement>document.createElement(elementName)
    el.setAttribute('class', className)
    el.innerHTML = htmlText
    return el
}
