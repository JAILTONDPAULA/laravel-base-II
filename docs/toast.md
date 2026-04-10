# 🔔 Toast (Notificações)

Sistema de notificações para feedback do usuário com 4 tipos diferentes.

## **Importação**
```javascript
import Toast from './components/Toast.js';
```

## **Métodos Disponíveis**

### **Toast.show(mensagem, tipo, duracao)**
Exibe uma notificação toast.

```javascript
// Notificação comum (azul)
Toast.show('Operação realizada!', 'comum', 3000);

// Notificação de sucesso (verde)
Toast.show('Dados salvos com sucesso!', 'success', 4000);

// Notificação de erro (vermelho)
Toast.show('Erro ao processar dados', 'error', 5000);

// Notificação de aviso (amarelo)
Toast.show('Atenção: verifique os dados', 'warning', 4000);
```

**Parâmetros:**
- `mensagem` (string): Texto a ser exibido
- `tipo` (string): `'comum'`, `'success'`, `'error'`, `'warning'`
- `duracao` (number): Tempo em millisegundos (padrão: 3000ms)

### **Métodos de Conveniência**
```javascript
// Métodos simplificados (usa duração padrão)
Toast.comum('Mensagem informativa');
Toast.success('Operação concluída!');
Toast.error('Algo deu errado');
Toast.warning('Cuidado com essa ação');
```

### **Controle Manual**
```javascript
// Esconde toast específico (pelo ID do elemento)
Toast.hide(toastElement);

// Remove toast específico
Toast.close(toastElement);

// Fecha todos os toasts ativos
Toast.closeAll();
```

## **Estilos Disponíveis**
- **Comum**: Fundo azul, para informações gerais
- **Success**: Fundo verde, para confirmações
- **Error**: Fundo vermelho, para erros
- **Warning**: Fundo amarelo, para avisos

## **Exemplo Prático**
```javascript
// Em uma função de submit
async function salvarDados() {
    try {
        Preload.show(); // Mostra loading
        await fetch('/api/dados', { method: 'POST' });
        Preload.hide(); // Esconde loading
        Toast.success('Dados salvos com sucesso!');
    } catch (error) {
        Preload.hide();
        Toast.error('Erro ao salvar dados');
    }
}
```

---

[← Voltar ao índice](README.md) | [Próximo: Preload →](preload.md)