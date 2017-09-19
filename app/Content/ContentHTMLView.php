<?php

class ContentHTMLView extends View {

    public function renderPage($model) {
        $this->loadFile("mainPage", Config::$dir . "/app/Content/tpl/".$model['template']);
        $this->addTag("path", Config::$base_url."/app/Content/tpl/");
        $this->addTag("title", $model['title']);
        $this->addTag("content", $model['html']);
        header('Content-type: text/html');
        return $this->render("mainPage");
    }

}
