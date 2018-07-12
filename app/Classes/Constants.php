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
    public static $ETAPA_WORKFLOW_ELABORADOR        = "Elaborador";

    public static $ETAPA_WORKFLOW_AREA_DE_INTERESSE = "Área de Interesse";

    public static $ETAPA_WORKFLOW_QUALIDADE         = "Qualidade";
    
    public static $ETAPA_WORKFLOW_APROVADOR         = "Aprovador";
}


?>