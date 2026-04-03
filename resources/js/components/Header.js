import './../../sass/components/header.sass';
import $ from 'jquery';

export default class Header {

    static events = {
        init() {
            Header.events.dom();
            Header.auth.checkAndRedirect();
            Header.loadUserData();
        },

        dom() {

            // Toggle sidebar events
            $(document).on('click', '#menuToggle', Header.sidebar.open);
            $(document).on('click', '#sidebarOverlay', Header.sidebar.close);
            $(document).on('click', '#sidebarClose', Header.sidebar.close);
            $(document).on('click', '#logoutBtn', Header.auth.logout);

            // Keyboard events
            $(document).on('keydown', Header.events.handleKeydown);

            Header.events.checkElements();
        },

        handleKeydown(e) {
            if (e.key === 'Escape' && $('#sidebar').hasClass('active')) {
                Header.sidebar.close();
            }
        },

        checkElements() {
            const elements = {
                menuToggle: $('#menuToggle').length,
                sidebar: $('#sidebar').length,
                sidebarOverlay: $('#sidebarOverlay').length,
                sidebarClose: $('#sidebarClose').length,
                logoutBtn: $('#logoutBtn').length
            };

        }
    }

    static loadUserData() {
        const userName = localStorage.getItem('name') || 'Usuário';
        const $userNameElement = $('#userName');

        if ($userNameElement.length) {
            $userNameElement.text(userName);
        } else {
            console.warn('userName element not found');
        }
    }

    static sidebar = {
        open() {
            const $sidebar = $('#sidebar');
            if ($sidebar.length) {
                $sidebar.addClass('active');
                $('body').css('overflow', 'hidden');
            } else {
                console.error('Sidebar element not found');
            }
        },

        close() {
            const $sidebar = $('#sidebar');
            if ($sidebar.length) {
                $sidebar.removeClass('active');
                $('body').css('overflow', '');
            }
        }
    }

    static auth = {
        logout() {
            // Limpar localStorage
            localStorage.removeItem('tokenmysystem');
            localStorage.removeItem('expired');
            localStorage.removeItem('name');
            localStorage.removeItem('email');

            // Redirecionar para login
            window.location.href = '/login';
        },

        isLoggedIn() {
            const token = localStorage.getItem('tokenmysystem');
            const expired = localStorage.getItem('expired');

            if (!token || !expired) {
                return false;
            }

            return Date.now() < parseInt(expired);
        },

        checkAndRedirect() {
            if (!Header.auth.isLoggedIn() && !['/login', '/senha'].includes(location.pathname)) {
                window.location.href = '/login';
            }
        }
    }

    static updateUserName(newName) {
        const $userNameElement = $('#userName');
        if ($userNameElement.length && newName) {
            $userNameElement.text(newName);
            localStorage.setItem('name', newName);
        }
    }

}

// Inicialização automática
$(document).ready(Header.events.init);
