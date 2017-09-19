<?php

abstract class View {

    /**
     *
     * @var Array
     */
    public $buffer = array();

    /**
     *
     * @var Array
     */
    public $tags = array();

    /**
     * Load template file from String
     * @param String $tpl Template internal name
     * @param String $buffer Template string buffer
     */
    public function load($tpl, $buffer) {
        $this->buffer[$tpl] = $buffer;
    }

    /**
     * Load template file from external file
     * @param String $tpl Template internal name
     * @param String $buffer Template file path
     */
    public function loadFile($tpl, $path) {
        $this->buffer[$tpl] = file_get_contents($path);
    }

    /**
     * Add variable to use with template buffer
     * @param type $key Tag name
     * @param type $value Tag value
     */
    public function addTag($key, $value) {
        $this->tags[$key] = $value;
    }

    /**
     * Acquire view variables and parse template buffer
     * @param type $tpl Template internal name
     * @return String Parsed template string buffer
     */
    public function parse($tpl) {
        if (!empty($this->tags)) {
            foreach ($this->tags as $k => $v) {
                $this->buffer[$tpl] = str_replace('${' . $k . '}', $v, $this->buffer[$tpl]);
            }
        }
        return $this->buffer[$tpl];
    }

    /**
     * Render template
     * @param type $tpl Template internal name
     * @return String Template string buffer
     */
    public function render($tpl) {
        $this->parse($tpl);
        return $this->buffer[$tpl];
    }

}
