export interface ILogin {
    email: string,
    password: string
}

export interface IRegister {
    name: string,
    email: string,
    password: string,
    confirm_password: string
}

export interface IEl {
    (el:string): HTMLElement
}

export interface IForm {
    (form:string): HTMLFormElement
}

export interface IBtn {
    (btn:string): HTMLButtonElement
}

export interface IInput {
    (name:string): HTMLInputElement
}

export interface IElCreate {
    (elementName:string, className:string, htmlText:string): HTMLElement
}

export interface ResData extends Response {
    error?: string,
    msg?: string
}

export interface IDisplayResponse {
    (response:ResData, form:HTMLFormElement, btn:HTMLButtonElement): void
}