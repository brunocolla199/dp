<?php


namespace App\Classes;

class Constants {

    // Tipos de Setores
    public static $ID_TIPO_SETOR_SETOR_NORMAL = 1;
    
    public static $ID_TIPO_SETOR_GRUPO_DE_TREINAMENTO = 2;
    
    public static $ID_TIPO_SETOR_GRUPO_DE_DIVULGACAO = 3;


    // Tipos de Documentos
    public static $ID_TIPO_DOCUMENTO_INSTRUCAO_DE_TRABALHO = 1;

    public static $ID_TIPO_DOCUMENTO_PROCEDIMENTO_DE_GESTAO = 2;

    public static $ID_TIPO_DOCUMENTO_DIRETRIZES_DE_GESTAO = 3;


    // Tipo Grupo de Interesse
    public static $ID_TIPO_GRUPO_INTERESSE_USUARIO = 1;

    public static $ID_TIPO_GRUPO_INTERESSE_SETOR = 2;


    // Etapas do Workflow
    // Alinhas as seguintes etapas: 'Próximo de vencimento', 'Emissão', 'Em elaboração', 'Aprovado pela Gerência ou Diretoria', 'Em treinamento', 'Documento divulgado' [ALEḾ DE IDENTIFICAR MOMENTOS CONFLITANTES]

    public static $ETAPA_WORKFLOW_ANALISE_AREA_DE_QUALIDADE             = "Em análise pela área de qualidade";

    public static $ETAPA_WORKFLOW_ANALISE_AREA_DE_INTERESSE             = "Em análise pela área de interesse";
    
    public static $ETAPA_WORKFLOW_ANALISE_APROVADOR                     = "Em análise pelo aprovador";
    
    public static $ETAPA_WORKFLOW_ANALISE_CAPITAL_HUMANO                = "Em análise pelo Capital Humano";
    
    public static $ETAPA_WORKFLOW_APROVADO_AREA_DE_QUALIDADE            = "Aprovado pela área de qualidade";
    
    public static $ETAPA_WORKFLOW_APROVADO_AREA_DE_INTERESSE            = "Aprovado pela área de interesse";
    
    public static $ETAPA_WORKFLOW_APROVADO_GERENCIA                     = "Aprovado pela Gerência";  // Documentos IT, PG
    public static $ETAPA_WORKFLOW_APROVADO_DIRETORIA                    = "Aprovado pela Diretoria"; // Documentos DG
    
    public static $ETAPA_WORKFLOW_APROVADO_CAPITAL_HUMANO               = "Aprovado pelo capital humano";
    
    public static $ETAPA_WORKFLOW_EM_TREINAMENTO                        = "Em treinamento";

    public static $ETAPA_WORKFLOW_DOCUMENTO_DIVULGADO                   = "Documento divulgado";
    
    public static $ETAPA_WORKFLOW_VALIDADE_VENCIDA                      = "Validade Vencida";
}


?>