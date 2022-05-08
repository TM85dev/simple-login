export interface ILogin {
    email: string,
    password: string
}

export interface IUser {
    id?: number,
    name?: string,
    email?: string
}

export interface IRegister {
    name: string,
    email: string,
    password: string,
    confirm_password: string
}

export interface IEdit {
    old_password: string,
    new_name: string,
    new_email: string,
    new_password: string
}

export interface IDelete {
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

export class IResData implements IUser {
    id?: number
    name?: string
    email?: string
    error?: string
    msg?: string
}

export interface IDisplayResponse {
    (response:IResData, form:HTMLFormElement, btn:HTMLButtonElement): void
}

export interface IConfig {
    method: string,
    body?: string
}

export interface IAsyncData {
    (url:string, config?: object): Promise<IResData>
}