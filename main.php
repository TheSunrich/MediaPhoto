<?php

    require_once 'vendor/autoload.php';

 	require_once 'src/mf/utils/AbstractClassLoader.php';
    require_once 'src/mf/utils/ClassLoader.php';
    
    $loader = new \mf\utils\ClassLoader('src');
    $loader->register();



    use \mediaphotoapp\model\Commentaire;
    use \mediaphotoapp\model\Utilisateur;
    use \mediaphotoapp\model\Photo;
    use \mediaphotoapp\model\Galerie;
    use \mediaphotoapp\control\GalerieController;
    use \mediaphotoapp\control\PhotoController;

    use \mediaphotoapp\auth\MediaphotoAuthentification as Auth;

    use \mf\router\Router;

    $config = parse_ini_file('conf/conf.ini');

    // une instance de connexion
    $db = new Illuminate\Database\Capsule\Manager();

    $db->addConnection( $config ); // configuration avec nos paramètres
    $db->setAsGlobal();            // rendre la connexion visible dans tout le projet
    $db->bootEloquent();           // établir la connexion

    
   

    //Les routes ! : 
   	$router = new Router();

    $router->addRoute('home',
                  '/home/',
                  '\mediaphotoapp\control\GalerieController',
                  'homeGuest', Auth::ACCESS_LEVEL_NONE);

   $router->addRoute('login', '/login/', '\mediaphotoapp\control\MediaphotoAdminController', 'viewLogin', Auth::ACCESS_LEVEL_NONE);
   $router->addRoute('connexion', '/connexion/', '\mediaphotoapp\control\MediaphotoAdminController', 'checkLogin', Auth::ACCESS_LEVEL_NONE);
   $router->addRoute('logout', '/logout/', '\mediaphotoapp\control\MediaphotoAdminController', 'logout', Auth::ACCESS_LEVEL_USER);
   $router->addRoute('signupform', '/signup/', '\mediaphotoapp\control\MediaphotoAdminController', 'viewSignup', Auth::ACCESS_LEVEL_NONE);
   $router->addRoute('inscription', '/inscription/', '\mediaphotoapp\control\MediaphotoAdminController', 'checkSignUp', Auth::ACCESS_LEVEL_NONE);   

    $router->addRoute('photo',
                  '/photo/',
                  '\mediaphotoapp\control\GalerieController',
                  'listerUnePhoto', Auth::ACCESS_LEVEL_USER)  ;

    $router->addRoute('galerie',
                  '/galerie/',
                  '\mediaphotoapp\control\GalerieController',
                  'listUneGalerie', Auth::ACCESS_LEVEL_USER);

    $router->addRoute('homelogin',
                  '/homelogin/',
                  '\mediaphotoapp\control\GalerieController',
                  'homeLogin', Auth::ACCESS_LEVEL_NONE);

    $router->addRoute('touteGalerie',
                  '/galerie/toutes',
                  '\mediaphotoapp\control\GalerieController',
                  'touteGalerie', Auth::ACCESS_LEVEL_USER);

    $router->addRoute('galeriePartage',
                  '/galerie/partage',
                  '\mediaphotoapp\control\GalerieController',
                  'partageGalerie', Auth::ACCESS_LEVEL_USER);

    $router->addRoute('photologin',
                  '/photologin/',
                  '\mediaphotoapp\control\GalerieController',
                  'listerUnePhotoLogin', Auth::ACCESS_LEVEL_NONE);

    $router->addRoute('galerielogin',
                  '/galerielogin/',
                  '\mediaphotoapp\control\GalerieController',
                  'listUneGalerieLogin', Auth::ACCESS_LEVEL_NONE);

    $router->addRoute('galeriePrive',
                  '/galerie/private',
                  '\mediaphotoapp\control\GalerieController',
                  'mesGalerie', Auth::ACCESS_LEVEL_NONE);

    $router->addRoute('photoPrive',
                  '/photo/private',
                  '\mediaphotoapp\control\GalerieController',
                  'mesPhoto', Auth::ACCESS_LEVEL_USER);

    $router->addRoute('mesGalerie',
                  '/galerie/my',
                  '\mediaphotoapp\control\GalerieController',
                  'listMesGalerie', Auth::ACCESS_LEVEL_USER);
    
    $router->addRoute('mesPhotos',
                  '/photo/my',
                  '\mediaphotoapp\control\GalerieController',
                  'listMesPhoto', Auth::ACCESS_LEVEL_USER);

    $router->addRoute('creerGalerie',
                  '/galerie/add',
                  '\mediaphotoapp\control\GalerieController',
                  'ajouterGalerie', Auth::ACCESS_LEVEL_USER);

    $router->addRoute('modGalerie',
                  '/galerie/mod',
                  '\mediaphotoapp\control\GalerieController',
                  'modifierGalerie', Auth::ACCESS_LEVEL_USER);

    $router->addRoute('addPhoto',
                  '/photo/add',
                  '\mediaphotoapp\control\GalerieController',
                  'ajouterPhoto',  Auth::ACCESS_LEVEL_USER);

    $router->addRoute('modPhoto',
                  '/photo/mod',
                  '\mediaphotoapp\control\GalerieController',
                  'modifierPhoto',  Auth::ACCESS_LEVEL_USER);

       $router->addRoute('aPropos',
                  '/apropos/',
                  '\mediaphotoapp\control\GalerieController',
                  'aPropos',  Auth::ACCESS_LEVEL_USER);


    $router->setDefaultRoute('/home/');
    $router->run();


    

    // $galeriesPublic = new Galerie();
    // $galController = new mediaphotoapp\control\GalerieController();
    // echo "afficher une galerie (idGalerie = 7) :";echo "<br>";
    // echo $galController->listUneGalerie(7);

    // echo "<br>";
    // echo "<br>";

    // echo "afficher toutes les galeries (type = 0 : public) :";echo "<br>";
    // echo $galController->listGalerie(0);

    // echo "<br>";
    // echo "<br>";

    // echo "afficher les galeries d'utilisateur : 3";echo "<br>";
    // echo $galController->listGaleriesUser(3); 
    // echo "<br>";
    // echo "<br>";

    // echo "afficher selon MOTS CLES :";
    // echo "<br>";
    // echo $galController->listGaleriesMotsCles("Tech");

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";

    // $photoController = new mediaphotoapp\control\PhotoController();
    // echo "lister les photos de la galerie 3 :";echo "<br>";
    // echo $photoController->listPhotosGalerie(3);


    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "lister les photos de l'utilisateur' 1 :"; echo "<br>";
    // echo $photoController->listsPhotosUser(1);

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "lister les photos selon les motsCles :"; echo "<br>";
    // echo $photoController->listsPhotosMotsCles('Nature');

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "lister les utilisateur qui ont une ou plusieurs galeries :"; echo "<br>";
    // $userController = new mediaphotoapp\control\UtilisateurController();
    // echo $userController->listUserGalerie();

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "Inscription :"; echo "<br>";
    // echo $userController->inscrire("NOM1","aaaa","aaaa","hamza@mail.com","PASSSSWORD");

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "Se connecter :"; echo "<br>";
    // echo $userController->seConnecter('toufiktaha','12345678910');

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "Modifier le profil :"; echo "<br>";
    // echo $userController->modifierProfil(3,"bouuuum","PRENOM1","BBBBBBB","BBB@mail.fr","pipiii");

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "Ajouter photo :"; echo "<br>";
    // $photoController = new mediaphotoapp\control\PhotoController();
    // echo $photoController->ajouterPhoto("photoTEST","blablablablabla","Nature",4);

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "Ajouter photo DANS GALERIE 1:"; echo "<br>";
    // echo $galController->ajouterPhotoDansGalerie([7,8],1);

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "Ajouter user DANS GROUPE:"; echo "<br>";
    // $galController->ajouterUserDansGalerie(false);

    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "Ajouter user DANS GROUPE:"; echo "<br>";
    // $galController->ajouterUserDansGalerie(true);