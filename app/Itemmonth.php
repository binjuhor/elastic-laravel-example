<?php

namespace Picinside;

use Illuminate\Database\Eloquent\Model;

class Itemmonth extends Model
{
    protected $primaryKey ='id';
    protected $table ='itemmonth';
    protected $fillable =[
        'item_id','craw_id','price','sales','salesmonth'
    ];

    private function getItems()
    {
        return $this->belongsTo('Picinside\Items');
    }
}
