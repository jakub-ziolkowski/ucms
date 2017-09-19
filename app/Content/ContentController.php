<?php

require_once 'ContentHTMLView.php';
require_once 'ContentModel.php';

class ContentController extends Controller {

    /**
     *
     * @var ContentModel
     */
    public $model = null;

    public function process() {
        $this->model = new ContentModel($this->sql);
        $view = new ContentHTMLView();
        echo $view->renderPage($this->model->getPage($this->params->page_id));
    }

}
