<?php 

namespace mediaphotoapp\control;
use \mediaphotoapp\model\Commentaire as Commentaire;

class CommentaireController extends \mf\control\AbstractController{

	public function __construct(){
		parent::__construct();
	}

	//Lister un commentaire spécifique : 
	public function listCommentaire(int $idCommentaire){
		$listCommentaire = Commentaire::select()
					->where("idCommentaire","=",$idCommentaire)
					->first();
		return $listCommentaire;
	}

	//Rechercher les commentaires d'une galérie : 
	public function listsCommentairesGalerie(int $idGalerie){
		$listsCommentaires = Commentaire::select()
					->where("idGalerie","=",$idGalerie)
					->get();
		return $listsCommentaires;
	}

	//Rechercher les commentaires d'une photo : 
	public function listsCommentairesPhoto(int $idPhoto){
		$listsCommentaires = Commentaire::select()
					->where("idPhoto","=",$idPhoto)
					->get();
		return $listsCommentaires;
	}

	//Lister les commentaires d'un utilisateur dans une galérie
	public function listsCommentairesGalerieUser(int $idUser,int $idGalerie){
		$listsCommentaires = Commentaire::select()
					->where("idGalerie","=",$idGalerie)
					->where("idUser","=",$idUser)
					->get();
		return $listsCommentaires;
	}

	//Lister les commentaires d'un utilisateur dans une photo
	public function listsCommentairesPhotoUser(int $idUser,int $idPhoto){
		$listsCommentaires = Commentaire::select()
					->where("idPhoto","=",$idPhoto)
					->where("idUser","=",$idUser)
					->get();
		return $listsCommentaires;
	}
	//Ajouter un nouveau commentaire à une photo
	public function ajouterCmtPhoto(int $idUser, int $idPhoto, string $commentaire){

		$cmt = new Commentaire();
		$cmt->idUser=$idUser;
		$cmt->idPhoto=$idPhoto;
		$cmt->commentaire=$commentaire;
		
		$cmt->save(); 

		return $cmt;

	}
	//Ajouter un nouveau commentaire à une galerie
	public function ajouterCmtGalerie(int $idUser, int $idGalerie, string $commentaire){

		$cmt = new Commentaire();
		$cmt->idUser=$idUser;
		$cmt->idGalerie=$idGalerie;
		$cmt->commentaire=$commentaire;
		
		$cmt->save(); 

		return $cmt;

	}
	//Modifier un commentaire 
	public function modifierCmtPhoto(int $idCommentaire, string $commentaire){

		$cmt = $this->listCommentaire($idCommentaire);
		$cmt->commentaire=$commentaire;
		
		$cmt->save(); 

		return $cmt;

	}
	//supprimer un commentaire
	public function supprimerCmtPhoto(int $idCommentaire){

		$cmt = $this->listCommentaire($idCommentaire);
		$cmt->delete(); 

		return "ok";

	}
	
	
}