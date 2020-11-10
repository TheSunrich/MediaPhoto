<?php 

namespace mediaphotoapp\control;
use \mediaphotoapp\model\Photo as Photo;



class PhotoController extends \mf\control\AbstractController{

	public function __construct(){
		parent::__construct();
	}

	//Lister toutes les photos 
	public function listsPhotos(){ 
		$photos = Photo::select()
					->get();
		return $photos;
	}

	//Lister les photos d'un utilisateur
	public function listsPhotosUser(int $idUser){
		$listsPhotos = Photo::select('metaDonnees')
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
	
	//Ajouter une nouvelle photo
	public function ajouterPhoto(string $nom, string $metaDonnees, string $motsCles, int $idUser){

		$photo = new Photo();
		$photo->nom=$nom;
		$photo->metaDonnees=$metaDonnees;
		$photo->motsCles=$motsCles;
		$photo->idUser=$idUser;
		
		$photo->save(); 

		return $photo;

	}
	//Modifier une photo
	public function modifierPhoto(int $idPhoto, string $nom, string $metaDonnees, string $motsCles, int $idUser){

		$photo = $this->listerUnePhoto($idPhoto);
		$photo->nom=$nom;
		$photo->metaDonnees=$metaDonnees;
		$photo->motsCles=$motsCles;
		$photo->idUser=$idUser;
		
		$photo->save(); 

		return $photo;

	}
	//supprimer une photo
	public function supprimerPhoto(int $idPhoto){

		$pic = $this->listerUnePhoto($idPhoto);
		$pic->delete(); 

		return $photo;

	}

	
}