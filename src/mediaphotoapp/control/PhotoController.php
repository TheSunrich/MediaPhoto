<?php 

namespace mediaphotoapp\control;
use \mediaphotoapp\model\Photo as Photo;

class PhotoController extends \mf\control\AbstractController{

	public function __construct(){
		parent::__construct();
	}

	//Lister une photo spécifique
	public function listerUnePhoto(int $idPhoto){ 
		$photo = Photo::select()
					->where("idPhoto","=",$idPhoto)
					->first();
		return $photo;
	}

	//Lister toutes les photos 
	public function listsPhotos(){ 
		$photos = Photo::select()
					->get();
		return $photos;
	}

	//Lister les photos d'un utilisateur
	public function listsPhotosUser(int $idUser){
		$listsPhotos = Photo::select('photo.idPhoto')
					->where("idUser","=",$idUser)
					->get();
		return $listsPhotos;
	}

	//Lister les photos d'une galerie spécifique
	public function listPhotosGalerie(int $idGalerie){
		$listsPhotos = Photo::select('photo.idPhoto')
            ->join('depot', 'depot.idPhoto', '=', 'photo.idPhoto')
            ->join('galerie', 'galerie.idGalerie', '=', 'depot.idGalerie')
            ->where('depot.idGalerie','=',$idGalerie)
            ->get();
		return $listsPhotos;
	}

	//Lister les photos selon les mots clés
	public function listsPhotosMotsCles(string $motscles){
		$listsPhotos = Photo::select('photo.idPhoto')
					->where("motsCles","Like",$motscles)
					->get();
		return $listsPhotos;
	}
	
}