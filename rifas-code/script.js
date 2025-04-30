const container = document.getElementById('numeros');
const quantidadeSpan = document.getElementById('quantidade');
const totalSpan = document.getElementById('total');
const whatsappBtn = document.getElementById('whatsappBtn');
const valorPorNumero = 100;
let selecionados = [];

for (let i = 1; i <= 400; i++) {
  const div = document.createElement('div');
  div.classList.add('numero');
  div.textContent = i;

  div.addEventListener('click', () => {
    const numero = i;
    if (selecionados.includes(numero)) {
      selecionados = selecionados.filter(n => n !== numero);
      div.classList.remove('selecionado');
    } else {
      selecionados.push(numero);
      div.classList.add('selecionado');
    }
    atualizarResumo();
  });

  container.appendChild(div);
}

function calcularTotal(qtd) {
  if (qtd === 10) return 750;
  if (qtd === 5) return 400;
  return qtd * valorPorNumero;
}

function atualizarResumo() {
  const qtd = selecionados.length;
  const total = calcularTotal(qtd);

  quantidadeSpan.textContent = qtd;
  totalSpan.textContent = "R$ " + total.toFixed(2).replace('.', ',');
}

whatsappBtn.addEventListener('click', () => {
  if (selecionados.length === 0) {
    alert("Selecione ao menos 1 número.");
    return;
  }

  const qtd = selecionados.length;
  const numerosTexto = selecionados.sort((a, b) => a - b).join(', ');
  const total = calcularTotal(qtd);
  const valorFormatado = total.toFixed(2).replace('.', ',');

  const mensagem = `Olá! Quero reservar os seguintes números da rifa: ${numerosTexto}.\nValor total: R$ ${valorFormatado}.\nComo posso realizar o pagamento?`;
  const telefone = "5511999999999"; // número fictício

  const url = `https://wa.me/${telefone}?text=${encodeURIComponent(mensagem)}`;
  window.open(url, '_blank');
});
