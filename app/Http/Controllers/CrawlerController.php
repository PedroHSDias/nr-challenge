<?php

namespace App\Http\Controllers;

use App\Businnes\BuilderLicitacao;
use App\Businnes\CrawlerCNPQ;
use App\Businnes\FileHelper;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class CrawlerController extends Controller
{
    public function index()
    {
        dd(false!=0);
        return view('index');
    }

    public function pullcnpq()
    {

        $modelsBidding = [];
        $cnpq = new  CrawlerCNPQ();
        $cnpq->catchHtml();
        $modelsBidding[] = BuilderLicitacao::getBiddings('CNPQ', $cnpq->getGenericBiddings());
        while (!$cnpq->isLastPage()) {
            echo $cnpq->getPaginaAtual().'<br>';
            $cnpq->catchProximaPagina();
            $modelsBidding [] = BuilderLicitacao::getBiddings('CNPQ', $cnpq->getGenericBiddings());
        }
        foreach ($modelsBidding as $bidings) {
            foreach ($bidings as $bidding) {
                $bidding->save();
                foreach ($bidding->appends as $append) {
                    FileHelper::crawler($append);
                }
                $bidding->appends()->saveMany($bidding->appends);
            }
        }

        dd($modelsBidding);
        return view('index');
    }
}
