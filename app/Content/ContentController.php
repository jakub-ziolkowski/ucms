<?php

require_once 'ContentHTMLView.php';
require_once 'ContentXMLView.php';
require_once 'ContentModel.php';

class ContentController extends Controller {

    /**
     *
     * @var ContentModel
     */
    public $model = null;

    public function process() {
        $this->model = new ContentModel($this->sql);
        if (empty(filter_input(INPUT_GET, "xml"))) {
            $view = new ContentHTMLView();
        } else {
            $view = new ContentXMLView();
        }
        echo $view->renderPage($this->model->getPage($this->params->page_id));
    }

    public function processPOST() {
        
    }

}
