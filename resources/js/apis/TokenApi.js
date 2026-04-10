export default class TokenApi {

    static validar(data, callback){
        Request.call({url: '/api/auth/token/validar/?' + data, method: 'GET', data: null, callback: callback});
    }

    static resetPassword(data, callback){
        Request.call({url: '/api/auth/token/reset-password', method: 'POST', data: data, callback: callback});
    }

}
