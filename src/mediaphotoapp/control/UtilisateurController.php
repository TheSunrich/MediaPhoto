<?php 

namespace mediaphotoapp\control;
use \mediaphotoapp\model\Utilisateur as Utilisateur;

class UtilisateurController extends \mf\control\AbstractController{

	public function __construct(){
		parent::__construct();
	}

	//On va récuperer tous les utilisateurs
	public function listUsers(){ 
		$users = Utilisateur::select()
					   		->get();
		return $users;
	
	}
	//Lister un utilisateur spécifique
	public function listUser(int $idUser){ 
		$user = Utilisateur::select()
					->where("idUser","=",$idUser)
					->first();
		return $user;
	}

	//Lister les utilisateurs qui ont une ou + galeries 
	public function listUserGalerie(){
		$listsUsers = Utilisateur::select('utilisateur.idUser')
            ->join('galerie', 'galerie.idUser', '=', 'utilisateur.idUser')
            ->groupBy('utilisateur.idUser')
            ->get();
		return $listsUsers;
	}

	// S'inscrire :
	public function inscrire(string $nom,string $prenom,string $username,string $mail,string $motPasse){

		$user = new Utilisateur();
		$query = $this->listUsers();
		foreach ($query as $key) {
			if($key->username == $username){
				return "Nom d'utilisateur existe déjà veuillez le changer svp";
			}
			if($key->mail == $mail){
				return "Mail existe déjà veuillez le changer svp";
			}
		}
		$user->nom=$nom;
		$user->prenom=$prenom;
		$user->username=$username;
		$user->mail=$mail;
		$user->motPasse=$motPasse;

		$user->save();

		return $user;
	}
	
	//Se connecter
	public function seConnecter(string $username, string $motPasse){
		$user = Utilisateur::select()
                        ->where('username', 'Like', $username)
                        ->where('motPasse', 'Like', $motPasse)
                        ->first();
        if ($user != null){
        	return $user;
        }
	}

	//Modifier le profil 
	public function modifierProfil(int $idUser, string $nom,string $prenom,string $username,string $mail,string $motPasse){
		
		$user = $this->listUser($idUser);
		$user->nom=$nom;
		$user->prenom=$prenom;
		$user->username=$username;
		$user->mail=$mail;
		$user->motPasse=$motPasse;

		$user->save();
		return $user;

	}

	//Se Désinscrire  *** à vérifier avec tout le monde ***
	/*public function seDesinscrire(int $idUser){
		$user = $this->listUser($idUser);
        $user->delete();

        return "ok";
	}*/

}