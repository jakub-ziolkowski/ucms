<?php

class ContentHTMLView extends View {

    public function renderPage($model) {
        $this->loadFile("html", Config::$dir . "/html/bootstrap.html");
        $this->load("body", $model['html']);
        $this->addTag("title", $model['title']);
        $this->addTag("html", $this->render('body'));
        header('Content-type: text/html');
        return $this->render("html");
    }

}
