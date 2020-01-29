<?php

namespace App\Classes;

class Constants {

    // Níveis de acesso ao documento
    public static $NIVEL_ACESSO_DOC_CONFIDENCIAL            = "Confidencial";
    
    public static $NIVEL_ACESSO_DOC_RESTRITO                = "Restrito";
    
    public static $NIVEL_ACESSO_DOC_LIVRE                   = "Livre";

    // Tipos de Agrupamentos [SELECT]
    public static $ID_TIPO_AGRUPAMENTO_SETOR                = 0;
    
    public static $ID_TIPO_AGRUPAMENTO_GRUPO_TREINAMENTO    = 1;
    
    public static $ID_TIPO_AGRUPAMENTO_GRUPO_DIVULGACAO     = 2;
    
    public static $ID_TIPO_AGRUPAMENTO_APROVADORES_POR_SETOR= 3;


    // Tipos de Setores
    public static $ID_TIPO_SETOR_SETOR_NORMAL   = 1;
    
    public static $NOME_SETOR_SEM_SETOR         = "Sem Setor";


    // Tipos de Documentos
    public static $ID_TIPO_DOCUMENTO_INSTRUCAO_DE_TRABALHO  = 1;

    public static $ID_TIPO_DOCUMENTO_PROCEDIMENTO_DE_GESTAO = 2;

    public static $ID_TIPO_DOCUMENTO_DIRETRIZES_DE_GESTAO   = 3;
    
    public static $ID_TIPO_DOCUMENTO_FORMULARIO             = 4;


    // Propriedades - Controle de Registros
    public static $CONTROLE_REGISTROS = [
        'LOCAL_ARMAZENAMENTO'     => 'Armazenamento',
        'DISPOSICAO'              => 'Disposição',
        'MEIO_DISTRIBUICAO'       => 'Meio',
        'PROTECAO'                => 'Proteção',
        'RECUPERACAO'             => 'Recuperação',
        'TEMPO_RETENCAO_DEPOSITO' => 'Retenção Mínima - Arquivo Morto',
        'TEMPO_RETENCAO_LOCAL'    => 'Retenção Mínima - Local',
    ];



    // Fomatos de Documentos
    public static $EXTENSAO_DOCUMENTO  = '.html';

    public static $EXTENSAO_FORMULARIO = '.json';


    // Etapas do Workflow (Controla o "andamento" do documento)
    public static $ETAPA_WORKFLOW_ELABORADOR_NUM                     = 1;
    public static $ETAPA_WORKFLOW_ELABORADOR_TEXT                    = "Elaborador";
    
    public static $ETAPA_WORKFLOW_QUALIDADE_NUM                      = 2;
    public static $ETAPA_WORKFLOW_QUALIDADE_TEXT                     = "Processos";
    
    public static $ETAPA_WORKFLOW_AREA_DE_INTERESSE_NUM              = 3;
    public static $ETAPA_WORKFLOW_AREA_DE_INTERESSE_TEXT             = "Área de Interesse";
    
    public static $ETAPA_WORKFLOW_APROVADOR_NUM                      = 4;
    public static $ETAPA_WORKFLOW_APROVADOR_TEXT                     = "Aprovador";
    
    public static $ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_NUM       = 5;
    public static $ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_TEXT      = "Upload da Lista de Presença";
    

    public static $_DEPRECATED_ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_NUM  = 6;
    public static $_DEPRECATED_ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_TEXT = "Correção da Lista de Presença";
    public static $_DEPRECATED_ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM                 = 7;
    public static $_DEPRECATED_ETAPA_WORKFLOW_CAPITAL_HUMANO_TEXT                = "Análise da Lista de Presença";



    // Descrição do Workflow
    public static $DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE             = "Em análise pela área de processos";

    public static $DESCRICAO_WORKFLOW_ANALISE_AREA_DE_INTERESSE             = "Em análise pela área de interesse";
    
    public static $DESCRICAO_WORKFLOW_ANALISE_APROVADOR                     = "Em análise pelo aprovador";
    
    
    public static $DESCRICAO_WORKFLOW_APROVADO_AREA_DE_QUALIDADE            = "Aprovado pela área de Processos";
    
    public static $DESCRICAO_WORKFLOW_APROVADO_AREA_DE_INTERESSE            = "Aprovado pela área de interesse";
    
    public static $DESCRICAO_WORKFLOW_APROVADO_GERENCIA                     = "Aprovado pela Gerência";  // Documentos IT, PG
    public static $DESCRICAO_WORKFLOW_APROVADO_DIRETORIA                    = "Aprovado pela Diretoria"; // Documentos DG
    
    public static $DESCRICAO_WORKFLOW_EM_TREINAMENTO                        = "Em treinamento";
    
    public static $DESCRICAO_WORKFLOW_EM_REVISAO                            = "Em revisão";
    
    public static $DESCRICAO_WORKFLOW_DOCUMENTO_DIVULGADO                   = "Documento divulgado";
    
    public static $DESCRICAO_WORKFLOW_FORMULARIO_DIVULGADO                  = "Formulário divulgado";
    
    public static $DESCRICAO_WORKFLOW_VALIDADE_VENCIDA                      = "Validade Vencida";
    
    public static $DESCRICAO_WORKFLOW_EMISSAO                               = "Emissão";
    
    public static $DESCRICAO_WORKFLOW_EM_ELABORACAO                         = "Em Elaboração";
    
    public static $DESCRICAO_WORKFLOW_REJEITADO_QUALIDADE                   = "Devolvido para correção pelo setor Processos";
    
    public static $DESCRICAO_WORKFLOW_REJEITADO_AREA_INTERESSE              = "Devolvido para correção pela Área de Interesse";
    
    public static $DESCRICAO_WORKFLOW_REJEITADO_APROVADOR                   = "Devolvido para correção pelo Aprovador";
    
    public static $DESCRICAO_WORKFLOW_REENVIADO_COLABORADOR                 = "Reenviado pelo Elaborador";

    public static $DESCRICAO_WORKFLOW_UPDATE_FILE_SEM_ELABORADOR            = "Formulário atualizado";
    
    public static $DESCRICAO_WORKFLOW_AGUARDANDO_LISTA_DE_PRESENCA          = "Aguardando lista de presença";
    
    public static $DESCRICAO_WORKFLOW_SOLICITACAO_DE_REVISAO                = "Solicitado revisão do documento";
    
    public static $DESCRICAO_WORKFLOW_REVISAO_CANCELADA_PARTE_1             = "Revisão ";
    public static $DESCRICAO_WORKFLOW_REVISAO_CANCELADA_PARTE_2             = " do documento foi cancelada.";
    
    public static $DESCRICAO_WORKFLOW_REVISAO_FORM_CANCELADA_FULL           = "Revisão do formulário foi cancelada.";
    
    public static $DESCRICAO_WORKFLOW_RETORNA_REVISAO_ANTERIOR_PARTE_1      = "Revisão ";
    public static $DESCRICAO_WORKFLOW_RETORNA_REVISAO_ANTERIOR_PARTE_2      = " do documento foi restaurada.";
    
    public static $DESCRICAO_WORKFLOW_RETORNA_REVISAO_ANTERIOR_FORM_FULL    = "Revisão anterior do formulário foi restaurada.";
    
    public static $DESCRICAO_WORKFLOW_FORM_REVISAO_INICIADA                 = "Revisão do formulário iniciada";
    
    public static $DESCRICAO_WORKFLOW_FORM_MARCADO_COMO_OBSOLETO            = "Marcou o formulário como obsoleto.";
    
    public static $DESCRICAO_WORKFLOW_DOC_MARCADO_COMO_OBSOLETO             = "Marcou o documento como obsoleto.";
    
    public static $TEXTO_EMAIL_ENVIO_LISTA_PRESENCA_AO_SETOR_PESSOAS        = "Lista de presença enviada para: ";

    public static $DOCUMENTO_SUBSTITUIDO                                    = "Documento substituído através da função de upload pelo usuário: ";
    
    
    public static $_DEPRECATED_DESCRICAO_WORKFLOW_ANALISE_CAPITAL_HUMANO                = "Em análise pelo Capital Humano";
    public static $_DEPRECATED_DESCRICAO_WORKFLOW_APROVADO_CAPITAL_HUMANO               = "Lista de Presença aprovada pelo Capital Humano";
    public static $_DEPRECATED_DESCRICAO_WORKFLOW_REJEITADO_CAPITAL_HUMANO              = "Lista de Presença devolvida para correção pelo Capital Humano";
    
    
    // Extras
    public static $ID_SETOR_QUALIDADE = 1; // Processos

    public static $ID_SETOR_CAPITAL_HUMANO = 14; // Pessoas & Organização
    
    public static $ID_SETOR_SEGURANCA_DO_TRABALHO = 18;

    // Todos os setores que o setor 'Segurança do Trabalho (SET)' pode visualizar
    public static $SETORES_QUE_SET_TEM_ACESSO = [
        4,  // CDI
        11, // Manutenção
        12, // Meio Ambiente
        13, // Operação
        14, // Pessoas (PeO)
        17, // Saúde
        18, // Segurança do Trabalho
        21, // Transporte 
    ];

    
    public static $ID_USUARIO_ADMIN_SETOR_QUALIDADE = 1; // [CELISE] Verificar se for importado do AD
    
    public static $SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS = "_rev";
 
    public static $URL_SISTEMA_PRODUCAO = "http://dpws1sva013/qualidade/login";
    
    public static $SEPARADOR_PARA_CONCATENACOES = "; ";
}
