# 📧 Classe SendMail - Documentação e Exemplos

## Visão Geral

A classe `SendMail` é um sistema dinâmico para envio de emails no projeto Laravel, permitindo máxima flexibilidade na configuração de destinatários, templates e opções avançadas de entrega.

## Parâmetros da Classe

### Parâmetros Obrigatórios
1. **`$recipients`** (array|string) - Destinatário(s) do email
2. **`$subject`** (string) - Título do email
3. **`$template`** (array) - Template e dados: `['view' => 'emails.template', 'data' => []]`

### Parâmetros Opcionais
4. **`$attachments`** (array) - Arquivos anexos
5. **`$replyTo`** (array|string|null) - Reply-to
6. **`$copy`** (array|string|null) - Cópia (CC)
7. **`$blindCopy`** (array|string|null) - Cópia oculta (BCC)

---

## 🚀 Exemplos de Uso

### 1. Envio Básico - Email Simples

```php
use App\Mail\SendMail;

// Envio simples com string
SendMail::dispatch(
    recipients: 'usuario@email.com',
    subject: 'Bem-vindo ao Sistema',
    template: [
        'view' => 'emails.welcome',
        'data' => [
            'name' => 'João Silva',
            'message' => 'Obrigado por se cadastrar!'
        ]
    ]
);
```

### 2. Destinatário com Nome

```php
SendMail::dispatch(
    recipients: [
        'email' => 'usuario@email.com',
        'name' => 'João Silva'
    ],
    subject: 'Notificação Importante',
    template: [
        'view' => 'emails.notification',
        'data' => [
            'title' => 'Atualização do Sistema',
            'content' => 'O sistema será atualizado amanhã.'
        ]
    ]
);
```

### 3. Múltiplos Destinatários

```php
SendMail::dispatch(
    recipients: [
        'admin@sistema.com',
        ['email' => 'gerente@empresa.com', 'name' => 'Maria Santos'],
        'suporte@empresa.com'
    ],
    subject: 'Relatório Semanal',
    template: [
        'view' => 'emails.report',
        'data' => [
            'period' => 'Semana 15/2024',
            'stats' => $weeklyStats
        ]
    ]
);
```

### 4. Email com Anexos

```php
SendMail::dispatch(
    recipients: 'cliente@empresa.com',
    subject: 'Documentos Solicitados',
    template: [
        'view' => 'emails.documents',
        'data' => ['name' => 'Ana Costa']
    ],
    attachments: [
        // Anexo simples
        '/caminho/para/arquivo.pdf',
        // Anexo com nome personalizado
        [
            'path' => '/caminho/para/relatorio.xlsx',
            'name' => 'Relatório_Mensal_Janeiro2024.xlsx'
        ]
    ]
);
```

### 5. Email Completo com Todas as Opções

```php
SendMail::dispatch(
    recipients: [
        'email' => 'cliente@empresa.com',
        'name' => 'Carlos Souza'
    ],
    subject: 'Proposta Comercial',
    template: [
        'view' => 'emails.proposal',
        'data' => [
            'clientName' => 'Carlos Souza',
            'proposalNumber' => 'PROP-2024-001',
            'value' => 'R$ 5.500,00'
        ]
    ],
    attachments: ['/documentos/proposta.pdf'],
    replyTo: 'vendas@empresa.com',
    copy: ['gerente@empresa.com', 'financeiro@empresa.com'],
    blindCopy: 'auditoria@empresa.com'
);
```

### 6. Reset de Senha (Exemplo Específico)

```php
// Exemplo de uso para reset de senha
SendMail::dispatch(
    recipients: [
        'email' => $user->email,
        'name' => $user->name
    ],
    subject: '🔐 Redefinição de Senha - ' . config('app.name'),
    template: [
        'view' => 'emails.password-reset',
        'data' => [
            'name' => $user->name,
            'token' => $resetToken,
            'url' => route('password.reset', ['token' => $resetToken, 'email' => $user->email])
        ]
    ]
);
```

---

## 📋 Templates Disponíveis

- **`emails.password-reset`** - Reset de senha (variáveis: `name`, `token`, `url`)
- **`emails.welcome`** - Boas-vindas
- **`emails.notification`** - Notificação genérica
- **`emails.layout`** - Layout base (usado pelos outros)

---

## ⚙️ Formatos Aceitos

### Destinatários
```php
// String simples
'email@teste.com'

// Array com nome
['email' => 'teste@teste.com', 'name' => 'Nome Usuario']

// Array de múltiplos emails
['email1@teste.com', 'email2@teste.com']

// Array misto
[
    'email1@teste.com',
    ['email' => 'email2@teste.com', 'name' => 'João']
]
```

### Anexos
```php
// Arquivo simples
['/caminho/arquivo.pdf']

// Arquivo com nome personalizado
[
    [
        'path' => '/caminho/arquivo.pdf',
        'name' => 'Nome_Personalizado.pdf'
    ]
]
```

### Copy/BlindCopy/ReplyTo
```php
// String simples
'email@teste.com'

// Array de emails
['email1@teste.com', 'email2@teste.com']

// Array com nomes
[
    ['address' => 'email@teste.com', 'name' => 'Nome']
]
```

---

## ⚠️ Tratamento de Erros

A classe retorna `true` em caso de sucesso e `false` em caso de erro. Todos os erros são logados automaticamente:

```php
$success = SendMail::dispatch(
    recipients: 'teste@teste.com',
    subject: 'Teste',
    template: ['view' => 'emails.teste', 'data' => []]
);

if (!$success) {
    // Email não foi enviado - verificar logs
    Log::info('Falha no envio do email para teste@teste.com');
}
```

---

## 🔧 Uso com Queue

A classe implementa `ShouldQueue`, então emails são enviados em fila automaticamente quando o sistema de filas estiver configurado.

```php
// Método específico para reset
SendMail::passwordReset(
    email: 'user@email.com',
    name: 'João Silva',
    resetUrl: 'https://seusite.com/reset/abc123',
    token: 'abc123token', // opcional
    showToken: false // opcional, default false
);

// Exemplo com token visível
SendMail::passwordReset(
    email: 'admin@empresa.com',
    name: 'Administrador',
    resetUrl: route('password.reset', ['token' => $token]),
    token: $token,
    showToken: true // mostra o token no email para debug
);
```

### 3. Email de Boas-vindas

```php
// Básico
SendMail::welcome(
    email: 'novousuario@email.com',
    name: 'Maria Santos'
);

// Completo com dados extras
SendMail::welcome(
    email: 'novousuario@email.com',
    name: 'Maria Santos',
    extraData: [
        'loginUrl' => 'https://seusite.com/login',
        'actionUrl' => 'https://seusite.com/dashboard',
        'actionText' => 'Acessar Dashboard',
        'supportEmail' => 'suporte@empresa.com',
        'nextSteps' => [
            'Complete seu perfil',
            'Explore nossas funcionalidades',
            'Configure suas preferências',
            'Entre em contato se precisar de ajuda'
        ]
    ]
);
```

### 4. Notificação Genérica

```php
// Notificação simples
SendMail::notification(
    email: 'cliente@email.com',
    name: 'Carlos Pereira',
    title: 'Pedido Aprovado',
    message: 'Seu pedido #12345 foi aprovado e está sendo preparado para envio.'
);

// Notificação com botão de ação
SendMail::notification(
    email: 'cliente@email.com',
    name: 'Carlos Pereira',
    title: 'Nova Funcionalidade',
    message: 'Temos uma nova funcionalidade disponível em sua conta. Clique no botão abaixo para conhecer!',
    extraData: [
        'actionUrl' => 'https://seusite.com/nova-feature',
        'actionText' => 'Ver Nova Funcionalidade',
        'additionalInfo' => 'Esta funcionalidade estará disponível por tempo limitado. Aproveite!'
    ]
);
```

### 5. Envio em Lote

```php
// Array de recipients
$usuarios = [
    ['email' => 'user1@email.com', 'name' => 'João'],
    ['email' => 'user2@email.com', 'name' => 'Maria'],
    'user3@email.com', // sem nome
];

$resultados = SendMail::sendBulk(
    recipients: $usuarios,
    subject: 'Newsletter Mensal',
    view: 'emails.newsletter',
    data: [
        'title' => 'Newsletter de Abril',
        'message' => 'Confira as novidades deste mês!'
    ]
);

// $resultados retorna:
// [
//     'user1@email.com' => true,
//     'user2@email.com' => true,
//     'user3@email.com' => false
// ]
```

### 6. Com Anexos

```php
// Usando construtor tradicional
Mail::to('cliente@email.com')->send(
    new SendMail(
        subject: 'Seu Relatório',
        view: 'emails.relatorio',
        data: [
            'name' => 'Cliente',
            'periodo' => 'Março 2026'
        ],
        attachments: [
            storage_path('app/relatorios/marco-2026.pdf'),
            storage_path('app/relatorios/grafico.png')
        ]
    )
);

// Método rápido com anexos
SendMail::quickSend(
    to: 'cliente@email.com',
    subject: 'Documentos',
    view: 'emails.notification',
    data: [
        'name' => 'Cliente',
        'title' => 'Documentos Prontos',
        'message' => 'Seus documentos estão prontos.'
    ],
    attachments: [
        storage_path('app/docs/documento.pdf')
    ]
);
```

---

## 📋 Variáveis dos Templates

### Template `emails.password-reset`
```php
[
    'name' => 'Nome do usuário',
    'email' => 'email@usuario.com',
    'resetUrl' => 'URL completa de reset',
    'token' => 'token123', // opcional
    'showToken' => false // mostrar token no email
]
```

### Template `emails.welcome`
```php
[
    'name' => 'Nome do usuário',
    'email' => 'email@usuario.com',
    'loginUrl' => 'URL de login', // opcional
    'actionUrl' => 'URL do botão principal', // opcional
    'actionText' => 'Texto do botão', // opcional
    'supportEmail' => 'suporte@email.com', // opcional
    'nextSteps' => ['Passo 1', 'Passo 2'] // opcional
]
```

### Template `emails.notification`
```php
[
    'name' => 'Nome do usuário', // opcional
    'title' => 'Título da notificação',
    'message' => 'Mensagem principal',
    'actionUrl' => 'URL do botão', // opcional
    'actionText' => 'Texto do botão', // opcional
    'additionalInfo' => 'Informações extras' // opcional
]
```

---

## 🔧 Configuração

### Variáveis de Ambiente (.env)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seuemail@gmail.com
MAIL_PASSWORD=sua-senha-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@seusite.com
MAIL_FROM_NAME="${APP_NAME}"

# Para desenvolvimento local
MAIL_MAILER=log
```

### Filas (Opcional)
A classe implementa `ShouldQueue`, então os emails serão processados em fila automaticamente se configurado:

```bash
# Processar fila
php artisan queue:work

# Ver jobs na fila
php artisan queue:monitor
```

---

## 🐛 Debug e Logs

### Verificar se emails estão sendo enviados:
```bash
# Em desenvolvimento (MAIL_MAILER=log)
tail -f storage/logs/laravel.log

# Ver status do envio
$resultado = SendMail::quickSend(...);
if (!$resultado) {
    Log::info('Email falhou');
}
```

### Testar email rapidamente:
```php
// No Tinker
php artisan tinker

>>> SendMail::notification('seuemail@teste.com', 'Teste', 'Teste Email', 'Mensagem de teste')
```

---

## 🎯 Dicas de Uso

1. **Use métodos específicos** quando disponível (`passwordReset`, `welcome`)
2. **Template notification** é ideal para mensagens gerais
3. **Logs são automaticos** em caso de erro
4. **Filas processam automaticamente** se configuradas
5. **Teste sempre** em desenvolvimento com `MAIL_MAILER=log`

---

**Atualizado em**: 03/04/2026
