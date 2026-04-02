# 🌐 Request (Cliente HTTP)

Classe utilitária para requisições HTTP usando Axios com integração automática dos componentes Preload e Toast.

## **Importação**
```javascript
import Request from '../class/Request.js';
```

## **Método Disponível**

### **Request.call(options)**
Realiza requisições HTTP com tratamento automático de loading e erros.

```javascript
Request.call({
    url: '/api/endpoint',
    method: 'GET',
    data: null,
    callback: (data, status) => {
        console.log('Sucesso:', data);
    },
    start: true,
    headers: {}
});
```

**Parâmetros:**
- `url` (string): **Obrigatório** - URL do endpoint
- `method` (string): **Obrigatório** - Método HTTP (`GET`, `POST`, `PUT`, `DELETE`, etc.)
- `data` (object): **Opcional** - Dados a serem enviados na requisição
- `callback` (function): **Opcional** - Função executada em caso de sucesso
- `start` (boolean): **Opcional** - Se deve mostrar preload (padrão: `true`)
- `headers` (object): **Opcional** - Headers customizados

## **Exemplos de Uso**

### **Requisição GET Simples**
```javascript
Request.call({
    url: '/api/users',
    method: 'GET',
    callback: (data, status) => {
        console.log('Usuários carregados:', data);
        // Processar lista de usuários
    }
});
```

### **Requisição POST com Dados**
```javascript
const userData = {
    name: 'João Silva',
    email: 'joao@email.com'
};

Request.call({
    url: '/api/users',
    method: 'POST', 
    data: userData,
    callback: (data, status) => {
        Toast.success('Usuário criado com sucesso!');
        console.log('Usuário criado:', data);
    }
});
```

### **Requisição PUT para Atualização**
```javascript
const updatedUser = {
    id: 123,
    name: 'João Santos',
    email: 'joao.santos@email.com'
};

Request.call({
    url: `/api/users/${updatedUser.id}`,
    method: 'PUT',
    data: updatedUser,
    callback: (data, status) => {
        Toast.success('Usuário atualizado com sucesso!');
    }
});
```

### **Requisição DELETE**
```javascript
Request.call({
    url: `/api/users/123`,
    method: 'DELETE', 
    callback: (data, status) => {
        Toast.success('Usuário removido com sucesso!');
    }
});
```

### **Requisição com Headers Customizados**
```javascript
Request.call({
    url: '/api/protected-data',
    method: 'GET',
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('token'),
        'Content-Type': 'application/json'
    },
    callback: (data, status) => {
        console.log('Dados protegidos:', data);
    }
});
```

### **Requisição sem Preload**
```javascript
// Para requisições que não precisam de loading visual
Request.call({
    url: '/api/quick-check',
    method: 'GET',
    start: false, // Não mostra preload
    callback: (data, status) => {
        console.log('Check realizado:', data);
    }
});
```

## **Integração com Formulários**

### **Envio de Formulário**
```javascript
$('#userForm').on('submit', function(e) {
    e.preventDefault();
    
    const formData = $(this).serialize();
    
    Request.call({
        url: '/api/users',
        method: 'POST',
        data: formData,
        callback: (data, status) => {
            Toast.success('Formulário enviado com sucesso!');
            $('#userForm')[0].reset();
        }
    });
});
```

### **Upload de Arquivo**
```javascript
const fileInput = document.getElementById('fileUpload');
const file = fileInput.files[0];

if (file) {
    const formData = new FormData();
    formData.append('arquivo', file);
    
    Request.call({
        url: '/api/upload',
        method: 'POST',
        data: formData,
        headers: {
            // Não definir Content-Type para FormData (deixar o browser definir)
        },
        callback: (data, status) => {
            Toast.success(`Arquivo "${file.name}" enviado com sucesso!`);
        }
    });
}
```

## **Tratamento Automático de Erros**

A classe Request possui tratamento automático de erros:

### **Redirecionamento Automático (401)**
- Status **401** (Não Autorizado) redireciona automaticamente para `/login`
- Exceto se já estiver nas páginas `/login` ou `/senha`

### **Exibição de Erros**
- **Preload** é automaticamente escondido em caso de erro
- **Toast.error** mostra os últimos 200 caracteres da mensagem de erro
- Suporta respostas em **JSON**, **XML** ou **texto puro**
- Errors são logados no console para debug

### **Exemplo de Tratamento Manual**
```javascript
Request.call({
    url: '/api/delicate-operation',
    method: 'POST',
    data: operationData,
    callback: (data, status) => {
        // Sucesso
        Toast.success('Operação realizada!');
    }
    // Erros são tratados automaticamente,
    // mas você pode adicionar lógica específica se necessário
});
```

## **Padrões Recomendados**

### **Estrutura de Callback**
```javascript
Request.call({
    url: '/api/endpoint',
    method: 'GET',
    callback: (data, status) => {
        // Sempre verificar o status se necessário
        if (status === 200) {
            // Processar dados successfully
            console.log('Data received:', data);
        }
        
        // Preload já é escondido automaticamente
        Preload.hide(); // Não necessário, já é feito automaticamente
    }
});
```

### **Reutilização em Componentes**
```javascript
// Criar método específico para uma operação
class UserManager {
    static loadUsers(callback) {
        Request.call({
            url: '/api/users',
            method: 'GET',
            callback: callback
        });
    }
    
    static createUser(userData, callback) {
        Request.call({
            url: '/api/users',
            method: 'POST',
            data: userData,
            callback: callback
        });
    }
}

// Usar nos componentes
UserManager.loadUsers((users) => {
    console.log('Users loaded:', users);
});
```

## **Dependências**

- **Axios**: Cliente HTTP base
- **Preload**: Mostrado/escondido automaticamente
- **Toast**: Para exibição de erros automática

## **Considerações Importantes**

- ✅ **Preload automático**: Ligado por padrão, desabilite com `start: false` 
- ✅ **Tratamento de erro**: Completamente automático e integrado
- ✅ **Redirecionamento**: 401 vai para `/login` automaticamente
- ✅ **Callback opcional**: Use apenas quando precisar processar a resposta
- ⚠️ **Headers**: Para FormData, deixe o browser definir Content-Type
- ⚠️ **CSRF**: Certifique-se de incluir tokens CSRF se necessário

---

[← Voltar ao índice](README.md)