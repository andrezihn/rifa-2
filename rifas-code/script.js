const iconeHamburguer = document.querySelector('.icone-hamburguer');
const navBar = document.querySelector('nav');
const links = document.querySelectorAll('nav a');
const container = document.getElementById('numeros');
const quantidadeSpan = document.getElementById('quantidade');
const totalSpan = document.getElementById('total');
const whatsappBtn = document.getElementById('whatsappBtn');
const valorPorNumero = 50;
let selecionados = [];
let bloqueados = [];

const scriptURL = 'https://script.google.com/macros/s/AKfycbzht-XVQCWx0sJHfm6CquKiqjf0-Mxwu8oTsFA1zfmjhYx5C7Pztb08R4hnRg1lKTeH/exec';

iconeHamburguer.addEventListener('click', () => {
  iconeHamburguer.classList.toggle('ativo');
  navBar.classList.toggle('ativo');
});

links.forEach(link => {
  link.addEventListener('click', () => {
    iconeHamburguer.classList.remove('ativo');
    navBar.classList.remove('ativo');
  });
});

function calcularTotal(qtd) {
  if (qtd === 5) return 200;
  if (qtd === 6) return 250;
  if (qtd === 7) return 300;
  if (qtd === 8) return 350;
  if (qtd === 9) return 400;
  if (qtd === 10) return 350;
  return qtd * valorPorNumero;
}

function atualizarResumo() {
  const qtd = selecionados.length;
  const total = calcularTotal(qtd);

  quantidadeSpan.textContent = qtd;
  totalSpan.textContent = "R$ " + total.toFixed(2).replace('.', ',');
}

function criarNumeros() {
  for (let i = 1; i <= 400; i++) {
    const div = document.createElement('div');
    div.classList.add('numero');
    div.textContent = i;

    if (bloqueados.includes(i)) {
      div.classList.add('bloqueado');
      div.title = 'Número já reservado';
    } else {
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
    }

    container.appendChild(div);
  }
}

function carregarNumerosBloqueados() {
  fetch(scriptURL)
    .then(response => response.json())
    .then(data => {
      bloqueados = data.map(item => parseInt(item.numero));
      criarNumeros();
    })
    .catch(error => {
      console.error('Erro ao carregar os números bloqueados:', error);
      criarNumeros(); // Mesmo se falhar, cria os números
    });
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
  const telefone = "5561995978892"; // Número de telefone para check-in

  const url = `https://wa.me/${telefone}?text=${encodeURIComponent(mensagem)}`;
  window.open(url, '_blank');
});

carregarNumerosBloqueados();
