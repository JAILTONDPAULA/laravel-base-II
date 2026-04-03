import $       from 'jquery';
import Request from './class/Request.js';
import Toast   from './components/Toast.js';
import Preload from './components/Preload.js';
import Header  from './components/Header.js';

window.$       = $;
window.jQuery  = $;
window.Toast   = Toast;
window.Request = Request;
window.Preload = Preload;
window.Header  = Header;

class App {
    static events = {
        init() {
            App.events.dom();
        },
        dom() {
            // Captura erros síncronos de JavaScript
            window.addEventListener('error', (event) => {
                console.error('Erro JavaScript capturado:', event.error);
                Preload.hide();
                Toast.error(`Erro no sistema: ${event.error?.message || 'Erro desconhecido'}`);
            });

            // Captura promises rejeitadas não tratadas
            window.addEventListener('unhandledrejection', (event) => {
                console.error('Promise rejeitada capturada:', event.reason);
                Preload.hide();
                Toast.error(`Erro de processamento: ${event.reason?.message || 'Promise falhou'}`);
                event.preventDefault(); // Evita que o erro apareça no console
            });

            // Captura erros de recursos (imagens, scripts, etc)
            window.addEventListener('error', (event) => {
                if (event.target !== window) {
                    console.error('Erro de recurso capturado:', event.target.src || event.target.href);
                    Preload.hide();
                    Toast.error('Erro ao carregar recurso da página');
                }
            }, true);
        }
    }
}

$(document).ready(App.events.init);
// $(document).ready(Preload.hide);
