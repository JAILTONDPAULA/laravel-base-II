# 🛡️ Sistema de Captura de Erros

Sistema automático que captura erros JavaScript e exibe feedback ao usuário.

## **Tipos de Erros Capturados**

1. **Erros Síncronos**: Erros de sintaxe, referência, tipo
2. **Promises Rejeitadas**: Falhas em operações assíncronas 
3. **Erros de Recursos**: Falha ao carregar imagens, scripts, CSS

## **Comportamento Automático**
Quando qualquer erro é capturado:
- ✅ `Preload.hide()` é chamado automaticamente
- ✅ `Toast.error()` exibe mensagem amigável ao usuário
- ✅ Erro é logado no console para debug

## **Implementação no app.js**

```javascript
// Captura erros síncronos de JavaScript
window.addEventListener('error', (event) => {
    console.error('Erro JavaScript capturado:', event.error);
    Preload.hide();
    Toast.error(`Erro no sistema: ${event.error?.message || 'Erro desconhecido'}`);
});

// Captura promises rejeitadas não tratadas
window.addEventListener('unhandledrejection', (event) => {
    console.error('Promise rejeitada capturada:', event.reason);
    Preload.hide();
    Toast.error(`Erro de processamento: ${event.reason?.message || 'Promise falhou'}`);
    event.preventDefault(); // Evita que o erro apareça no console
});

// Captura erros de recursos (imagens, scripts, etc)
window.addEventListener('error', (event) => {
    if (event.target !== window) {
        console.error('Erro de recurso capturado:', event.target.src || event.target.href);
        Preload.hide();
        Toast.error('Erro ao carregar recurso da página');
    }
}, true);
```

## **Teste do Sistema**
```javascript
// Erro de teste adicionado no app.js (remover em produção)
setTimeout(() => {
    throw new Error('Erro de teste - sistema funcionando!');
}, 5000);
```

## **Benefícios**

- ✅ **Experiência do Usuário**: Erros são tratados de forma amigável
- ✅ **Debugging**: Erros são logados no console para desenvolvimento
- ✅ **Loading States**: Preload é automaticamente escondido em caso de erro
- ✅ **Feedback Visual**: Toast de erro informa o usuário sobre problemas
- ✅ **Cobertura Completa**: Trata erros síncronos, assíncronos e de recursos

## **Mensagens Exibidas**

| Tipo de Erro | Mensagem para o Usuário |
|---------------|----------------------|
| Erro JavaScript | "Erro no sistema: [descrição]" |
| Promise Rejeitada | "Erro de processamento: [razão]" |
| Recurso não encontrado | "Erro ao carregar recurso da página" |

---

[← Anterior: Preload](preload.md) | [Voltar ao índice](README.md) | [Próximo: Integration →](integration.md)