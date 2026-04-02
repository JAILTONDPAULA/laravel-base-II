export default class AutenticarApi {
    static logar(data, callback)
    {
        Request.call({url: '/api/login', method: 'POST', data: data, callback: callback});
    }
}
