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


    // Tipos de Setores
    public static $ID_TIPO_SETOR_SETOR_NORMAL   = 1;
    
    public static $ID_TIPO_SETOR_DIRETORIA      = 2;
    
    public static $ID_TIPO_SETOR_GERENCIA       = 3;


    // Tipos de Documentos
    public static $ID_TIPO_DOCUMENTO_INSTRUCAO_DE_TRABALHO  = 1;

    public static $ID_TIPO_DOCUMENTO_PROCEDIMENTO_DE_GESTAO = 2;

    public static $ID_TIPO_DOCUMENTO_DIRETRIZES_DE_GESTAO   = 3;
    
    public static $ID_TIPO_DOCUMENTO_FORMULARIO             = 4;


    // Etapas do Workflow (Controla o "andamento" do documento)
    public static $ETAPA_WORKFLOW_ELABORADOR_NUM                     = 1;
    public static $ETAPA_WORKFLOW_ELABORADOR_TEXT                    = "Elaborador";
    
    public static $ETAPA_WORKFLOW_QUALIDADE_NUM                      = 2;
    public static $ETAPA_WORKFLOW_QUALIDADE_TEXT                     = "Qualidade";
    
    public static $ETAPA_WORKFLOW_AREA_DE_INTERESSE_NUM              = 3;
    public static $ETAPA_WORKFLOW_AREA_DE_INTERESSE_TEXT             = "Área de Interesse";
    
    public static $ETAPA_WORKFLOW_APROVADOR_NUM                      = 4;
    public static $ETAPA_WORKFLOW_APROVADOR_TEXT                     = "Aprovador";
    
    public static $ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_NUM       = 5;
    public static $ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_TEXT      = "Upload da Lista de Presença";
    
    public static $ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_NUM  = 6;
    public static $ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_TEXT = "Correção da Lista de Presença";
    
    public static $ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM                 = 7;
    public static $ETAPA_WORKFLOW_CAPITAL_HUMANO_TEXT                = "Capital Humano";


    // Descrição do Workflow
    // Alinhar as seguintes etapas: 'Próximo de vencimento', 'Emissão', 'Em elaboração', 'Aprovado pela Gerência ou Diretoria', 'Em treinamento', 'Documento divulgado' [ALEḾ DE IDENTIFICAR MOMENTOS CONFLITANTES]

    public static $DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE             = "Em análise pela área de qualidade";

    public static $DESCRICAO_WORKFLOW_ANALISE_AREA_DE_INTERESSE             = "Em análise pela área de interesse";
    
    public static $DESCRICAO_WORKFLOW_ANALISE_APROVADOR                     = "Em análise pelo aprovador";
    
    public static $DESCRICAO_WORKFLOW_ANALISE_CAPITAL_HUMANO                = "Em análise pelo Capital Humano";
    
    public static $DESCRICAO_WORKFLOW_APROVADO_AREA_DE_QUALIDADE            = "Aprovado pela área de qualidade";
    
    public static $DESCRICAO_WORKFLOW_APROVADO_AREA_DE_INTERESSE            = "Aprovado pela área de interesse";
    
    public static $DESCRICAO_WORKFLOW_APROVADO_GERENCIA                     = "Aprovado pela Gerência";  // Documentos IT, PG
    public static $DESCRICAO_WORKFLOW_APROVADO_DIRETORIA                    = "Aprovado pela Diretoria"; // Documentos DG
    
    public static $DESCRICAO_WORKFLOW_APROVADO_CAPITAL_HUMANO               = "Aprovado pelo capital humano";
    
    public static $DESCRICAO_WORKFLOW_EM_TREINAMENTO                        = "Em treinamento";

    public static $DESCRICAO_WORKFLOW_DOCUMENTO_DIVULGADO                   = "Documento divulgado";
    
    public static $DESCRICAO_WORKFLOW_VALIDADE_VENCIDA                      = "Validade Vencida";
}


?>