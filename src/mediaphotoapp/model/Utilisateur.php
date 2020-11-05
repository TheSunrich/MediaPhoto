<?php

namespace mediaphotoapp\model;

class Utilisateur extends \Illuminate\Database\Eloquent\Model{

	protected $table ='utilisateur';
	protected $primaryKey ='idUser';
	public $timestamps=false;
	
	public function hasGaleries(){
		return this->hasMany('\mediaphotoapp\model\Galerie','idGalerie');
	}
}