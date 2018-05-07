<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Append extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'tb_apends';
    protected $guarded = [];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Bidding','tb_biddings_fk');
    }

}
