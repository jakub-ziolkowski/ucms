<?php

class Form {

    public $type, $name, $action;
    public $tags = array();

    function __construct($name, $type, $action) {
        $this->type = $type;
        $this->name = $name;
        $this->action = $action;
    }

    public function addTag($tag) {
        array_push($this->tags, $tag);
    }

    public function render() {
        $html = "<form name='$this->name' type='$this->type' action='$this->action'>";
        foreach ($this->tags as $tag) {
            $html .= $tag->render();
        }
        $html .= "</form>";
        return $html;
    }

}

class InputTag {

    public $type, $name, $value;

    function __construct($type, $name, $value) {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
    }

    public function render() {
        print_r($this);
        return "<input type='$this->type' name='$this->name' value='$this->value' />";
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
