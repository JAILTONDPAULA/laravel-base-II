export default class TokenApi {
    static validar(data, callback){
        alert(data);
        Request.call({url: '/api/auth/token/validar/?' + data, method: 'GET', data: null, callback: callback});
    }
}
