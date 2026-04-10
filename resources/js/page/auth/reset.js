import './../../../sass/pages/auth/reset.sass';
import AutenticarApi from '../../apis/AutenticarApi.js';
import TokenApi      from '../../apis/TokenApi.js';
import UriService from '../../class/UriService.js';

class Page {
    static events = {
        init() {
            Page.events.dom();
            Page.logar.validarUrl();
            Preload.hide();
        },
        dom() {
            $(document).on('submit', '#loginForm', Page.logar.call);
            $(document).on('input paste', '.codescheck input', Page.confirmToken.stpeNumber);
            $(document).on('click', "#btn-new-token", Page.logar.newToken);
            $(document).on('input paste', '#password', Page.definirNovaSenha.validarRequesitos);
            $(document).on('submit', '#confirmTokenForm', Page.definirNovaSenha.call);
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
        },
        newToken() {
            $(".codescheck input").val('');
            $("#loginForm").css({transform: 'translateY(0%)', opacity: 1});
            $("#confirmTokenForm").css({transform: 'translateY(100%)', opacity: 0});
            Page.definirNovaSenha.hide();
        },
        validarUrl() {
            const p = UriService.getParameter();
            if(p && p.email) {
                $("#email").val(atob(p.email));
                Page.confirmToken.showConfirmToke();
                const token = p.token ? atob(p.token) : '';
                $('.codescheck input').eq(0).val(token.substring(0, 1));
                $('.codescheck input').eq(1).val(token.substring(1, 2));
                $('.codescheck input').eq(2).val(token.substring(2, 3));
                $('.codescheck input').eq(3).val(token.substring(3, 4));
                $('.codescheck input').eq(4).val(token.substring(4, 5));
                $('.codescheck input').eq(5).val(token.substring(5, 6));
                Page.confirmToken.validar.call();
            }
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
        hide() {
            $(".codescheck").slideDown(200);
            $(".novasenha").slideUp(200);
        },
        validarRequesitos() {
            const number        = /[0-9]/.test($("#password").val());
            const upper_case    = /[A-Z]/.test($("#password").val());
            const lower_case    = /[a-z]/.test($("#password").val());
            const special_char  = /[!@#$%^&*(),.?":{}|<>]/.test($("#password").val());
            const length        = $("#password").val().length >= 8;

            $("#number").toggleClass('checked', number);
            $("#uppercase").toggleClass('checked', upper_case);
            $("#lowercase").toggleClass('checked', lower_case);
            $("#special").toggleClass('checked', special_char);
            $("#length").toggleClass('checked', length);

            $("#btn-reset-password").prop('disabled', !(number && upper_case && lower_case && special_char && length));
        },
        call(e) {
            e.preventDefault();
            const data = {
                "email": $("#email").val(),
                "token": $('.codescheck input').map(function() { return $(this).val(); }).get().join(''),
                "password": $("#password").val()
            };
            TokenApi.resetPassword(data, Page.definirNovaSenha.callback);
        },
        callback(r) {
            location.href = '/auth/login';
        }
    }

}

$(document).ready(Page.events.init);
