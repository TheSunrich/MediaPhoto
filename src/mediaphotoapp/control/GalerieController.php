<?php 

namespace mediaphotoapp\control;

use mf\router\Router;

use \mediaphotoapp\model\Galerie as Galerie;
use \mediaphotoapp\model\Depot as Depot;
use \mediaphotoapp\model\Groupe as Groupe;


class GalerieController extends \mf\control\AbstractController {

	public function __construct(){
		parent::__construct();
	}

	//Lister une galerie spécifique
	public function listUneGalerie(int $id){ 
		$galerie = Galerie::select()
					->where("idGalerie","=",$id)
					->first();
		return $galerie;
	}

	//Lister les galeries (public OR private OR protected)
	public function listGalerie(int $type){ 
		$galeries = Galerie::select()
					->where("type","=",$type)
					->get();
		return $galeries;
	}

	//Lister les galeries d'un utilisateurs 
	public function listGaleriesUser(int $idUser){
		$listsGaleries = Galerie::select()
					->where("idUser","=",$idUser)
					->get();
		return $listsGaleries;
	}

	//Lister les galeries de tous les utilisateurs selon les mots clés
	public function listGaleriesMotsCles(string $motscles){
		$listsGaleries = Galerie::select()
					->where("motsCles","Like",$motscles)
					->get();
		return $listsGaleries;
	}

	//Ajouter une nouvelle galerie
	public function ajouterGalerie(string $nom, int $type,string $motsCles, string $description, string $dateCreation, int $idUser){

		$galerie = new Galerie();
		$galerie->nom=$nom;
		$galerie->type=$type;
		$galerie->motsCles=$motsCles;
		$galerie->description=$description;
		$galerie->dateCreation=$dateCreation;
		$galerie->idUser=$idUser;
		
		$galerie->save(); 

		return $galerie;

	}
	//Modifier une galerie
	public function modifierGalerie(int $idGalerie, string $nom, int $type,string $motsCles, string $description){
		$galerie = $this->listUneGalerie($idGalerie);
		$galerie->nom=$nom;
		$galerie->type=$type;
		$galerie->motsCles=$motsCles;
		$galerie->description=$description;
		
		$galerie->save();

		return $galerie;
	}

	//supprimer une galerie
	public function supprimerGalerie(int $idGalerie){

		$galerie = $this->listUneGalerie($idGalerie);
		$galerie->delete(); 

		return "OK";

	}

	//Ajouter photo/photos dans une galerie 
	public function ajouterPhotoDansGalerie(array $photos,int $idGalerie){ 
		
		foreach ($photos as $key) {
			$depot = new Depot();
			$depot->idGalerie=$idGalerie;
			$depot->idPhoto=$key;
			$depot->save();
		}
		
		return "ok";
	}

	//Ajouter un utilisateur dans une galerie privée/partagée (Table pivote Groupe)
    public function ajouterUserDansGroupe(int $idUser, int $idGalerie, $typeUser= true){
        $groupe = new Groupe();
        $groupe->idUser = $idUser;
        $groupe->idGalerie = $idGalerie;
        $groupe->typeUser = $typeUser;
        $groupe->save();

        return "ok";
    }

    //Supprimer un utilisateur dans une galerie privée/partagée (Table pivote Groupe)
    public function supprimerUserDansGroupe(int $idUser, int $idGalerie){
	    $groupe = Groupe::select()
                        ->where("idUser","=",$idUser)
                        ->where("idGalerie","=",$idGalerie)
                        ->first();
        $groupe->delete();

        return "ok";
    }



}