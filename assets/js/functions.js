export const getEl = el => document.querySelector(el);

export const getInput = name => document.querySelector(`input[name="${name}"]`)

export const createEl = (elementName, className, htmlText) => {
    const el = document.createElement(elementName)
    el.setAttribute('class', className)
    el.innerHTML = htmlText
    return el
}
