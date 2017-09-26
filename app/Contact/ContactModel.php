<?php

class ContactModel extends Model {

    public function saveEmail($data) {

        $sql = $this->sql->prepare('INSERT INTO `contact` (`id`, `name`, `email`, `message`, `date`, `ip`) VALUES (NULL, ?,?,?, CURRENT_TIMESTAMP, ?) ');
        $sql->execute(array($data['name'],
            $data['email'],
            $data['message'],
            $data['ip']));
    }

}
