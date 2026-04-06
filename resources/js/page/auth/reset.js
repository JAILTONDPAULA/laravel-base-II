import AutenticarApi from '../../apis/AutenticarApi.js';
import TokenApi      from '../../apis/TokenApi.js';

class Page {
    static events = {
        init() {
            Page.events.dom();
            Preload.hide();
            setTimeout(_=>Page.confirmToken.showConfirmToke(), 1000);
            // setTimeout(_=>Page.definirNovaSenha.show(), 2000);
        },
        dom() {
            $(document).on('submit', '#loginForm', Page.logar.call);
            $(document).on('input paste', '.codescheck input', Page.confirmToken.stpeNumber);
        }
    }

    static logar = {
        call(e) {
            e.preventDefault();
            AutenticarApi.reset($(this).serialize(), Page.logar.callbacks);
        },
        callbacks(r) {
            Page.confirmToken.showConfirmToke();
            Preload.hide();
        }
    }

    static confirmToken = {
        showConfirmToke() {
            $("#loginForm").css({transform: 'translateY(-100%)', opacity: 0});
            $("#confirmTokenForm").css({transform: 'translateY(0%)', opacity: 1});
        },
        stpeNumber() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if(this.value !== '') {
                const nextInput = $(this).next('input');
                if(nextInput.length) {
                    nextInput.focus();
                }
                Page.confirmToken.validar.call();
            }
        },
        validar: {
            call() {
                if($('.codescheck input:valid').length === 6) {
                    const data = `email=${$("#email").val()}&token=${$('.codescheck input').map(function() { return $(this).val(); }).get().join('')}`;
                    TokenApi.validar(data, Page.confirmToken.validar.callback);
                }
            },
            callback(r) {
                Page.definirNovaSenha.show();
                Preload.hide();
            }
        }
    }

    static definirNovaSenha = {
        show() {
            $(".codescheck").slideUp(200);
            $(".novasenha").slideDown(200);
        },
    }

}

$(document).ready(Page.events.init);
