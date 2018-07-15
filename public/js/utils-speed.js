function getSiglaDocumento(nomeDocumento) {
    var obj = {
        'Instrução de Trabalho'   : 'IT',
        'Procedimentos de Gestão' : 'PG',
        'Diretrizes de Gestão'    : 'DG'

    };

    return obj[nomeDocumento];
}


function getSiglaSetor(nomeSetor) {
    var obj = {
        "Administrativo"            : "ADM",
        "Armadores"                 : "ARM",
        "CDI"                       : "CDI",
        "Compras"                   : "CMP",
        "Comercial"                 : "COM",
        "Comunicação"               : "COC",
        "Controladoria"             : "COT",
        "Diretoria"                 : "DIR",
        "Financeiro"                : "FIN",
        "Jurídico"                  : "JUR",
        "Manutenção"                : "MAN",
        "Meio Ambiente"             : "AMB",
        "Operação"                  : "OPE", 
        "Pessoas & Organização"     : "P&O",
        "Processos Aduaneiros"      : "ADU",
        "Projetos"                  : "PRJ",
        "Qualidade"                 : "QUA",
        "Saúde"                     : "SOC",
        "Segurança do Trabalho"     : "SET",
        "Segurança Patrimonial"     : "SEP",
        "Tecnologia da Informação"  : "TEC",
        "Transporte"                : "TRP"
    };

    return obj[nomeSetor];
}


function buildDocumentCod(tipoDocumento, setor) {
    var siglaDoc = getSiglaDocumento(tipoDocumento);
    var siglaSetor = "";

    if(siglaDoc == "IT") siglaSetor = "-" + getSiglaSetor(setor);
    
    var valorFinal = siglaDoc + siglaSetor;
    return valorFinal;
}


function showToast(h, t, i) {
    $.toast({
        heading: h,
        text: t,
        position: 'top-right',
        loaderBg:'#ff6849',
        icon: i,
        hideAfter: 3500, 
        stack: 6
    });
}