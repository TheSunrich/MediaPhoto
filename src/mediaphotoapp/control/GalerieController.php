<?php 

namespace mediaphotoapp\control;

use mf\router\Router;

use \mediaphotoapp\model\Galerie as Galerie;
use \mediaphotoapp\model\Depot as Depot;
use \mediaphotoapp\model\Photo as Photo;
use \mediaphotoapp\view\GalerieView as GalerieView;
use Illuminate\Support\Facades\Storage as Storage;


class GalerieController extends \mf\control\AbstractController {

	public function __construct(){
		parent::__construct();
	}

	//Lister les galeries (public) (GUEST)
	public function homeGuest(){ 
	
	$galerie = Galerie::all();
    $vue = new GalerieView($galerie);
    $vue->render('home');
	}

	//Lister une photo spécifique
	public function listerUnePhoto(){ 

	$photo = Photo::all();
    $vue = new GalerieView($photo);
    $vue->render('photo');
		
	}

	//Lister une galerie spécifique 
	public function listUneGalerie(){ 
	
	$galerie = Galerie::all();
    $vue = new GalerieView($galerie);
	$vue->render('galerie');
	}

	//Lister les galeries (public) (CONNECTER)
	public function homeLogin(){ 
	
	$galerie = Galerie::all();
    $vue = new GalerieView($galerie);
    $vue->render('homelogin');
	}

	public function touteGalerie(){ 
	
	$galerie = Galerie::all();
    $vue = new GalerieView($galerie);
    $vue->render('touteGalerie');
	}

	public function partageGalerie(){ 
	
	$galerie = Galerie::all();
    $vue = new GalerieView($galerie);
    $vue->render('galeriePartage');
	}

	
	public function listerUnePhotoLogin(){ 

	$photo = Photo::all();
    $vue = new GalerieView($photo);
    $vue->render('photologin');
		
	}

	
	public function listUneGalerieLogin(){ 
	
	$galerie = Galerie::all();
    $vue = new GalerieView($galerie);
	$vue->render('galerielogin');
	}

	
	public function mesPhoto(){ 
	
	$photo = Photo::all();
    $vue = new GalerieView($photo);
	$vue->render('mesphoto');
	}
	
	public function mesGalerie(){ 
	
	$galerie = Galerie::all();
    $vue = new GalerieView($galerie);
	$vue->render('galeriePrive');
	}

	
	public function listMesPhoto(){ 
	
	$photo = Photo::all();
    $vue = new GalerieView($photo);
	$vue->render('mesPhotos');
	}
	
	public function listMesGalerie(){ 
	
	$galerie = Galerie::all();
    $vue = new GalerieView($galerie);
	$vue->render('galeriemy');
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

	
	//Modifier une galerie
	public function modifierGalerie(){
	    $galerie = Galerie::select()->first();
	    if(isset($_GET['id']) || isset($_POST['idGalerie'])){
            if(isset($_GET['id'])){
                $galerie = Galerie::select()->where("idGalerie","=",$_GET['id'])->first();
            } else {
                $galerie = Galerie::select()->where("idGalerie","=",$_POST['idGalerie'])->first();
                $galerie->nom=$_POST['nom'];
                $galerie->type=$_POST['type'];
                $galerie->motsCles=$_POST['motsCles'];
                $galerie->description=$_POST['description'];
                $galerie->save();
            }
	    } else {
	        Router::executeRoute('home');
        }
        $vue = new \mediaphotoapp\view\GalerieView($galerie);
        $vue->render('modGalerie');

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

	//Ajouter une nouvelle galerie
	public function ajouterGalerie(){

        if(isset($_POST['nom'])){
            $galerie = new Galerie();
            $galerie->nom=$_POST['nom'];
            $galerie->type=$_POST['type'];
            $galerie->motsCles=$_POST['motsCles'];
            $galerie->description=$_POST['description'];
            $galerie->dateCreation = date('Y-m-d');
            $galerie->idUser = 1;
            $galerie->save();
            $vue = new \mediaphotoapp\view\GalerieView(null);
            $vue->render('creerGalerie');
        } else {
            $vue = new \mediaphotoapp\view\GalerieView(null);
            $vue->render('creerGalerie');
        }
	}


	//Ajouter une nouvelle photo
    public function ajouterPhoto(){
    	
    	

     	if(isset($_POST['nom'])){
            $photo = new Photo();
            $photo->nom = $_POST['nom'];
            $photo->motsCles = $_POST['motsCles'];
            $photo->metaDonnees = "Image Choisi";  
            //$photo->metaDonnees = $FILE['imageChoisi'];  
            $photo->idUser = 1;         	
            $photo->save();
            $vue = new GalerieView(null);
            $vue->render('addPhoto');
     
		} else {
            $vue = new GalerieView(null);
            $vue->render('addPhoto');
        }
	}


	//Modifier une photo
	public function modifierPhoto(){
	    $photo = Photo::select()->first();
	    if(isset($_GET['id']) || isset($_POST['idPhoto'])){
            if(isset($_GET['id'])){
                $photo = Photo::select()->where("idPhoto","=",$_GET['id'])->first();
            } else {
                $photo = Photo::select()->where("idPhoto","=",$_POST['idPhoto'])->first();
                $photo->nom = $_POST['nom'];
            	$photo->motsCles = $_POST['motsCles'];
            	$photo->metaDonnees = "Image Choisi";  
            	$photo->idUser = 1;
                $photo->save();
            }
	    } else {
	        Router::executeRoute('home');
        }
        $vue = new \mediaphotoapp\view\GalerieView($galerie);
        $vue->render('modPhoto');

	}
	
}