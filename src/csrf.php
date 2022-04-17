<?php

class CSRF {
    
    static public function validateToken($token) {
        if($_SESSION['csrf_token'] == $token)
            return true;
        else
            return false;
    }

    static public function generateToken() {
        return md5(uniqid());
    }

    static public function csrfInputField() {
        $token = self::generateToken();
        $_SESSION['csrf_token'] = $token;
        echo '<input name="token" value="' . $token . '" hidden>';
    }
}