<?php

require_once 'ContactModel.php';
require_once 'ContactView.php';

class ContactController extends Controller {

    /**
     *
     * @var ContactModel
     */
    public $model = null;

    /**
     *
     * @var ContactView
     */
    public $view = null;

    public function init() {
        $this->model = new ContactModel($this->app->sql);
        $this->view = new ContactView();
    }

    public function processRequest() {
        $_SESSION['code'] = Utils::randomString(6);

        if (!is_null(filter_input(INPUT_GET, "getCaptha"))) {
            $this->view->getCaptcha(filter_var($_SESSION['code']));
        } else {
            if (!$this->formSent && $this->errors) {
                echo $this->view->getFormErrors($this->formErrors);
            }
            echo $this->view->renderContactForm($this->userData);
        }
    }

    public function processPostRequest() {
        $name = filter_input(INPUT_POST, "name");
        $email = filter_input(INPUT_POST, "email");
        $message = filter_input(INPUT_POST, "message");
        $code = filter_input(INPUT_POST, "code");
        $this->userData = array(
            "name" => $name,
            "email" => $email,
            "message" => $message
        );

        if ($this->validate($name, $email, $message, $code)) {
            $this->formSent = true;
        } else {
            $this->errors = true;
        }
    }

    private $formSent = false;
    private $errors = false;
    private $formErrors = array();
    private $userData = array();

    private function validate($name, $email, $message, $code) {
        if (!empty($name) && !empty($email) && !empty($message) && !empty($code)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($code === filter_var($_SESSION['code'])) {
                    return true;
                } else {
                    array_push($this->formErrors, "Niepoprawny kod z obrazka");
                }
            } else {
                array_push($this->formErrors, "Niepoprawny adres email");
            }
        } else {
            array_push($this->formErrors, "Musisz wypelnic wszystkie pola");
        }
        return false;
    }

}
