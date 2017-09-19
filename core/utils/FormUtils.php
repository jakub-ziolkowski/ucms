`<?php

class FormUtils {

    public $formsBuffer = array();

    public function createForm($name, $type, $action) {
        $this->formsBuffer[$name] = "<form type='" . $type . "' action='" . $action . '">';
        $this->formsBuffer[$name] .= "${formData}";
        $this->formsBuffer[$name] .= "</form>";
    }

}

//put your code here
