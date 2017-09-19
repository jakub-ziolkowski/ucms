<?php


require_once 'ContactModel.php';
require_once 'ContactView.php';

class EmailFormController extends Controller {

    /**
     *
     * @var ContactModel
     */
    public $model = null;

    public function process() {
        $this->model = new ContactModel($this->sql);
        $view = new ContactView();
        echo $view->renderPage($this->model->getPage(null));
    }

    public function processPOST() {
        
    }

}
