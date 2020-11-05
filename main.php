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
    use \mf\router\Router;

    $config = parse_ini_file('conf/conf.ini');


    // une instance de connexion
    $db = new Illuminate\Database\Capsule\Manager();

    $db->addConnection( $config ); // configuration avec nos paramètres
    $db->setAsGlobal();            // rendre la connexion visible dans tout le projet
    $db->bootEloquent();           // établir la connexion

    //$galeriesPublic = new Galerie();
    $galController = new mediaphotoapp\control\GalerieController();
    echo "afficher une galerie (idGalerie = 7)";echo "<br>";
    echo $galController->listUneGalerie(7);

    echo "<br>";
    echo "<br>";

    echo "afficher toutes les galeries (type = 0 : public)";
    echo $galController->listGalerie(0); // 

    echo "<br>";
    echo "<br>";

    echo "afficher les galeries d'utilisateur : 3";
    echo $galController->listGaleriesUser(3); 
    echo "<br>";
    echo "<br>";

    echo "afficher selon MOTS CLES";
    echo "<br>";
    echo "<br>";
    echo $galController->listGaleriesMotsCles("Tech");

    echo "<br>";
    echo "<br>";

