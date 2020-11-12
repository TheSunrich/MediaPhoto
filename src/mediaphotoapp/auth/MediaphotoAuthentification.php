<?php

namespace mediaphotoapp\auth;

use \mf\auth\Authentification;
use mediaphotoapp\model\Utilisateur;

class MediaphotoAuthentification extends \mf\auth\Authentification{
    /*
     * Classe TweeterAuthentification qui définie les méthodes qui dépendent
     * de l'application (liée à la manipulation du modèle User) 
     *
     */

    /* niveaux d'accès de TweeterApp 
     *
     * Le niveau USER correspond a un utilisateur inscrit avec un compte
     * Le niveau ADMIN est un plus haut niveau (non utilisé ici)
     * 
     * Ne pas oublier le niveau NONE un utilisateur non inscrit est hérité 
     * depuis AbstractAuthentification 
     */
    const ACCESS_LEVEL_USER  = 100;   
    const ACCESS_LEVEL_ADMIN = 200;

    /* constructeur */
    public function __construct(){
        parent::__construct();
    }

    /* La méthode createUser 
     * 
     *  Permet la création d'un nouvel utilisateur de l'application
     * 
     *  
     * @param : $username : le nom d'utilisateur choisi 
     * @param : $pass : le mot de passe choisi 
     * @param : $fullname : le nom complet 
     * @param : $level : le niveaux d'accès (par défaut ACCESS_LEVEL_USER)
     * 
     * Algorithme :
     *
     *  Si un utilisateur avec le même nom d'utilisateur existe déjà  en BD
     *     - soulever une exception 
     *  Sinon      
     *     - créer un nouvel modèle User avec les valeurs en paramètre 
     *       ATTENTION : Le mot de passe ne doit pas être enregistré en clair.
     * 
     */
    
    public function createUser($username, $nom, $prenom, $mail, $pass, $level=self::ACCESS_LEVEL_USER) {
        $user_old = Utilisateur::select()
                            ->where('username', '=', $username)
                            ->first();
        if ($user_old != null) {
            throw new AuthException("This username is already taken", 1);
        } else {
            $user_new  = new Utilisateur();
            $user_new->username = $username;
            $user_new->nom = $nom;
            $user_new->prenom = $prenom;
            $user_new->mail = $mail;
            $user_new->motPasse = $this->hashPassword($pass, PASSWORD_DEFAULT);
            $user_new->level = $level;  
            $user_new->save();                        
        }
    }

    /* La méthode loginUser
     *  
     *
     * @param : $username : le nom d'utilisateur   
     * @param : $password : le mot de passe tapé sur le formulaire
     *
     * Algorithme :
     * 
     *  - Récupérer l'utilisateur avec l'identifiant $username depuis la BD
     *  - Si aucun de trouvé 
     *      - soulever une exception 
     *  - sinon 
     *      - réaliser l'authentification et la connexion (cf. la class Authentification)
     *
     */
    
    public function loginUser($username, $password){
        $user = Utilisateur::select()
                        ->where('username', '=', $username)
                        ->first();
        if ($user == null) {
            throw new AuthException("Incorrect username");
        } else {
            $this->login($username, $user->motPasse, $password, $user->level);
        }
    }
}