# 🛠️ Guia de Desenvolvimento - Base Laravel V2

Este documento contém todas as instruções técnicas para configurar e desenvolver no projeto Base Laravel V2.

## 📋 Índice

- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Desenvolvimento](#desenvolvimento)
- [Build e Deploy](#build-e-deploy)
- [Troubleshooting](#troubleshooting)

---

## 🔧 Pré-requisitos

### Versões Requeridas:
- **PHP**: `^8.1` (testado no 8.1 e 8.2)
- **Node.js**: `^18.0` ou `^20.0`
- **NPM**: `^8.0` ou **Yarn**: `^1.22`
- **Composer**: `^2.5`

### Banco de Dados:
- **MySQL**: `^8.0` (recomendado)
- **PostgreSQL**: `^14.0` (alternativa)

### Ferramentas:
- Git
- Editor com suporte PHP (VS Code recomendado)

---

## ⚡ Instalação

### 1. Clone do Repositório
```bash
git clone [URL_DO_REPOSITORIO]
cd base-laravel-v2
```

### 2. Instalação das Dependências
```bash
# Dependências PHP
composer install

# Dependências JavaScript
npm install
# ou
yarn install
```

### 3. Configuração do Ambiente
```bash
# Copiar arquivo de ambiente
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Gerar chave JWT
php artisan jwt:secret
```

---

## ⚙️ Configuração

### 1. Arquivo `.env`
Configure as variáveis necessárias:

```env
# Aplicação
APP_NAME="Base Laravel V2"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

# Banco de Dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=base_laravel_v2
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

# JWT (gerado automaticamente)
JWT_SECRET=sua_chave_jwt_aqui
JWT_TTL=1440
JWT_REFRESH_TTL=20160

# Vite (desenvolvimento)
VITE_APP_NAME="${APP_NAME}"
```

### 2. Banco de Dados
```bash
# Criar banco de dados
mysql -u root -p
CREATE DATABASE base_laravel_v2;

# Executar migrations
php artisan migrate

# Executar seeders (opcional)
php artisan db:seed
```

---

## 🚀 Desenvolvimento

### Comandos para Iniciar Desenvolvimento:

```bash
# 1. Servidor Laravel (Terminal 1)
php artisan serve
# Acesse: http://localhost:8000

# 2. Vite para assets (Terminal 2)
npm run dev
# ou
yarn dev

# 3. Opcional: Watch do Sass
npm run sass:watch
```

### Estrutura de Desenvolvimento:

#### **Frontend (Vite)**
```bash
# Desenvolvimento hot-reload
npm run dev

# Build para produção
npm run build

# Preview build de produção
npm run preview
```

#### **Backend (Laravel)**
```bash
# Servidor de desenvolvimento
php artisan serve --host=0.0.0.0 --port=8000

# Limpar caches
php artisan optimize:clear

# Logs em tempo real
tail -f storage/logs/laravel.log
```

---

## 🔐 Sistema de Autenticação (JWT)

### Configuração JWT:
```php
// config/jwt.php já configurado
// Utiliza tymon/jwt-auth package
```

### Endpoints de Autenticação:
```bash
POST /api/auth/login     # Login
POST /api/auth/logout    # Logout
POST /api/auth/refresh   # Renovar token
GET  /api/auth/me        # Dados do usuário
```

### Estrutura de Resposta JWT:
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "token_type": "bearer",
  "expires_in": 3600,
  "user": {
    "id": 1,
    "name": "Usuario",
    "email": "user@example.com"
  }
}
```

---

## 📦 Build e Deploy

### Build de Produção:
```bash
# 1. Otimizar autoload
composer install --optimize-autoloader --no-dev

# 2. Build dos assets
npm run build

# 3. Otimizar Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 4. Migrations (se necessário)
php artisan migrate --force
```

### Deploy Checklist:
- [ ] Configurar `.env` para produção
- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] Backup do banco antes de migrations
- [ ] SSL configurado
- [ ] Assets buildados (`npm run build`)
- [ ] Caches otimizados

---

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Testes com coverage
php artisan test --coverage

# Testes específicos
php artisan test --filter=UserTest
```

---

## 🔧 Comandos Úteis

### Laravel Artisan:
```bash
# Gerar componentes
php artisan make:controller NomeController
php artisan make:model NomeModel -m
php artisan make:middleware NomeMiddleware
php artisan make:request NomeRequest

# Migrations
php artisan make:migration create_nome_table
php artisan migrate:status
php artisan migrate:rollback --step=1

# Limpar caches
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### NPM/Vite:
```bash
# Instalar nova dependência
npm install nome-pacote
npm install -D nome-pacote-dev

# Scripts disponíveis
npm run dev          # Desenvolvimento
npm run build        # Produção
npm run preview      # Preview build
npm run sass:watch   # Watch Sass
```

---

## 🛠️ Troubleshooting

### Problemas Comuns:

#### **Erro: "Vite manifest not found"**
```bash
# Executar build dos assets
npm run build
```

#### **Erro: "JWT secret not set"**
```bash
# Gerar nova chave JWT
php artisan jwt:secret --force
```

#### **Erro: "Storage link not found"**
```bash
# Criar link simbólico
php artisan storage:link
```

#### **Erro de permissões (Linux/Mac)**
```bash
# Corrigir permissões
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

#### **Assets não carregam**
```bash
# Verificar se Vite está rodando
npm run dev

# Build para produção
npm run build
```

### Logs e Debug:
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Debug do Vite
npm run dev -- --debug

# Verificar configuração
php artisan about
```

---

## 📚 Recursos Adicionais

- [Documentação Laravel](https://laravel.com/docs)
- [Documentação Vite](https://vitejs.dev/)
- [Documentação JWT Auth](https://jwt-auth.readthedocs.io/)
- [Componentes do Projeto](docs/README.md)
- [Padrões de Desenvolvimento](.instructions.md)

---

## 🤝 Contribuição

1. Fork do projeto
2. Criar branch de feature (`git checkout -b feature/nova-feature`)
3. Seguir padrões do [`.instructions.md`](.instructions.md)
4. Commit das mudanças (`git commit -m 'Add: nova feature'`)
5. Push para branch (`git push origin feature/nova-feature`)
6. Criar Pull Request

---

**💡 Dica:** Mantenha sempre o [README principal](README.md) atualizado com informações do projeto e este arquivo com detalhes técnicos de desenvolvimento.