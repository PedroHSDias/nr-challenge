<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{

    protected $primaryKey = 'idtb_anexo';
    protected $table = 'tb_anexo';
    protected $guarded = [];
    public $timestamps = 'false';

}
