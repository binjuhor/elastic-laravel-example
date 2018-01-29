<?php

namespace Picinside;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $primaryKey ='id';
    protected $table ='items';
    protected $fillable = [
        'name','author','author_id','description','preview','sourceurl','demourl','documentation','uploaded','highsolution','widgetready','status','tags','fonts'
    ];

    /**
     * This create relationship for media table
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function getMedia()
    {
        return $this->hasMany('Picinside\Media','item_id','id');
    }

    /**
     * This create relationship for infomation of a item
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getInfo()
    {
        return $this->hasMany('Picinside\Iteminfo','item_id','items_id');
    }

    /**
     * Get taxonomy items list
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function getTaxonomy()
    {
        return $this->belongsToMany('Picinside\Taxonomy','items_relationship','id','object_id');
    }

}
