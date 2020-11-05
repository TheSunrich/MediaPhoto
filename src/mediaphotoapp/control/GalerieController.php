<?php 

namespace mediaphotoapp\control;

use mf\router\Router;

use \mediaphotoapp\model\Galerie as Galerie;

class GalerieController extends \mf\control\AbstractController {

	public function __construct(){
		parent::__construct();
	}

	//Lister une galerie spécifique
	public function listUneGalerie(int $id){ 
		$galerie = Galerie::select()
					->where("idGalerie","=",$id)
					->get();
		return $galerie;
	}

	//Lister les galeries (public OR private OR protected)
	public function listGalerie(int $type){ 
		$galeries = Galerie::select()
					->where("type","=",$type)
					->get();
		return $galeries;
	}

	//Lister les galeries d'un utilisateurs (public OR private OR protected)
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

}