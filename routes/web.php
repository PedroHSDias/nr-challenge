<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $t = new  \App\Businnes\CrawlerCNPQ();
    $t->catchHtml();
    $licitacoes=$t->getLicitacoes();
    while(!$t->isUltimaPagina()){
       $t->catchProximaPagina();
        $licitacoes=array_merge($licitacoes,$t->getLicitacoes());
    }
    dump($licitacoes);
    return view('welcome');
});
