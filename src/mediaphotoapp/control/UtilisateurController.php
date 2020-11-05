<?php 

namespace mediaphotoapp\control;
use \mediaphotoapp\model\Utilisateur as Utilisateur;

class UtilisateurController extends \mf\control\AbstractController{

	public function __construct(){
		parent::__construct();
	}

	//On va récuperer tous les utilisateurs
	public function listUsers(){ 

		$utilisateurs = Utilisateur::select()->get();
		return $utilisateurs;
	
	}
	//Lister un utilisateur spécifique
	public function listUser(int $id){ 
		$user = Utilisateur::select()
					->where("idUser","=",$id)
					->get();
		return $user;
	}

	//Lister les utilisateurs qui ont une ou + galeries  PAS ENCORE TERMINEE
	public function listUserGalerie(int $idUser){
		//.... ici 
		return "";

	}

	


}