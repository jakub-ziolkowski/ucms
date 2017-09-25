<?php

class ContentXMLView extends View {

    public function renderPage($model) {
        $xml = new SimpleXMLElement('<page/>');
        $xml->addChild('title', $model['title']);
        $xml->addChild('content', $model['html']);
        $this->load("xmlPage", $xml->asXML());
        header('Content-type: text/xml');
        return $this->render("xmlPage");
    }

}
