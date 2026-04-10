import './../../sass/components/Toast.sass';

/**
 * Classe responsável pelo sistema de notificações Toast
 * @class Toast
 */
export default class Toast {
    
    static TYPES = {
        COMUM: 'comum',
        SUCESSO: 'success', 
        ERRO: 'error',
        ALERTA: 'warning'
    };

    static DEFAULT_DURATION = 5000; // 5 segundos
    static toastCounter = 0;

    /**
     * Cria e exibe um toast na página
     * @param {string} htmlContent - Conteúdo HTML do toast
     * @param {Object} options - Opções do toast
     * @param {string} options.type - Tipo do toast (comum, success, error, warning)  
     * @param {boolean} options.temporary - Se true, remove automaticamente após duration
     * @param {number} options.duration - Duração em ms (padrão: 5000)
     * @param {boolean} options.closable - Se mostra botão fechar (padrão: true)
     * @returns {string} ID do toast criado
     */
    static show(htmlContent, options = {}) {
        try {
            const config = {
                type: options.type || Toast.TYPES.COMUM,
                temporary: options.temporary !== false, // padrão: true
                duration: options.duration || Toast.DEFAULT_DURATION,
                closable: options.closable !== false // padrão: true
            };

            const toastId = `toast-${Date.now()}-${++Toast.toastCounter}`;
            const toast = Toast._createToastElement(toastId, htmlContent, config);
            
            Toast._appendToPage(toast);
            Toast._animateIn(toastId);
            
            if (config.closable) {
                Toast._setupCloseButton(toastId);
            }
            
            if (config.temporary) {
                Toast._setupAutoRemove(toastId, config.duration);
            }

            return toastId;
            
        } catch (error) {
            console.error('Erro ao criar toast:', error);
            return null;
        }
    }

    /**
     * Cria elemento HTML do toast
     * @param {string} toastId - ID único do toast
     * @param {string} htmlContent - Conteúdo HTML
     * @param {Object} config - Configurações do toast
     * @returns {string} HTML do toast
     */
    static _createToastElement(toastId, htmlContent, config) {
        const closeButton = config.closable ? 
            '<button type="button" class="toast__close" data-toast-close="' + toastId + '">' +
                '<span>&times;</span>' +
            '</button>' : '';

        const toastHtml = '<div id="' + toastId + '" class="toast toast--' + config.type + '" data-toast-type="' + config.type + '">' +
                         '<div class="toast__content">' +
                             htmlContent +
                         '</div>' +
                         closeButton +
                     '</div>';

        return toastHtml;
    }

    /**
     * Adiciona toast ao container na página
     * @param {string} toastHtml - HTML do toast
     */
    static _appendToPage(toastHtml) {
        let container = document.querySelector('.toast-container');
        
        if (!container) {
            const containerHtml = '<div class="toast-container" id="toastContainer"></div>';
            document.body.insertAdjacentHTML('beforeend', containerHtml);
            container = document.querySelector('.toast-container');
        }
        
        container.insertAdjacentHTML('afterbegin', toastHtml);
    }

    /**
     * Anima entrada do toast
     * @param {string} toastId - ID do toast
     */
    static _animateIn(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            setTimeout(() => {
                toast.classList.add('toast--visible');
            }, 100);
        }
    }

    /**
     * Configura botão de fechar
     * @param {string} toastId - ID do toast
     */
    static _setupCloseButton(toastId) {
        const closeButton = document.querySelector(`[data-toast-close="${toastId}"]`);
        if (closeButton) {
            closeButton.addEventListener('click', () => {
                Toast.close(toastId);
            });
        }
    }

    /**
     * Configura remoção automática
     * @param {string} toastId - ID do toast
     * @param {number} duration - Duração em milissegundos
     */
    static _setupAutoRemove(toastId, duration) {
        setTimeout(() => {
            Toast.close(toastId);
        }, duration);
    }

    /**
     * Fecha e remove um toast específico
     * @param {string} toastId - ID do toast para fechar
     */
    static close(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.add('toast--removing');
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
                
                // Remove container se não houver mais toasts
                const container = document.querySelector('.toast-container');
                if (container && container.children.length === 0) {
                    container.parentNode.removeChild(container);
                }
            }, 300);
        }
    }

    /**
     * Remove todos os toasts da página
     */
    static closeAll() {
        const container = document.querySelector('.toast-container');
        if (container) {
            const toasts = container.querySelectorAll('.toast');
            toasts.forEach(toast => {
                Toast.close(toast.id);
            });
        }
    }

    /**
     * Métodos de conveniência para tipos específicos
     */
    static success(htmlContent, options = {}) {
        return Toast.show(htmlContent, { ...options, type: Toast.TYPES.SUCESSO });
    }

    static error(htmlContent, options = {}) {
        return Toast.show(htmlContent, { ...options, type: Toast.TYPES.ERRO });
    }

    static warning(htmlContent, options = {}) {
        return Toast.show(htmlContent, { ...options, type: Toast.TYPES.ALERTA });
    }

    static info(htmlContent, options = {}) {
        return Toast.show(htmlContent, { ...options, type: Toast.TYPES.COMUM });
    }
}
