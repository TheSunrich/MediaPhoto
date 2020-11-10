<?php

namespace mediaphotoapp\model;

class Galerie extends \Illuminate\Database\Eloquent\Model{

	protected $table ='galerie';
	protected $primaryKey ='idGalerie';
	public $timestamps=false;

	// public function photos() {
	//        return $this->hasMany('\mediaphotoapp\model\Photo','motsCles');
	// 			}

	public function user() {
		return $this->belongsTo('mediaphotoapp\model\Utilisateur', 'idUser');
}
				
	public function photos() {
					return $this->belongsToMany('mediaphotoapp\model\photo', 'depot', 'idGalerie', 'idPhoto');
				}
	
}