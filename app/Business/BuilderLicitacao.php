<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 06/05/2018
 * Time: 16:58
 */

namespace App\Business;


use App\Append;
use App\Bidding;

class BuilderLicitacao
{
    public static function getBiddings($font = null, $biddings)
    {
        $modelBiddings = [];
        if (isset($font)&&isset($biddings)) {
            if (is_array($biddings)) {
                foreach ($biddings as $b) {
                    $modelBiddings[] = self::$font($b);
                }
            } else {
                $modelBiddings = self::$font($biddings);
            }
        }
        return $modelBiddings;
    }

    private static function CNPQ($bidding)
    {
        $modelBidding= new Bidding();
        $modelBidding->name=$bidding['descricao'];
        $modelBidding->object=$bidding['objetivo'];
        $modelBidding->origin="CNPQ";
        $modelBidding->starting_date=$bidding['data'];
        $modelBidding->publiched_in=$bidding['ultimaAtualizacao'];
        $modelBidding->last_update = date('Y-m-d H:i');
        if(isset($bidding['anexos']) && count(array_filter($bidding['anexos']))>0)
        foreach ($bidding['anexos'] as $a) {
            $xpto =new Append();
            $xpto->file_link = $a['link'];
            $xpto->name = $a['desc'];

            $modelBidding->appends[]=$xpto;
        }
        return $modelBidding;
    }

}