# Base Laravel V2

Projeto base Laravel com componentes e padrões de desenvolvimento definidos.

## 📋 Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [📖 Documentação de Componentes](#documentação-de-componentes)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Padrões de Desenvolvimento](#padrões-de-desenvolvimento)

---

## 📖 Documentação de Componentes

**📚 Para documentação completa e exemplos de uso dos componentes, consulte:**
**[docs/README.md](docs/README.md)**

---

## 🚀 Sobre o Projeto

Base Laravel V2 é um projeto estruturado seguindo padrões específicos de desenvolvimento para JavaScript, Sass e Blade. O projeto utiliza Vite para bundling e está configurado para desenvolvimento moderno com componentes reutilizáveis.

---

## 📁 Estrutura do Projeto

```
├── docs/                       // 📚 Documentação dos componentes
│   ├── README.md               // Índice da documentação
│   ├── toast.md                // Documentação do sistema Toast
│   ├── preload.md              // Documentação do sistema Preload
│   ├── request.md              // Documentação do cliente HTTP
│   └── error-handling.md       // Sistema de captura de erros
├── resources/
│   ├── js/
│   │   ├── app.js              // Entry point com jQuery + Error handling
│   │   ├── components/         // Componentes reutilizáveis
│   │   │   ├── Toast.js        // Sistema de notificações
│   │   │   └── Preload.js      // Sistema de loading
│   │   ├── pages/              // Scripts específicos por página  
│   │   └── class/              // Classes utilitárias
│   │       └── Request.js      // Cliente HTTP com Axios
│   ├── sass/
│   │   ├── app.sass            // Variáveis e cores globais
│   │   ├── components/         // Estilos de componentes
│   │   │   ├── Toast.sass      // Estilos do sistema Toast
│   │   │   └── Preload.sass    // Estilos do sistema Preload
│   │   └── pages/              // Estilos específicos por página
│   └── views/
│       ├── layouts/            // Layouts Blade
│       ├── components/         // Componentes Blade
│       │   └── preload.blade.php // Componente de loading
│       └── pages/              // Views específicas
```

---

## 📐 Padrões de Desenvolvimento

Para informações detalhadas sobre os padrões de código JavaScript, Sass e Blade utilizados neste projeto, consulte o arquivo [`.instructions.md`](.instructions.md).

### Principais Convenções:
- **JavaScript**: ES6+, classes organizadas, HTML strings concatenadas com `+`
- **Sass**: Sintaxe indentada, padrão cascata, cores do `app.sass`
- **Blade**: Componentes reutilizáveis, HTML semântico
- **Responsividade**: Mobile-first approach
- **Acessibilidade**: WCAG compliance

---

## 📝 Licença e Informações Adicionais

*Seção a ser preenchida com informações sobre instalação, configuração, contribuição, etc.*
