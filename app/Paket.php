<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'tblpaket';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nmpaket', 'pagurmp', 'output', 'satoutput', 'outcome', 'satoutcome', 'kdpengadaan', 'kdjnspaket', 'kdjnskon', 'kdoutput', 'thnanggaran', 'kdsatker', 'id_note'
    ];
}
