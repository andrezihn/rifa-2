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

    function atualizarResumo() {
      quantidadeSpan.textContent = selecionados.length;
      totalSpan.textContent = "R$ " + (selecionados.length * valorPorNumero).toFixed(2).replace('.', ',');
    }

    whatsappBtn.addEventListener('click', () => {
      const numerosTexto = selecionados.sort((a, b) => a - b).join(', ');
      const valorTotal = (selecionados.length * valorPorNumero).toFixed(2).replace('.', ',');

      const mensagem = `Olá! Quero reservar os seguintes números da rifa: ${numerosTexto}. Valor total: R$ ${valorTotal}. Como posso realizar o pagamento?`;
      const telefone = "5511999999999"; // Número fictício

      const url = `https://wa.me/${telefone}?text=${encodeURIComponent(mensagem)}`;
      window.open(url, '_blank');
    });