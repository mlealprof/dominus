function mascaraTelefone(celular) {
    const textoCelular = celular.value;
    let celularAjustado;
    const ddd = textoCelular.slice(0, 2);
    const parte1 = textoCelular.slice(2, 7);
    const parte2 = textoCelular.slice(7, 11);
    celularAjustado = `(${ddd})${parte1}-${parte2}`;
    celular.value = celularAjustado;
}

function mascaraCep(cep) {
    const textoCep = cep.value;
    let cepAjustado;
    const parte1 = textoCep.slice(0, 5);
    const parte2 = textoCep.slice(5, 8);
    cepAjustado = `${parte1}-${parte2}`;
    cep.value = cepAjustado;
}

function mascaraData(data) {
    const textoData = data.value;
    let dataAjustado;
    const dia = textoData.slice(0, 2);
    const mes = textoData.slice(2, 4);
    const ano = textoData.slice(4, 8);
    dataAjustado = `${dia}/${mes}/${ano}`;
    data.value = dataAjustado;
}