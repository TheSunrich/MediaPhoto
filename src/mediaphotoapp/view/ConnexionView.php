<?php

namespace mediaphotoapp\view;
use \mf\view\AbstractView;
use \mediaphotoapp\control\Utilisateur as UtilisateurController;
use \mf\router\Router as Router;
\mf\view\AbstractView::addStyleSheet('src/css/login.css');
\mf\view\AbstractView::addStyleSheet("src/css/s'inscrire.css");

class ConnexionView extends AbstractView {


    public function __construct( $data ){
        parent::__construct($data);
    }
    
    static public function addStyleSheet($path_to_css_files){
        parent::addStyleSheet($path_to_css_files);
    }

        //------------LOGIN
        protected function renderLogin() {
            $router = new Router();
            $html = "
            <div class='content'>
            <header>
                <img class='logo' src='https://i.ibb.co/m9qLtLm/logo.png' alt='logo-app' />
            </header>
            <form method='post' class='form'  action='" . $router->urlFor('connexion') . "'>
                <div>
                    <img class='icon' src='https://i.ibb.co/D1yRkmc/User-Icon2.png' />
                    <label>Nom d'utilisateur</label><span> *</span>
                    <input name='username' id='username' type='text' placeholder='' required />
                </div>
                <div>
                    <img class='icon' src='https://i.ibb.co/W69VVHx/passIcon.png' />
                    <label>Mot de passe</label><span> *</span>
                    <input name='pass' id='pass' type='password' placeholder='' required />
                </div>
    
                <div class='actions'>
                    <div>
                        <input type='submit' value='SE CONNECTER' />
                    </div>
                    <div>
                        <a href='".$router->urlFor('signupform', [])."' class='link'>S'inscrire</a>
                    </div>
                    <a href='".$router->urlFor('home', [])."'  class='home'>
                        <img
                            src='https://www.flaticon.com/svg/static/icons/svg/25/25694.svg'
                        />
                    </a>
                </div>
            </form>
            <p>© Tous droits réservés à l'IUT Nancy-Charlemagne</p>
        </div> ";
    
            return $html;
        }

        protected function renderSignup() {
            $router = new Router();
            $html = "
            <div class='content'>
            <header>
                <img class='logo' src='https://i.ibb.co/m9qLtLm/logo.png' alt='logo-app' />
            </header>
            <form method='post' class='form'  action='" . $router->urlFor('inscription') . "'>
                <div>
                    <img class='icon' src='https://i.ibb.co/D1yRkmc/User-Icon2.png' />
                    <label>Nom</label><span> *</span>
                    <input name='nom' type='text' placeholder='' required />
                </div>
                <div>
                    <img class='icon' src='https://i.ibb.co/D1yRkmc/User-Icon2.png' />
                    <label>Prénom</label><span> *</span>
                    <input name='prenom' type='text' required />
                </div>
                <div>
                    <img class='icon' src='https://i.ibb.co/BLSCKYd/userIcon.png' />
                    <label>Nom d'utilisateur</label><span> *</span>
                    <input name='username' type='text' required />
                </div>
                <div>
                    <img class='icon' src='https://i.ibb.co/hmNwj4P/email-Icon.png' />
                    <label>Email</label><span> *</span>
                    <input name='mail' type='email' required />
                </div>
                <div>
                    <img class='icon' src='https://i.ibb.co/W69VVHx/passIcon.png' />
                    <label>Mot de passe</label><span> *</span>
                    <input name='password' type='password'required />
                </div>
                <div>
                    <img class='icon' src='https://i.ibb.co/W69VVHx/passIcon.png' />
                    <label>Confirmer mot de passe</label><span> *</span>
                    <input
                        name='confirmePassword'
                        type='password'
                        required
                    />
                </div>
    
                <div class='actions'>
                    <div>
                        <input type='submit' value='CRÉER COMPTE' />
                    </div>
                    <div>
                        <a href='".$router->urlFor('login', [])."' class='link'>Retour</a>
                    </div>
                    <a href='".$router->urlFor('home', [])."' class='home'>
                        <img
                            src='https://www.flaticon.com/svg/static/icons/svg/25/25694.svg'
                        />
                    </a>
                </div>
            </form>
            <p>© Tous droits réservés à l'IUT Nancy-Charlemagne</p>
        </div> ";
    
            return $html;
        }

    protected function renderBody($selector){

        switch ($selector) {
            case "home":
                $main = $this->renderHomeGuest();
                break;
            case "login":
                    $main = $this->renderLogin();
            break;
            case "signup":
                $main = $this->renderSignup();
            break;
            case "photo":
                $main = $this->renderPhoto();
                break;
            case "galerie":
                $main = $this->renderGalerie();
                break;
        }
        
        $html = "
        <body>
            $main;
        </body>";

        return $html;
    } 
    
}
