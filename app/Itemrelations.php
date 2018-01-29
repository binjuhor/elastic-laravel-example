<?php

namespace Picinside;

use Illuminate\Database\Eloquent\Model;

class Itemrelations extends Model
{
    protected $table    ='items_relationship';
    protected $fillable =[
        'item_id','media_id','item_order'
    ];

    /**
     * Relation to items one to many
     * @return data connection from taxonomy to relation
     */
    public function listID()
    {
        return $this->belongsToMany('Picinside\Itemrelations','items_relationship','object_id','object_id');
    }
}
