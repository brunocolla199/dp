<?php

use App\Classes\Constants;
use App\OpcoesControleRegistros;
use Illuminate\Database\Seeder;

class OpcoesControleRegistrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // MEIO_DISTRIBUICAO
        $arr  = [ 'Eletrônico', 'Físico', ];
        foreach ($arr as $opt) {
            OpcoesControleRegistros::create(['campo' => 'MEIO_DISTRIBUICAO', 'descricao' => $opt, 'ativo' => true]);
        }

        // LOCAL_ARMAZENAMENTO
        $arr  = [ 'Caderno', 'Caixa "Box"', 'Disco Rígido Local', 'Disco Rígido Rede (Servidor)', 'Disquete/CD/Fita', 'Envelope', 'Gaveta', 'Pasta A-Z', 'Pasta Classificada (Plásticos)', 'Pasta de Elástico', 'Pasta Suspensa', ];
        foreach ($arr as $opt) {
            OpcoesControleRegistros::create(['campo' => 'LOCAL_ARMAZENAMENTO', 'descricao' => $opt, 'ativo' => true]);
        }

        // PROTECAO
        $arr  = [ 'Armário', 'Arquivo', 'Backup', 'Cadeado', 'Cofre Segurança Patrimonial', 'Gaveta', 'Prateleira', 'Tranca', ];
        foreach ($arr as $opt) {
            OpcoesControleRegistros::create(['campo' => 'PROTECAO', 'descricao' => $opt, 'ativo' => true]);
        }
        
        // RECUPERACAO
        $arr  = [ '-', 'Área/Setor', 'Armador', 'Balança', 'Cliente', 'Código Material', 'Container', 'Contrato', 'Data', 'Departamento', 'Descrição', 'Documento', 'Embarque/Reembarque', 'Empresa', 'Equipamento', 'Equipe', 'Evento', 'Fornecedor/Prestador de Serviço', 'Função', 'Integrante', 'Item', 'Lote', 'Missão', 'Nº Ameaça', 'Nº API', 'Nº APT', 'Nº BL', 'Nº Chave', 'Nº Contêiner', 'Nº CSAO', 'Nº Declaração de Ciência', 'Nº Declaração de Proteção', 'Nº OC', 'Nº Protocolo', 'Nº RC', 'Nº Registro de Ocorrência', 'Nº Relatório de Análise e Investigação', 'Nº Requisição', 'Nº RO', 'Nº ROIP', 'Nº Sequencial', 'Nº Sequencial (BO)', 'Nº Sequencial (câmera)', 'Nº Sequencial (ofício)', 'Nº Série', 'Nº Série Pneu', 'Navio', 'Ordem Alfabética', 'Ordem Numérica', 'Órgão', 'Orgão Emissor', 'Processo', 'Produto', 'Produto Químico', 'Programa Ambiental', 'Projeto', 'Registro', 'Registro de Integrante', 'RTG', 'Sistema', 'Tema', 'Treinamento', 'Viagem', ];
        foreach ($arr as $opt) {
            OpcoesControleRegistros::create(['campo' => 'RECUPERACAO', 'descricao' => $opt, 'ativo' => true]);
        }
        
        // TEMPO_RETENCAO_LOCAL
        $arr  = [ '-', '1 dia', '15 dias', '30 dias', '30 dias operacional', '60 dias', '90 dias', '90 dias COV', '120 dias confere', '1 mês', '2 meses', '3 meses', '6 meses', '9 meses', '1 ano', '2 anos', '3 anos', '4 anos', '5 anos', '10 anos', 'Enquanto ativo', 'Enquanto ativo + 30 dias', 'Enquanto ativo + 60 dias', 'Enquanto ativo + 90 dias', 'Enquanto ativo + 1 mês', 'Enquanto ativo + 2 meses', 'Enquanto ativo + 3 meses', 'Enquanto ativo + 6 meses', 'Enquanto ativo + 9 meses', 'Enquanto ativo + 1 ano', 'Enquanto ativo + 2 anos', 'Enquanto ativo + 3 anos', 'Enquanto ativo + 4 anos', 'Enquanto ativo + 5 anos', 'Enquanto ativo ou por 5 anos', 'Enquanto válido', 'Enquanto válido + 30 dias', 'Enquanto válido + 60 dias', 'Enquanto válido + 90 dias', 'Enquanto válido + 1 mês', 'Enquanto válido + 2 meses', 'Enquanto válido + 3 meses', 'Enquanto válido + 6 meses', 'Enquanto válido + 9 meses', 'Enquanto válido + 1 ano', 'Enquanto válido + 2 anos', 'Enquanto válido + 3 anos', 'Enquanto válido + 4 anos', 'Enquanto válido + 5 anos', 'Enquanto vigente', 'Enquanto vigente + 30 dias', 'Enquanto vigente + 60 dias', 'Enquanto vigente + 90 dias', 'Enquanto vigente + 1 mês', 'Enquanto vigente + 2 meses', 'Enquanto vigente + 3 meses', 'Enquanto vigente + 6 meses', 'Enquanto vigente + 9 meses', 'Enquanto vigente + 1 ano', 'Enquanto vigente + 2 anos', 'Enquanto vigente + 3 anos', 'Enquanto vigente + 4 anos', 'Enquanto vigente + 5 anos', 'Até transito em julgado', 'Atualização permanente', 'Enquanto a peça estiver em uso', 'Enquanto permanência carga', 'Indeterminado', 'Não mensurável', ];
        foreach ($arr as $opt) {
            OpcoesControleRegistros::create(['campo' => 'TEMPO_RETENCAO_LOCAL', 'descricao' => $opt, 'ativo' => true]);
        }
        
        // TEMPO_RETENCAO_DEPOSITO
        $arr  = [ '-', 'Não mensurável', 'Permanente', '30 dias', '60 dias', '90 dias', '1 mês', '2 meses', '3 meses', '6 meses', '9 meses', '1 ano', '2 anos', '3 anos', '4 anos', '5 anos', '5 anos após a vigência', '10 anos', '15 anos', '20 anos', '40 anos', ];
        foreach ($arr as $opt) {
            OpcoesControleRegistros::create(['campo' => 'TEMPO_RETENCAO_DEPOSITO', 'descricao' => $opt, 'ativo' => true]);
        }

        // DISPOSICAO
        $arr  = [ '-', 'Descarte simples', 'Destruir', 'Picotar', 'Deletar', 'Reuso', 'Microfilmagem', ];
        foreach ($arr as $opt) {
            OpcoesControleRegistros::create(['campo' => 'DISPOSICAO', 'descricao' => $opt, 'ativo' => true]);
        }

    }
}
