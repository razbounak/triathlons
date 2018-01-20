<?php

namespace App\HTML;

class Form {

    /**
     * @var array Données utilsées par le formulaire
     */
    private $datas;

    /**
     * @var string Tag utilisé pour entourer les champs
     */
    public $surround = "div";

    /**
     * Form constructor.
     * @param array $data Données utilsées par le formulaire
     */
    public function __construct($datas = []){
        $this->datas = $datas;
    }

    /**
     * @param $html -> Code HTML à entourer
     * @return string
     */
    private function surround($html) {
        return "<{$this->surround} class=\"form-group\">{$html}</{$this->surround}>";
    }

    /**
     * @param $index string Index de la valeur à récupérer
     * @return mixed|null
     */
    public function getValue($index){
        if(is_object($this->datas)) :
            return $this->datas->$index;
        endif;
        return isset($this->datas[$index]) ? $this->datas[$index] : null;
    }

    /**
     * @param $name
     * @param $label
     * @param array $options
     * @return string
     */
    public function input($name, $label = null, $help = null, $require = true){
        if ($label != null) :
            $label = '<label class="label" for="'. $name .'">'. ucfirst($label).'</label>';
        endif;

        if($require == false ) :
            $input = '<input type="text" name="' . $name . '" id="' . $name . '" value="' . htmlentities($this->getValue($name)) . '" class="input"  />';
        else:
            $input = '<input type="text" name="' . $name . '" id="' . $name . '" value="' . htmlentities($this->getValue($name)) . '" class="input" required aria-required="true"/>';
        endif;

        if ($help != null) :
            $aide = "<span class=\"aide\">[ $help ]</span>";
        else :
            $aide = "";
        endif;

        return $this->surround($label . $input . $aide);
    }

    public function textarea($name, $label = null, $help = null) {
        if ($label != null) :
            $label = '<label class="label" for="'. $name .'">'. ucfirst($label).'</label>';
        endif;

        $textarea = '<textarea name="' . $name . '" class="textarea" id="desc">'. $this->getValue($name) . '</textarea>';

        if ($help != null) :
            $aide = "<span class=\"aide\">[ $help ]</span>";
        else :
            $aide = "";
        endif;

        return $this->surround($label . $textarea . $aide);
    }

    public function file($name, $label, $help = null, $MAXSIZE, $require = false) {
        $label = '<label class="label" for="'. $name .'">'. ucfirst($label).'</label>';
        if ($require == true) :
            $file = '<input class="input" id="' . $name . '" name="' . $name . '" type="file"/>';
        else :
            $file = '<input class="input" id="' . $name . '" name="' . $name . '" type="file" required aria-required="true"/>';
        endif;
        $file .= '<input type="hidden" name="MAX_FILE_SIZE" value="' . $MAXSIZE . '" />';
        if ($help != null) :
            $help = "<span class=\"aide\">[ $help ]</span>";
        else :
            $help = "";
        endif;
        return $this->surround($label . $file . $help);
    }

    /**
     * @param $name
     * @param $label
     * @param null $help
     * @param $options
     * @return string
     */
    public function select($name, $label, $help = null, $options){
        $label = '<label class="label" for="'. $name .'">'. ucfirst($label).'</label>';
        $input = '<select name="' . $name . '" class="input">';
        foreach ($options as $k => $v) :
            $attributes = '';
            if ($k == $this->getValue($name)) :
                $attributes = ' selected';
            endif;
            $input .= '<option value="' . $k . '" ' . $attributes . '>' . $v . '</option>';
        endforeach;
        $input .= '</select>';
        if ($help != null) :
            $aide = "<span class=\"aide\">[ $help ]</span>";
        else :
            $aide = "";
        endif;
        return $this->surround($label . $input . $aide);
    }

    /**
     * @param $name : nom du $_POST
     * @param $label : nom du bouton
     * @param $page : nom de la page de retour en cas d'annulation
     * @return string
     */
    public function submit($name, $label, $page = null, $etoile = true){
        if($page === null) :
            return '<input class="btn danger" onClick="self.location=\'index.php?page=home\'" value="Annuler" /><!--
        --><button type="submit" name="' . $name . '" class="btn valide">' . $label . '</button>';
        endif;
        if($etoile === true) :
            $etoile = '<div class="obligatory"> * Les champs marqués d\'une étoile sont obligatoire.</div>';
        endif;
        return $etoile .'<input class="btn danger" onClick="self.location=\'index.php?page='. $page .'\'" value="Annuler" /><!--
        --><button type="submit" name="' . $name . '" class="btn valide">' . $label . '</button>';
    }

}