export default class AutenticarApi {

    static logar(data, callback){
        Request.call({url: '/api/auth/login', method: 'POST', data: data, callback: callback});
    }

    static reset(data, callback){
        Request.call({url: '/api/auth/reset', method: 'POST', data: data, callback: callback});
    }

}
