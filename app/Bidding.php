<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tb_biddings';
    protected $guarded = [];
    public $timestamps = false;

    public function appends()
    {
        return $this->hasMany('App\Append','tb_biddings_fk','id');
    }
}
