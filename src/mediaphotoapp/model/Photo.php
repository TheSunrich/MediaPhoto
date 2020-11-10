<?php

namespace mediaphotoapp\model;

class Photo extends \Illuminate\Database\Eloquent\Model{

	protected $table ='photo';
	protected $primaryKey ='idPhoto';
	public $timestamps=false;

	public function user() {
		return $this->belongsTo('mediaphotoapp\model\Utilisateur', 'idUser');
}

public function galeries() {
	return $this->belongsToMany('mediaphotoapp\model\galerie', 'depot', 'idPhoto', 'idGalerie');
}

}