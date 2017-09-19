<?php

class ContentXMLView extends View {

    public function renderPage($model) {
        $xml = new SimpleXMLElement('<xml/>');
        $content = $xml->addChild('page');
        $content->addChild('title', $model['title']);
        $content->addChild('content', $model['html']);
        $this->load("xmlPage", $xml->asXML());
        header('Content-type: text/xml');
        return $this->render("xmlPage");
    }

}
