export interface ILogin {
    email: string,
    password: string
}
export interface IEl {
    (el:string): HTMLElement
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