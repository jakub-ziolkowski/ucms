<?php

class ApplicationErrorHandler extends View {

    public function serverTags() {
        if (Config::$debug) {
            $this->addTag("version_string", filter_input(INPUT_SERVER, "SERVER_SOFTWARE") . ", PHP " . phpversion() . ", " . Config::$version);
        } else {
            $this->addTag("version_string", "");
        }
        $this->addTag("request_uri", filter_input(INPUT_SERVER, "REQUEST_URI"));
    }

    public function render404() {
        $this->loadFile("404Page", Config::$dir . "/404.html");
        $this->serverTags();
        return $this->render("404Page");
    }

    public function render500() {
        $this->loadFile("500Page", Config::$dir . "/500.html");
        $this->serverTags();

        return $this->render("500Page");
    }

}
