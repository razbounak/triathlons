<?php

namespace App\Send;

use App\App;
use App\Core\Table;

class SendMail extends Table {


    /**
     * @param $to
     * @param $sujet
     * @param $mail
     * @param $tel
     * @param $mail
     * @param $texte
     * @param $file
     */
    public static function Send($to, $sujet, $name, $tel, $email, $texte, $file){

        // HEADERS
        $boundary = md5(uniqid(microtime(), TRUE));

        $headers = 'From: ' . $email . '  <' . $email . '>'."\r\n";
        $headers .= 'Reply-to: ' . $email . ''."\r\n";
        $headers .= 'Mime-Version: 1.0'."\r\n";
        $headers .= 'Content-Type: multipart/mixed;boundary=' . $boundary . "\r\n";

        // MESSAGE
        $message = 'This is a multipart/mixed message.'."\r\n\r\n";
        $message .= '--' . $boundary . "\r\n";
        $message .= 'Content-type:text/plain;charset=utf-8'."\r\n";
        $message .= 'Content-transfer-encoding:8bit'."\r\n";
        $message .= ' ' . $texte . "\r\n";
        $message .= '<p>' . $name . '</p>' . "\r\n";
        $message .= '<p>Joignable au : ' . $tel . '</p>'. "\r\n";

        // IMAGE
        $file_name = $file['name'];

        if (file_exists($file_name)) {
            $file_type = filetype($file_name);
            $file_size = filesize($file_name);

            $handle = fopen($file_name, 'r') or die('Le file ' . $file_name .'ne peut être ouvert');
            $content = fread($handle, $file_size);
            $content = chunk_split(base64_encode($content));
            $f = fclose($handle);

            $message .= '--'.$boundary."\r\n";
            $message .= 'Content-type:'.$file_type.';name='.$file_name."\r\n";
            $message .= 'Content-transfer-encoding:base64'."\r\n\r\n";
            $message .= $content."\r\n";
        }
        // Fin
        $message .= '--'.$boundary."\r\n";
        mail($to, $sujet, $message, $headers);

    }
}