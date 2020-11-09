<?php

namespace mediaphotoapp\view;
use \mf\view\AbstractView;
use \mediaphotoapp\control\GalerieController as GalerieController;
use \mediaphotoapp\model\Galerie as Galerie;

class GalerieView extends AbstractView {

      /* Constructeur 
     * 
     * Paramètres :  
     *
     * - $data (mixed) : selon la vue, une instance d'un modèle ou un tableau 
     *                   d'instances d'un modèle
     *  Algorithme 
     *  
     * - Stocker les données passées en paramètre dans l'attribut $data.
     *   
     *
     */

    public function __construct( $data ){
        parent::__construct($data);
    }
    
    /* Méthode addStyleSheet
     * 
     * Permet d'ajouter une feuille de style à la liste:
     * 
     * Paramètres : 
     *
     * - $path_to_css_files (String) : le chemin vers le fichier 
     *                                 (relatif au script principal)
     *
     *
     */

    static public function addStyleSheet($path_to_css_files){
        parent::addStyleSheet($path_to_css_files);
    }

    private function renderFooter(){
        return "Application réalisé lors d'un projet en LP CIASIE &copy;2020'";
    }

    //View des galeries public 
    public function renderHomeGuest(){
        $html="Affichage des galeries public : <br> -------- ";
        foreach ($this->data as $key) {
           $html .= "Nom : $key->nom , <br>
                    Description : $key->description , <br>
                    Mots Clés : $key->motsCles <br>
                    Date de création : $key->dateCreation " ;
            $html .="--------";
        }
        return $html;
    }


    //view d'une galerie spécifique
    public function viewUneGalerie(){
        $galCtr = new GalerieController();
        $result = $galCtrq->listUneGalerie($_GET['idGalerie']);
        self::render($result);
    }

    //les galeries d'un user spécifique
    public function viewGaleriesUser(){
        $galCtr = new GalerieController();
        $result = $galCtrq->listGaleriesUser($_GET['idUser']);
        self::render($result);
    }

    //Rechercher les galeries avec des mots clés
    public function viewGaleriesMotsCles(){
        $galCtr = new GalerieController();
        $result = $galCtrq->listGaleriesMotsCles($_GET['motsCles']);
        self::render($result);
    }

    //Ajouter une galerie, après afficher toutes les galeries de cet user
    public function viewAjouterGalerie(){
        $galCtr = new GalerieController();
        $result = $galCtr->ajouterGalerie($_POST['nom'],$_POST['type'],
                                            $_POST['motsCles'] , $_POST['description'],
                                            $_POST['dateCreation'], $_POST['idUser']);
        $photos = $galCtr->ajouterPhotoDansGalerie($_POST['idGalerie']);
        $this->viewGaleriesUser();
    }
    protected function renderBody($selector){
        //$header = $this->renderHeader();
        
        $footer = $this->renderFooter();
        $section = $this->renderHomeGuest();
        
        $html="
<section>
${section}
</section>
<footer>${footer}</footer>";

        return $html;
    } 
    
}
