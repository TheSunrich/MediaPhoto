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

    use \mf\router\Router;

    $config = parse_ini_file('conf/conf.ini');

    
    \mf\view\AbstractView::addStyleSheet('src/css/home_login.css');

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
                  'homeGuest');

    $router->addRoute('photo',
                  '/photo/',
                  '\mediaphotoapp\control\GalerieController',
                  'listerUnePhoto');

    $router->addRoute('galerie',
                  '/galerie/',
                  '\mediaphotoapp\control\GalerieController',
                  'listUneGalerie');

    $router->addRoute('homelogin',
                  '/homelogin/',
                  '\mediaphotoapp\control\GalerieController',
                  'homeLogin');

    $router->addRoute('toutegalerie',
                  '/toutegalerie/',
                  '\mediaphotoapp\control\GalerieController',
                  'touteGalerie');

    $router->addRoute('partagegalerie',
                  '/partagegalerie/',
                  '\mediaphotoapp\control\GalerieController',
                  'partageGalerie');

    $router->addRoute('photologin',
                  '/photologin/',
                  '\mediaphotoapp\control\GalerieController',
                  'listerUnePhotoLogin');

    $router->addRoute('galerielogin',
                  '/galerielogin/',
                  '\mediaphotoapp\control\GalerieController',
                  'listUneGalerieLogin');

    $router->addRoute('mesgalerie',
                  '/mesgalerie/',
                  '\mediaphotoapp\control\GalerieController',
                  'mesGalerie');

    $router->addRoute('mesphoto',
                  '/mesphoto/',
                  '\mediaphotoapp\control\GalerieController',
                  'mesPhoto');

    $router->addRoute('galeriemy',
                  '/galeriemy/',
                  '\mediaphotoapp\control\GalerieController',
                  'listMesGalerie');
    
    $router->addRoute('photomy',
                  '/photomy/',
                  '\mediaphotoapp\control\GalerieController',
                  'listMesPhoto');

    $router->addRoute('creerGalerie',
                  '/galerie/add',
                  '\mediaphotoapp\control\GalerieController',
                  'ajouterGalerie');

    $router->addRoute('modGalerie',
                  '/galerie/mod',
                  '\mediaphotoapp\control\GalerieController',
                  'modifierGalerie');


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