<?php

class ContactView extends View {

    public function renderPage($model) {
        $this->loadFile("mainPage", Config::$dir . "/app/Contact/tpl/Contact.html");
        $this->addTag("path", Config::$base_url . "/app/Content/tpl/");
        header('Content-type: text/html');
        return $this->render("mainPage");
    }

}
