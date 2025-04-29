# 🎟️ Controle de Rifas

Projeto completo de um site para **gestão de rifas online**, com controle de cotas, pagamentos e painel para o host acompanhar todas as vendas. Desenvolvido **sem frameworks**, usando apenas tecnologias puras: HTML, CSS, JavaScript, PHP e MySQL.

---

## 📌 Funcionalidades principais

- Página de exibição de campanhas de rifas
- Escolha de cotas disponíveis (em tempo real)
- Controle de cotas: disponíveis, reservadas e compradas
- Envio de comprovante de pagamento
- Redirecionamento automático para WhatsApp do host da campanha
- Painel de administração para o host com controle completo

---

## 🧰 Tecnologias utilizadas

- **Frontend:** HTML5, CSS3, JavaScript puro
- **Backend:** PHP puro
- **Banco de Dados:** MySQL

---

## 📁 Estrutura do Projeto

```bash
controle-rifas/
├── index.html                 # Página inicial com campanhas
├── escolher-cotas.html        # Escolha de números disponíveis
├── pagamento.html             # Envio de comprovante
├── admin.php                  # Painel do host
├── style.css                  # Estilo geral
├── script.js                  # Lógica de interação
├── /uploads/                  # Comprovantes enviados
├── /backend/
│   ├── db.php                 # Conexão com o banco
│   ├── salvar_compra.php      # Processa reserva/compra
│   ├── get_cotas.php          # Busca cotas da campanha
│   └── admin_functions.php    # Funções do painel do host
