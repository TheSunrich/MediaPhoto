<?php

namespace mediaphotoapp\view;
use \mf\view\AbstractView;
use \mediaphotoapp\control\GalerieController as GalerieController;
use \mediaphotoapp\model\Galerie as Galerie;
use \mf\router\Router as Router;

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
    private function renderHeader(){
        $router = new Router();
        $html = "
            <div class='recherche' method='GET' action='searchbar.php'>
                <form>
                    <input id='search' type='search' name='searchbar' placeholder='Recherche...' ></input>
                </form>
            </div>
            
            <div class='logo'>
                <a href= '" . $router->urlFor('Home',"") ."  ' > <img src='../src/images/logo.png' alt='logo-app' /> <a/>
            </div>

            <div class='icon'>
                <img src='../src/images/icon_login.png' alt='icon-login'/>
                <a href='login.html'>Login</a>
                <a href='inscription.html'>Register</a> 
            </div>";
        return $html;
    } 
    private function renderFooter(){
        $html = "
            <div class='socialNetworks'>
                <a href='https://github.com/RichardJohnRx/MediaPhoto'><img src='../src/images/icon_github.svg' alt='Logo de Github' width='30px'/></a>
                <a href='https://www.univ-lorraine.fr/'><img src='../src/images/icon_lorraine.svg' alt='Logo de l'Université de Lorraine' width='95px'/></a>
            </div>
            
            <p>© Tous droits réservés à l'IUT Nancy-Charlemagne</p>";
        return $html;
    }

    //View des galeries public 
    public function renderHomeGuest(){
        $html="";
        foreach ($this->data as $key) {
            $html .="<section class='galerie'>
                <a href='guestGalerie.html'>
                
            
                 $key->nom
                </a>
                <div class='infosGalerieHover'>
                    <h3>Style japonais</h3>
                    <p>Par Antonin Winterstein</p>
                </div>
            </section>";
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
        $header = $this->renderHeader();
        $footer = $this->renderFooter();
        $section = $this->renderHomeGuest();
        
        $html="
<header  class='grid'>
    ${header}
</header>
<main class='grid home'>
    ${section}
   
</main>
<footer class='grid'>
    ${footer}
</footer>";

        return $html;
    } 
    
}
