<?php

namespace Picinside;

use Illuminate\Database\Eloquent\Model;

class Taxrelations extends Model
{
    protected $table ='tax_relationship';
    protected $fillable =[
        'object_id','tax_id','object_type','tax_order'
    ];
}
