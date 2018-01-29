<?php

namespace Picinside;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $primaryKey ='id';
    protected $table    ='taxonomies';
    protected $fillable = [
        'taxname','description','thumbs','count','archive','status','parent'
    ];

    /**
     * Relation to taxrelation one to many
     * @return data connection from taxonomy to relation
     */
    public function catInfo()
    {
        return $this->hasMany('Picinside\Categorytree','cat_id','id');
    }

    /**
     * Relation to items one to many
     * @return data connection from taxonomy to relation
     */
    public function items()
    {
        return $this->belongsToMany('Picinside\Items','items_relationship','tax_id','object_id');
    }

    /**
     * Relation to taxrelation one to many
     * @return data connection from taxonomy to relation
     */
    public function subList()
    {
        return $this->belongsToMany('Picinside\Taxonomy','tax_relationship','tax_id','object_id');
    }

}