<?php

namespace Picinside;

use Illuminate\Database\Eloquent\Model;

class Iteminfo extends Model
{
    protected $primaryKey ='id';
    protected $table ='iteminfo';
    protected $fillable =[
        'item_id','price','sales','salesdate','rate','upload_update'
    ];

    public function item()
    {
        return $this->belongsTo('Items');
    }
}
