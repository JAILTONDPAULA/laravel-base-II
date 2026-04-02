import axios from 'axios';
import Preload from '../components/Preload';

export default class Request {

    static call({url, method, data, callback = null, start = true, headers = {}}) {

        if (start) Preload.show();

        axios({
            url: url,
            method: method,
            data: data,
            headers: headers
        })
        .then(response => {
            callback && callback(response.data, response.status);
        })
        .catch(error => {
            const status = error.response?.status;
            console.log(error);
            Preload.hide();
            if (status === 401 && !['/login','/senha'].includes(location.pathname)) {
                location.href = '/login';
            } else {
                let errorText = 'Erro desconhecido';

                if (error.response?.data) {
                    // Se for objeto, converte para JSON
                    if (typeof error.response.data === 'object') {
                        errorText = JSON.stringify(error.response.data);
                    } else {
                        errorText = String(error.response.data);
                    }
                } else if (error.message) {
                    errorText = error.message;
                }

                Toast.error(errorText.slice(1, 200));
            }
        });

    }

}
