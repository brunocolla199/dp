<?php

use Illuminate\Database\Seeder;
use App\Setor;

class SetorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $qualidade               = new Setor();
        $qualidade->nome         = "Qualidade";
        $qualidade->descricao    = "Responsável por garantir o cumprimento das políticas da empresa.";
        $qualidade->save();
        
        $administrativo              = new Setor();
        $administrativo->nome        = "Administrativo";
        $administrativo->descricao   = "Responsável pelo controle de receitas e despesas e pelo gerenciamento das tarefas e rotinas da empresa.";
        $administrativo->save();
        
        $armadores              = new Setor();
        $armadores->nome        = "Armadores";
        $armadores->descricao   = "Responsável por gerenciar as embarcações.";
        $armadores->save();
        
        $cdi              = new Setor();
        $cdi->nome        = "CDI";
        $cdi->descricao   = "Responsável por garantir a segurança empresarial, possibilitando a padronização de processos e o fluxo de informações.";
        $cdi->save();
        
        $compras              = new Setor();
        $compras->nome        = "Compras";
        $compras->descricao   = "Responsável pelo estabelecimento dos fluxos dos materiais da empresa.";
        $compras->save();
        
        $comercial              = new Setor();
        $comercial->nome        = "Comercial";
        $comercial->descricao   = "Responsável direto pelos ganhos da empresa.";
        $comercial->save();
        
        $comunicacao              = new Setor();
        $comunicacao->nome        = "Comunicação";
        $comunicacao->descricao   = "Responsável em manter informado todos os colaborades da empresa, parceiros e prestadores de serviço.";
        $comunicacao->save();
        
        $controladoria              = new Setor();
        $controladoria->nome        = "Controladoria";
        $controladoria->descricao   = "Responsável pela organização, avaliação e armazenamento das informações da empresa.";
        $controladoria->save();
        
        $diretoria              = new Setor();
        $diretoria->nome        = "Diretoria";
        $diretoria->descricao   = "Responsável em dirigir, planejar, organizar e controlar as atividades de diversas áreas da empresa.";
        $diretoria->save();
        
        $financeiro              = new Setor();
        $financeiro->nome        = "Financeiro";
        $financeiro->descricao   = "Responsável por administrar os recursos da empresa.";
        $financeiro->save();
        
        $juridico              = new Setor();
        $juridico->nome        = "Jurídico";
        $juridico->descricao   = "Responsável em orientar os assuntos jurídicos da empresa.";
        $juridico->save();
        
        $manutencao              = new Setor();
        $manutencao->nome        = "Manutenção";
        $manutencao->descricao   = "Responsável em realizar serviços para conservação da infraestrutura da empresa.";
        $manutencao->save();
        
        $meio_ambiente              = new Setor();
        $meio_ambiente->nome        = "Meio Ambiente";
        $meio_ambiente->descricao   = "Responsável por desenvolver métodos e ações, pautando-se nas noções de sustentabilidade e responsabilidade socioambiental.";
        $meio_ambiente->save();
        
        $operacao              = new Setor();
        $operacao->nome        = "Operação";
        $operacao->descricao   = "Responsável pelo planejamento, implantação e manutenação de toda a infraestrutura da empresa.";
        $operacao->save();
        
        $pessoas_organizacao              = new Setor();
        $pessoas_organizacao->nome        = "Pessoas & Organização";
        $pessoas_organizacao->descricao   = "Responsável por potencializar o capital humano.";
        $pessoas_organizacao->save();
        
        $processos_aduaneiros              = new Setor();
        $processos_aduaneiros->nome        = "Processos Aduaneiros";
        $processos_aduaneiros->descricao   = "Responsável pelas importações e exportações da empresa.";
        $processos_aduaneiros->save();
        
        $projetos              = new Setor();
        $projetos->nome        = "Projetos";
        $projetos->descricao   = "Responsável em planejar, controlar e executar os projetos da empresa.";
        $projetos->save();
        
        $saude              = new Setor();
        $saude->nome        = "Saúde";
        $saude->descricao   = "Responsável por orientar e previnir a saúde dos colaboradores.";
        $saude->save();
        
        $seguranca_do_trabalho              = new Setor();
        $seguranca_do_trabalho->nome        = "Segurança do Trabalho";
        $seguranca_do_trabalho->descricao   = "Responsável em traçar e implantar meios de projeger o colaborador de possíveis acidentes de trabalho.";
        $seguranca_do_trabalho->save();
        
        $seguranca_patrimonial              = new Setor();
        $seguranca_patrimonial->nome        = "Segurança Patrimonial";
        $seguranca_patrimonial->descricao   = "Responsável por prevenir e reduzir perdas patrimoniais na empresa.";
        $seguranca_patrimonial->save();
        
        $ti              = new Setor();
        $ti->nome        = "Tecnologia da Informação";
        $ti->descricao   = "Responsável por gerenciar as informações da empresa.";
        $ti->save();
        
        $transporte              = new Setor();
        $transporte->nome        = "Transporte";
        $transporte->descricao   = "Responsável em atuar com a rotina de operação de transporte.";
        $transporte->save();

    }
}
