# ⏳ Preload (Loading)

Sistema de loading com tela branca e barra de progresso animada.

## **Importação**
```javascript
import Preload from './components/Preload.js';
```

## **Métodos Disponíveis**

### **Preload.show()**
Exibe a tela de loading.

```javascript
Preload.show();
```

### **Preload.hide()**
Esconde a tela de loading.

```javascript
Preload.hide();
```

## **Como Usar**

### **Loading Automático na Página**
O preload é automaticamente escondido quando a página termina de carregar:
```javascript
// No app.js - já configurado
$(document).ready(Preload.hide);
```

### **Loading Manual em Operações**
```javascript
// Requisições AJAX
async function buscarDados() {
    Preload.show();
    try {
        const response = await fetch('/api/dados');
        const dados = await response.json();
        // Processar dados...
        Preload.hide();
        Toast.success('Dados carregados!');
    } catch (error) {
        Preload.hide();
        Toast.error('Erro ao carregar dados');
    }
}

// Formulários
$('#meuForm').on('submit', function(e) {
    e.preventDefault();
    Preload.show();
    
    $.post('/salvar', $(this).serialize())
        .done(response => {
            Preload.hide();
            Toast.success('Formulário enviado!');
        })
        .fail(error => {
            Preload.hide();
            Toast.error('Erro no envio');
        });
});
```

### **Loading com Timeout**
```javascript
// Mostra loading e esconde após tempo determinado
function operacaoComTempo() {
    Preload.show();
    
    setTimeout(() => {
        Preload.hide();
        Toast.comum('Operação concluída');
    }, 3000);
}
```

## **Estrutura HTML Gerada**
```html
<div class="containerpreload">
    <div class="preload__content">
        <div class="preload__bar">
            <div class="preload__progress"></div>
        </div>
        <p class="preload__message">Carregando...</p>
    </div>
</div>
```

## **Personalização Visual**
O arquivo `Preload.sass` controla:
- Tela branca com fundo fixo
- Barra de progresso animada (200px no desktop, 150px no mobile)
- Animação contínua da esquerda para direita
- Responsividade para diferentes tamanhos de tela

---

[← Anterior: Toast](toast.md) | [Voltar ao índice](README.md) | [Próximo: Error Handling →](error-handling.md)