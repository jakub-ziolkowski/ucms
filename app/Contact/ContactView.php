<?php

require Config::$dir . '/app/Content/ContentHTMLView.php';

class ContactView extends View {

    public function getCaptcha($code) {
        header('Content-Type: image/png');
        $img = imagecreatetruecolor(80, 30);
        imagealphablending($img, false);
        imagefilledrectangle($img, 0, 0, 80, 30, imagecolorallocatealpha($img, 0, 0, 0, 127));
        imagealphablending($img, true);
        imagettftext($img, 16, 0, 5, 20, imagecolorallocate($img, 0, 0, 0), __DIR__ . '/font.ttf', $code);
        imagealphablending($img, false);
        imagesavealpha($img, true);
        imagepng($img);
    }

    public function getFormErrors($errors) {
        $html = "<ul class='formErrors'>";
        foreach ($errors as $error) {
            $html .= "<li>$error</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    public function renderContactForm($userData) {
        $pageView = new ContentHTMLView();
        
        $formFactory = new FormFactory();
        $formFactory->createForm("contact", "POST", null);
        $formFactory->addTag(new HTMLInput("text", "name", (array_key_exists("name", $userData) ? $userData['name'] : ""), "Imie"));
        $formFactory->addTag(new HTMLInput("text", "email", (array_key_exists("email", $userData) ? $userData['email'] : ""), "Email"));
        $formFactory->addTag(new HTMLTextarea("message", (array_key_exists("message", $userData) ? $userData['message'] : ""), "Wiadomosc"));
        $formFactory->addTag(new HTMLGeneric("<img src='".Utils::getRequestString()."&getCaptha'/>"));
        $formFactory->addTag(new HTMLInput("text", "code", (array_key_exists("code", $userData) ? $userData['code'] : ""), "Przepisz kod"));

        $model = array("title" => "Contact", "html" => $formFactory->renderForm());
        $this->load("contactPage", $pageView->renderPage($model));
        return $this->render("contactPage");
    }

}
