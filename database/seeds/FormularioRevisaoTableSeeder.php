<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormularioRevisaoTableSeeder extends Seeder
{
    /**
     * Essa seed é para corrigir o problema dos formularios que foram importados pos nao ha uma revisao anterior e nessa seed eu crio os registros faltantes para poder efetuar o cancelamento.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO public.formulario_revisao(id ,codigo, revisao, nome, nome_completo, extensao, nivel_acesso, finalizado, documentos_necessitam, formulario_id, tipo_documento_id, elaborador_id, setor_id, old_grupo_divulgacao_id, created_at, updated_at)
        SELECT nextval('formulario_revisao_id_seq'), codigo, 
        CASE 
            WHEN em_revisao = false THEN revisao::text 
            WHEN em_revisao = true THEN 
                CASE 
                    WHEN ( revisao::text::integer -1) > 0 AND (revisao::text::integer -1) < 9 THEN concat('0', revisao::text::integer -1)
                    WHEN ( revisao::text::integer -1) <= 0 THEN '00' 
                    ELSE ( revisao::text::integer -1)::TEXT 
                end
        end as revisao, nome, concat(nome, '.', extensao), extensao, nivel_acesso, true, null, id, tipo_documento_id, elaborador_id, setor_id, old_grupo_divulgacao_id, created_at, updated_at 
        FROM public.formulario WHERE codigo NOT IN (SELECT codigo FROM formulario_revisao) 
        AND NOT (em_revisao = false AND finalizado = false AND revisao = '00') ");
    }
}
