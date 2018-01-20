<?php

namespace App\Session;

class Session {
    
    public static function setFlash($message, $type = 'error') {
        $_SESSION['flash'] = array(
            'message' => $message,
            'type'    => $type
        );
    }

    public static function flash() {
        if (isset($_SESSION['flash'])) : ?>
            <div id="alert" class="alert">
                <span class="icon-<?php echo $_SESSION['flash']['type'];?>"></span><!--
                --><span class="text-<?php echo $_SESSION['flash']['type'];?>"><?php echo $_SESSION['flash']['message'];?></span>
            </div>
            <?php unset($_SESSION['flash']);
        endif;
    }
    
}