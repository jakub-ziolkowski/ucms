<?php

class ApplicationErrorHandler extends View {

    public function render404() {
        $this->loadFile("404Page", Config::$dir . "/404.html");
        $this->addTag("version", Config::$version);
        $this->addTag("request_uri", $_SERVER['REQUEST_URI']);

        return $this->render("404Page");
    }

    public function render500() {
        $this->loadFile("500Page", Config::$dir . "/500.html");
        $this->addTag("version", Config::$version);
        $this->addTag("request_uri", $_SERVER['REQUEST_URI']);

        return $this->render("500Page");
    }

}
