<?php

class Form {

    public $method, $name, $action;
    public $tags = array();

    function __construct($name, $method, $action) {
        $this->method = $method;
        $this->name = $name;
        $this->action = $action;
    }

    public function addTag($tag) {
        array_push($this->tags, $tag);
    }

    public function render() {
        $html = "<form name='$this->name' method='$this->method'" . ((!empty($this->action)) ? " action='$this->action'>" : ">");
        foreach ($this->tags as $tag) {
            if (get_class($tag) == "HTMLGeneric") {
                $html .= $tag->render();
            } else {
                $html .= "<dl>";
                $html .= "<dt>$tag->label</dt>";
                $html .= "<dd>" . $tag->render() . "</dd>";
                $html .= "</dl>";
            }
        }
        $html .= "<input type='submit' name='test' value='Send form'></input>";
        $html .= "</form>";
        return $html;
    }

}

class HTMLGeneric {

    public $html;

    function __construct($html) {
        $this->html = $html;
    }

    public function render() {
        return $this->html;
    }

}

class HTMLInput {

    public $type, $name, $value, $label;

    function __construct($type, $name, $value, $label) {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
    }

    public function render() {
        return "<input type='$this->type' name='$this->name' value='$this->value' />";
    }

}

class HTMLTextarea {

    public $name, $value, $label;

    function __construct($name, $value, $label) {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
    }

    public function render() {
        return "<textarea name='$this->name'>$this->value</textarea>";
    }

}

class FormFactory {

    /**
     *
     * @var Form
     */
    public $form;

    public function createForm($name, $type, $action) {
        $this->form = new Form($name, $type, $action);
    }

    public function addTag($tag) {
        $this->form->addTag($tag);
    }

    public function renderForm() {
        return $this->form->render();
    }

}

//put your code here
