<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licitacao extends Model
{
    protected $primaryKey = 'idtb_licitacao';
    protected $table = 'tb_licitacao';
    protected $guarded = [];
    public $timestamps = 'false';
}
