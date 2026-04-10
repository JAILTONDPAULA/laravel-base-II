{{-- Header do sistema --}}
<header class="containerheader">
    <div class="header__content">
        {{-- Logo --}}
        <div class="header__logo">
            <img src="/image/logo-traum-fabrik-simple.png" alt="{{ config('app.name') }}" class="header__logo-img">
        </div>

        {{-- Informações do usuário --}}
        <div class="header__user">
            <span class="header__user-name" id="userName">Carregando...</span>
            <button type="button" class="header__menu-btn" id="menuToggle" aria-label="Abrir menu">
                <span class="header__menu-icon"></span>
                <span class="header__menu-icon"></span>
                <span class="header__menu-icon"></span>
            </button>
        </div>
    </div>
</header>

{{-- Sidebar --}}
<aside class="containersidebar" id="sidebar">
    <div class="sidebar__overlay" id="sidebarOverlay"></div>
    <div class="sidebar__content">
        {{-- Cabeçalho do sidebar --}}
        <div class="sidebar__header">
            <h3 class="sidebar__title">Menu</h3>
            <button type="button" class="sidebar__close" id="sidebarClose" aria-label="Fechar menu">
                <span>&times;</span>
            </button>
        </div>

        {{-- Menu de navegação --}}
        <nav class="sidebar__nav">
            <ul class="sidebar__menu">
                <li class="sidebar__item">
                    <a href="/" class="sidebar__link">
                        <span class="sidebar__icon">🏠</span>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar__item">
                    <a href="/profile" class="sidebar__link">
                        <span class="sidebar__icon">👤</span>
                        Meu Perfil
                    </a>
                </li>
                <li class="sidebar__item">
                    <a href="/settings" class="sidebar__link">
                        <span class="sidebar__icon">⚙️</span>
                        Configurações
                    </a>
                </li>
                <li class="sidebar__item">
                    <button type="button" class="sidebar__link sidebar__logout" id="logoutBtn">
                        <span class="sidebar__icon">🚪</span>
                        Logout
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</aside>
