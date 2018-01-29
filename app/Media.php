<?php

namespace Picinside;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $primaryKey ='id';
    protected $table ='media';
    protected $fillable = [
        'item_id','url','parent','attribute','status'
    ];
}