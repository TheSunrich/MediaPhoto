<?php

namespace mediaphotoapp\view;
use \mf\view\AbstractView;
use \mediaphotoapp\control\GalerieController as GalerieController;
use \mediaphotoapp\model\Galerie as Galerie;
use \mf\router\Router as Router;
use \mediaphotoapp\model\Photo as Photo;

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
                <a href=\"" . $router->urlFor('home') . "\"><img src='https://i.ibb.co/Q9zB0mr/logo.png' alt='logo application MediaPhoto'></a>
            </div>

            <div class='icon'>
                <img src='https://i.ibb.co/PjtNj2R/icon-login.png' alt='icon-login'/>
                <a href='login.html'>Login</a>
                <a href='inscription.html'>Register</a> 
            </div>";
        return $html;
    } 
    private function renderFooter(){
        $html = "
            <div class='socialNetworks'>
                <a href='https://github.com/RichardJohnRx/MediaPhoto'><img src='https://i.ibb.co/HtS8z2k/icon-github.png' alt='Logo de Github' width='30px'/></a>
                <a href='https://www.univ-lorraine.fr/'><img src='https://i.ibb.co/1Z6YJJ4/icon-lorraine.png' alt='Logo Université de Lorraine' width='95px'/></a>
            </div>
            
            <p>© Tous droits réservés à l'IUT Nancy-Charlemagne</p>";
        return $html;
    }

    //View des galeries public 
    public function renderHomeGuest(){
        $html="";
        $router = new \mf\router\Router();

        
        $photo = Photo::select()
            ->join('depot', 'photo.idPhoto', '=', 'depot.idPhoto')
            ->join('galerie', 'galerie.idGalerie', '=', 'depot.idGalerie')
            ->where('type','=',0)
            ->get();

        foreach ($photo as $key) {
            
            $photos = Photo::where('idPhoto', '=', $key->idPhoto)->first();
            $user = $photos->user()->first();


            $titre = "<h1>ACCUEIL</h1>";
            
            $html .="<section class='galerie'>
            
            <a href=\"" . $router->urlFor('galerie', [['id', $key->idGalerie]]) . "\"><img src=" . $photos->metaDonnees . "><div class='infosGalerieHover'>
            <h3>$photos->nom</h3>
            <p>Galerie de ". $user->prenom . ' ' . $user->nom . "</p>
        </div></a>
            </section>";
        }
        return $titre . $html;
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

    private function renderPhoto() {
        $html = '';
        $photo = $this->data;
        $router = new Router();
        
        
        foreach ($_GET as $valeur) {
            $requete = \mediaphotoapp\model\Photo::select()
					->where("idPhoto","=",$valeur)
                    ->first();
                    
                    $user = $requete->user()->first();

            $html = "<div class='grid heading'>
            <h1>
                " . $requete->nom . " <br />
                <span>Créateur : " . $user->prenom . ' ' . $user->nom . "</span>
            </h1>
        </div>

        <div class='grid photosGallery'>
            <div class='thePhoto' id='myPhoto'>
                <img src=" . $requete->metaDonnees . ">
            </div>
        </div>

        <div class='keywordsPhoto'>
            <span> " . $requete->motsCles . "</span>
        </div>";
        }
		return $html;
    }

    private function renderGalerie() {
        $html = '';
        $galerie = $this->data;
        $router = new Router();
        

        foreach ($_GET as $valeur) {
        $requete = Galerie::select()
					->where("idGalerie","=",$valeur)
                    ->first();
        
        $user = $requete->user()->first();
        
        $liste_photos = $requete->photos()->get();

        $photos = '';

        foreach ($liste_photos as $v) {

            $photos .= "<div class='thePhoto'><a href=\"" . $router->urlFor('photo', [['id', $v->idPhoto]]) . "\"><img src=" . $v->metaDonnees . "></a></div>";

            

            $html = "<div class='grid heading'>
            <h1>
                " . $requete->nom . " <br />
                <span>Galerie publique (par " . $user->prenom . ' ' .  $user->nom . ")</span>
            </h1>
        </div>
    
        <p class='lengthPhotos'></p>
    
        <p class='dateCreation'>
            Galerie créée le " . $requete->dateCreation . " par  " . $user->prenom . ' ' .  $user->nom . "
        </p>
    
        <div class='grid photosGallery'>
            " . $photos . "
        </div>
    
        <div class='keywordsPhoto'>
            <span>" . $requete->motsCles . "</span>
        </div>";
        }
        }
		return $html;
    }

    private function renderCreerGalerie() {
        $router = new \mf\router\Router();

        $html = "<form action='http://localhost/MediaPhoto/main.php/creerGalerie/' method='post'>
        <div>
            <textarea type='text' name='postTweet' placeholder='Entrer tweet...'></textarea> <br /><br />
        </div>
        <div>
            <button name='bouton' type='submit'>Poster la galerie</button><br /><br />
        </div>
     </form>";

        return $html;
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

        switch ($selector) {
            case "home":
                $main = $this->renderHomeGuest();
                break;
            case "photo":
                $main = $this->renderPhoto();
                break;
            case "galerie":
                $main = $this->renderGalerie();
                break;
            case "creerGalerie":
                $main = $this->renderCreerGalerie();
                break;
        }
        
        $html = "
        <body>
            <header class='grid'>$header</header>
            <main class='grid home myGallery createGallery'>
                $main
            </main>
            <footer class='grid'>$footer</footer>
            
    
		<script src='../../src/js/modal.js'></script>


		<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>

		<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js'></script>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js'></script>
        

        <script>
            $( document ).ready(function() {
                var lengthPhoto = $('.thePhoto').length;
                $('.lengthPhotos').html('Nombre de photos : ' + lengthPhoto + ' photos');

                var mybutton = document.getElementById('buttonGoTop');
      
                mybutton.onclick = function () {
                  $('#myModal').scrollTop(0);
                }
            });
      

      

      </script>
        </body>";

        return $html;
    } 
    
}
