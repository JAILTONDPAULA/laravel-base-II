# Base Laravel V2

Projeto base Laravel com componentes e padrões de desenvolvimento definidos.

## 📋 Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [🚀 Quick Start](#quick-start)
- [📖 Documentação](#documentação)
- [🛡️ Segurança](#segurança)
- [🤝 Contribuição](#contribuição)

---

## 🚀 Quick Start

### ⚡ Para Desenvolvedores - Setup Rápido:

**📖 [Instruções Completas de Desenvolvimento → README-DEV.md](README-DEV.md)**

```bash
# 1. Clone e instale
git clone [repo]
cd base-laravel-v2
composer install && npm install

# 2. Configure
cp .env.example .env
php artisan key:generate && php artisan jwt:secret

# 3. Banco e migrations
# Configure DB no .env
php artisan migrate

# 4. Desenvolvimento
php artisan serve     # Terminal 1
npm run dev          # Terminal 2
```

**📍 Acesse:** `http://localhost:8000`

---

## 🚀 Sobre o Projeto

Base Laravel V2 é um projeto estruturado seguindo padrões específicos de desenvolvimento para JavaScript, Sass e Blade. 

### 🎯 Características:
- **Laravel 10.x** com **Vite** para bundling
- **Autenticação JWT** integrada
- **Componentes reutilizáveis** (Toast, Preload, Header)
- **Padrões de código** definidos e documentados
- **Proteções de segurança** automáticas
- **Documentação completa** de componentes

### 🛠️ Stack Tecnológica:
- **Backend**: Laravel 10.x + PHP 8.1+ + JWT Auth
- **Frontend**: Vite + Sass + jQuery + ES6+
- **Banco**: MySQL/PostgreSQL
- **Build**: Vite (HMR + Bundling otimizado)

---

## 📖 Documentação

### 🛠️ Para Desenvolvimento:
**[📋 Guia Completo de Desenvolvimento](README-DEV.md)**
- Instalação e configuração
- Comandos de desenvolvimento  
- Build e deploy
- Troubleshooting

### 📚 Componentes do Sistema:
**[📖 Documentação de Componentes](docs/README.md)**
- Sistema Toast (notificações)
- Sistema Preload (loading)
- Classe Request (HTTP client)
- Header com sidebar
- E mais...

### 🎨 Padrões de Código:
**[📐 Padrões de Desenvolvimento](.instructions.md)**
- JavaScript (ES6+, jQuery, classes)
- Sass (cascata, BEM, mobile-first)
- Blade (componentes, semântica)

---

## 🛡️ Segurança

### ⚠️ Proteção Contra Comandos Destrutivos

O projeto bloqueia automaticamente comandos destrutivos (`migrate:fresh`, `db:wipe`, etc.) para evitar acidentes. Para executar quando necessário, comente a proteção em `routes/console.php`.

**Mais detalhes:** [README-DEV.md - Troubleshooting](README-DEV.md#troubleshooting)

---

## 🤝 Contribuição

1. **Fork** do projeto
2. **Leia** os padrões em [.instructions.md](.instructions.md) 
3. **Desenvolva** seguindo a documentação
4. **Teste** suas alterações
5. **Submit** pull request

### 📋 Antes de Contribuir:
- [ ] Ler [README-DEV.md](README-DEV.md) para setup
- [ ] Seguir padrões do [.instructions.md](.instructions.md)
- [ ] Testar componentes criados/modificados
- [ ] Documentar mudanças significativas

**💡 Dúvidas?** Consulte a [documentação completa](docs/README.md) ou abra uma issue.

---

**🚀 Desenvolvido com ❤️ usando Laravel + Vite + JWT**

## 📝 Licença e Informações Adicionais

*Seção a ser preenchida com informações sobre instalação, configuração, contribuição, etc.*
