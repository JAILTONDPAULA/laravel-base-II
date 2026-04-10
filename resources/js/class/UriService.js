import Toast from './../components/Toast.js';

export default class UriService {

    /**
     * Lê os query parameters da URL atual e retorna como objeto.
     * Ex.: "?email=a@b.com&token=abc" → { email: 'a@b.com', token: 'abc' }
     * @returns {Object}
     */
    static getParameter() {
        const params = {};
        new URLSearchParams(window.location.search).forEach((value, key) => {
            params[key] = value;
        });
        return params;
    }

    /**
     * Valida se todos os parâmetros obrigatórios estão presentes na URL.
     * @param {string[]} requiredParams - Lista de parâmetros obrigatórios.
     * @returns {Object|false} Objeto com os parâmetros ou false se algum estiver ausente.
     */
    static validarUrl(requiredParams) {
        const params = UriService.getParameter();

        for (const key of requiredParams) {
            if (!params[key]) {
                Toast.show(`Parâmetro obrigatório ausente na URL: <strong>${key}</strong>`, {
                    type: Toast.TYPES.ERRO,
                });
                return false;
            }
        }

        return params;
    }
}
