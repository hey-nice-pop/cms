<?php
function sanitize( $inputs ) {
    if ( is_array( $inputs ) ) {
        $_input = array();
        foreach ( $inputs as $key => $val ) {
            if ( is_array( $val ) ) {
                $key            = str_replace("\0", "", $key);
                $key            = htmlspecialchars( $key, ENT_QUOTES, 'UTF-8' );
                $_input[ $key ] = sanitize( str_replace("\0", "", $val) );
            } else {
                $key            = str_replace("\0", "", $key);
                $key            = htmlspecialchars( $key, ENT_QUOTES, 'UTF-8' );
                $_input[ $key ] = htmlspecialchars( str_replace("\0", "", $val), ENT_QUOTES, 'UTF-8' );
            }
        }
        return $_input;
    } else {
        return htmlspecialchars( str_replace("\0", "", $inputs), ENT_QUOTES, 'UTF-8' );
    }
}

?>