<?php

require_once 'ContactModel.php';
require_once 'ContactView.php';

class ContactController extends Controller {

    /**
     *
     * @var ContactModel
     */
    public $model = null;

    public function process() {
        $this->model = new ContactModel($this->sql);
        $view = new ContactView();
        $formFactory = new FormFactory();
        $formFactory->createForm("contact", "POST", ".");
        $formFactory->addTag(new InputTag("text", "name", ""));
        $formFactory->addTag(new InputTag("text", "email", ""));
        echo $view->renderContactForm($formFactory->renderForm());
    }

    public function processPOST() {
        
    }

}
