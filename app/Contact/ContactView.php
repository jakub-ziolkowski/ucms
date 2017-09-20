<?php

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

    public function renderContactForm($form) {
        print_r($this);
        $this->loadFile("contactPage", Config::$dir . "/app/Contact/tpl/Contact.html");
        $this->addTag("path", Config::$base_url . "/app/Contact/tpl/");
        $this->addTag("contactForm", $form);
        $this->addTag("captchaImage", "<img src='' />");
        header('Content-type: text/html');
        return $this->render("contactPage");
    }

}
