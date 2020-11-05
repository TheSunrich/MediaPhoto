<?php

namespace mediaphotoapp\model;

class Photo extends \Illuminate\Database\Eloquent\Model{

	protected $table ='photo';
	protected $primaryKey ='idPhoto';
	public $timestamps=false;
}