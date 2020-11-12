<?php
    namespace mediaphotoapp\control;

    /**
     * TODO: contrôler les données formulaires
     */

    use \mediaphotoapp\model\Commentaire;
    use \mediaphotoapp\model\Depot;
    use \mediaphotoapp\model\Galerie;
    use \mediaphotoapp\model\Groupe;
    use \mediaphotoapp\model\Photo;
    use \mediaphotoapp\model\Utilisateur;
    use \mediaphotoapp\view\ConnexionView;
    use \mediaphotoapp\view\GalerieView;
    //use \mediaphotoapp\view\MediaphotoAdminView;
    use \mediaphotoapp\auth\MediaphotoAuthentification as Auth;
    use \mf\router\Router;

    class MediaphotoAdminController extends \mf\control\AbstractController {

        public function viewLogin() {
            $view = new ConnexionView(null);
            return $view->render('login');
        }

        public function viewSignup() {
            $view = new ConnexionView(null);
            return $view->render('signup');
        }

        public function checkLogin() {
            $auth = new Auth();
            try {
                $auth->loginUser($_POST['username'], $_POST['pass']);
                $user = Utilisateur::select()
                                ->where('username', '=', $_SESSION['user_login'])
                                ->first();
                $view = new GalerieView($user);
                $view->render('homelogin');
            } catch (\Exception $e) {
                Router::executeRoute('login');
            }
        }

        public function checkSignUp() {
            $auth = new Auth;
            try {
                $auth->createUser($_POST['username'], $_POST['nom'], $_POST['prenom'], $_POST['mail'],  $_POST['password']);
                Router::executeRoute('homelogin');
            } catch (\Exception $e) {
                Router::executeRoute('inscription');
            }
        }

        public function logout() {
            $auth = new Auth();
            $auth->logout();
            Router::executeRoute('home');
        }
    }
?>