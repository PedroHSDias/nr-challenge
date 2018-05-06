<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 06/05/2018
 * Time: 00:03
 */

namespace App\Businnes;


use PhpParser\Node\Stmt\TryCatch;

class CrawlerCNPQ extends Crawler
{
    protected $url = 'http://www.cnpq.br/web/guest/licitacoes';
    protected $totalPaginas = null;
    protected static $erro = 0;

    public function catchProximaPagina()
    {
        $parametros = [
            //'delta' => '10'//aparentemente o numero de resultado por paginas
             'p_p_col_count' => '2'
            , 'p_p_col_id' => 'column-2'
            , 'p_p_col_pos' => '1'
            , 'p_p_id' => 'licitacoescnpqportlet_WAR_licitacoescnpqportlet_INSTANCE_BHfsvMBDwU0V'
            , 'p_p_lifecycle' => '0'
            , 'p_p_mode' => 'view'
            , 'p_p_state' => 'normal'
            , 'pagina' => ++$this->paginaAtual
            //, 'registros' => '1490'//total de registros
        ];
        try {
            parent::catchHtml($parametros);
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function isUltimaPagina()
    {
        if (!isset($this->totalPaginas)) {
            $this->findTotalPaginas();
        }
        return !($this->paginaAtual <= $this->totalPaginas);
    }

    protected function findTotalPaginas()
    {
        $totalDelta = explode('"', explode('"&delta=', $this->todoHtml)[1])[0];
        $totalRegistros = explode('"', explode('"&registros=', $this->todoHtml)[1])[0];
        $this->totalPaginas = $totalRegistros / $totalDelta;
    }

    private function filterHTMLLicitacoes()
    {
        $this->onlyBody();
        $tabelaHTML = $this->filterHTMLTabela();
        $linhasTabelaHTML = $this->filterHTMLLinhas($tabelaHTML);

        $dados = [];
        foreach ($linhasTabelaHTML as $linha) {
            $dados[] = $this->pullData($linha);
        }
        return $dados;
    }

    protected function filterHTMLTabela()
    {
        $table = explode('<tbody class="table-data">', $this->body)[1];
        $table = explode('</tbody>', $table)[0];
        return $table;

    }

    protected function filterHTMLLinhas($table)
    {
        $linhas = [];
        /*/<(tr.+)+?>/*/
        $temp = explode('<tr class=" ">', $table);
        foreach ($temp as $linha) {
            if (strlen(trim($linha)) > 1)
                $linhas[] = preg_replace("/[\r\n\t]+/", "", trim($linha));

        }
        return $linhas;
    }

    protected function pullData($linha)
    {
        $aux = $this->lineFilterTitle($linha);
        $dados['descricao'] = $aux[0];
        if (stripos($dados['descricao'], 'Dispensa de ') !== false || stripos($dados['descricao'],'Leilão') !== false )
            return null;

        $aux = $this->lineFilterDrescription($aux[1]);
        $dados['objetivo'] = $aux[0];

        if (stripos($dados['objetivo'], 'Dispensa de Licitação') !== false
            && stripos($dados['objetivo'], 'Lançada no DOU em favor Illumina') !== false)
            return null;
        $aux = $this->lineFilterOpenIn($aux[1]);
        $dados['data'] = $aux[0];

        $aux = $this->lineFilterLastUpdate($aux[1]);
        $dados['ultimaAtualizacao'] = $aux[0];
        $dados['anexos'] = $this->lineFilterApends($aux[1]);

        return $dados;
    }

    protected function lineFilterTitle($linha)
    {
        $inicio = '/<h4 class="titLicitacao">(.*?)<\/h4>/';
//        $fim='/'.preg_quote($fim).'/';
        preg_match($inicio, $linha, $temp);
        $conteudo = trim($temp[1]);
        $resto = trim(explode($temp[0], $linha, 2)[1]);
        return [$conteudo, $resto];
    }

    protected function lineFilterDrescription($linha)
    {
        $inicio = '/<.+class="cont_licitacoes"(.|\s)*?>(.|\s)*?/';
        $temp = preg_split($inicio, $linha);
        $temp = explode('</p>', $temp[1], 2);
        $conteudo = trim(strip_tags($temp[0]));
        $resto = trim($temp[1]);
        return [$conteudo, $resto];
    }

    protected function lineFilterOpenIn($linha)
    {
        $inicio = '/<.+class="data_licitacao"(.|\s)*?>(.|\s)*?span>/';
//        $fim='/'.preg_quote($fim).'/';
        $temp = preg_split($inicio, $linha);
        $temp = explode('</span>', $temp[1], 2);
        $conteudo = trim($temp[0]);
        $resto = trim($temp[1]);
        return [$conteudo, $resto];
    }

    protected function lineFilterLastUpdate($linha)
    {
        $temp = explode('<span>', $linha, 2);
        $temp = explode('</span>', $temp[1], 2);
        $conteudo = trim($temp[0]);
        $resto = trim($temp[1]);
        return [$conteudo, $resto];
    }

    protected function lineFilterApends($linha)
    {
        if(strpos($linha, '<li') <1)
            return null;
        $dados = [];
        $aux[1] = $linha;
        do {
            $aux = $this->cleanLine('a href="', '"', $aux[1]);
            $anexos['link'] = $aux[0];

            $aux = $this->cleanLine('<i class="icon icon-file"></i>', '</a></li>', $aux[1]);
            $anexos['dsc'] = $aux[0];

            $dados[] = $anexos;
            //dump(strpos($aux[1], '</ul><')>0);
        } while (strpos($aux[1], '</ul><') > 0);
        return $dados;
    }

    protected function cleanLine($inicio, $fim, $linha)
    {
        $temp = explode($inicio, $linha, 2);
        $conteudo = trim(explode($fim, $temp[1], 2)[0]);
        $resto = trim(explode($fim, $temp[1], 2)[1]);

        return [$conteudo, $resto];
    }


    public function getLicitacoes()
    {
        return array_filter($this->filterHTMLLicitacoes());
    }


}
