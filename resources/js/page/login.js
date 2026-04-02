import './../app.js';
import AutenticarApi from '../apis/AutenticarApi.js';
import Preload from '../components/Preload.js';

class Page {
    static events = {
        init() {
            Page.events.dom();
            Preload.hide();
        },
        dom() {
            $(document).on('submit', '#loginForm', Page.logar.call);
        }
    }

    static logar = {
        call(e) {
            e.preventDefault();
            AutenticarApi.logar($(this).serialize(), Page.logar.callbacks);
        },
        callbacks(r) {
            localStorage.setItem('tokenmysystem', r.token);
            localStorage.setItem('expired', Date.now() + (r.expires_in * 1000));
            localStorage.setItem('name', r.user.name);
            localStorage.setItem('email', r.user.email);
            location.href = '/';
        }
    }
}

$(document).ready(Page.events.init);
