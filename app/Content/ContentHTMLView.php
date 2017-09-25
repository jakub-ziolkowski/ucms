<?php

class ContentHTMLView extends View {

    public function renderPage($model) {
        $this->loadFile("content", Config::$dir . "/html/bootstrap.html");
        $this->addTag("title", $model['title']);
        $this->addTag("html", $model['html']);
        header('Content-type: text/html');
        return $this->render("content");
    }

}
