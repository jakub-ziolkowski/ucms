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
            require_once Config::$dir . '/app/Content/ContentModel.php';
            $contentModel = new ContentModel($this->app->sql);
            $page = $contentModel->getPage($this->params->page_id);

            $contentView = new ContentHTMLView();
            $contentView->addTag("formHTML", $this->view->renderContactForm($this->userData));
            $contentView->addTag("formMessages", "");

            if (!$this->formSent && $this->errors) {
                $contentView->addTag("formMessages", $this->view->getFormErrors($this->formErrors));
            } else if ($this->formSent) {
                $contentView->addTag("formMessages", "Dziekujemy za wiadomosc");
            }
            $model = array(
                'title' => $page['title'],
                "html" => $page['html']
            );

            echo $contentView->renderPage($model);
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
            "message" => $message,
            "ip" => filter_input(INPUT_SERVER, "REMOTE_ADDR")
        );

        if ($this->validate($name, $email, $message, $code)) {
            $this->model->saveEmail($this->userData);
            $email_to = $this->params->email;
            $email_subject = "[" . Config::$base_url . "] Nowa wiadomosc";
            $email_message = $this->userData['message'];
            $headers = "From: " . $this->userData['name'] . " <" . $this->userData['email'] . ">\r\n" .
                    "Reply-To: " . $this->userData['email'] . "\r\n" .
                    "Content-Type: text/plain;charset=utf-8\r\n" .
                    "X-Mailer: PHP/" . phpversion();
            mail($email_to, $email_subject, $email_message, $headers);
            $this->formSent = true;
            $this->userData = array();
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
            array_push($this->formErrors, "Nalezy wypelnic wszystkie pola");
        }
        return false;
    }

}
