<?php
namespace mf\auth;
use mf\auth\exception\AuthentificationException as AuthException;

class Authentification extends AbstractAuthentification {

    public function __construct() {
        $this->user_login   = isset($_SESSION['user_login']) ? $_SESSION['user_login']   : null;
        $this->access_level = isset($_SESSION['user_login']) ? $_SESSION['access_level'] : self::ACCESS_LEVEL_NONE;
        $this->logged_in    = isset($_SESSION['user_login']) ? true                      : false;
    }

    public function login($username, $db_pass, $given_pass, $level) {
        if ($this->verifyPassword($given_pass, $db_pass)) {
            $this->updateSession($username, $level);
        } else {
            throw new AuthException("Incorrect password", 1);
        }
    }

    public function logout() {
        unset($_SESSION['user_login']);
        unset($_SESSION['access_level']);
        $this->user_login = null;
        $this->access_level = self::ACCESS_LEVEL_NONE;
        $this->logged_in = false;
    }

    protected function updateSession($username, $level) {
        $this->user_login = $username;
        $this->access_level = $level;

        $_SESSION['user_login'] = $username;
        $_SESSION['access_level'] = $level;

        $this->logged_in = true;
    }

    public function checkAccessRight($requested) {
        if ($requested > $this->access_level) {
            return false;
        }
        return true;
    }

    protected function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    protected function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}
?>