<?php

namespace App\Http\Controllers;

use App\Append;
use App\Bidding;
use App\Business\BuilderLicitacao;
use App\Business\CrawlerCNPQ;
use App\Business\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CrawlerController extends Controller
{
    public function index()
    {
        $biddings= Bidding::paginate(10);
        $biddings->load('appends');
        return view('index')
            ->with('biddings',$biddings);
    }

    public function pullcnpq()
    {
        $modelsBidding = [];
        $cnpq = new  CrawlerCNPQ();
        $cnpq->catchHtml();
        $modelsBidding[] = BuilderLicitacao::getBiddings('CNPQ', $cnpq->getGenericBiddings());
        while (!$cnpq->isLastPage()) {
            $cnpq->catchNextPage();
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
        return redirect()->route('home');
    }
    public function download($id){
        $append = Append::find($id);
        if(isset($append->file_location)){
            return response()->download(storage_path('app/public/').$append->file_location);
        }
    }

}
