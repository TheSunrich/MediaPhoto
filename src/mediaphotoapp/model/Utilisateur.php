<?php

namespace mediaphoto\model;

class Utilisateur extends \Illuminate\Database\Eloquent\Model{

	protected $table ='utilisateur';
	protected $primaryKey ='idUser';
	public $timestamps=false;
}