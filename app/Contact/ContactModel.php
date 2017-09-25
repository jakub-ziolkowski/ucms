<?php

class ContactModel extends Model {

    public function saveEmail($data) {
        $sql = $this->db->prepare('INSERT INTO `ext_contact` (`id`, `name`, `email`, `message`, `date`, `ip`) VALUES (NULL, ?,?,?, CURRENT_TIMESTAMP, ?) ');
        $sql->execute(array($data['name'],
            $data['email'],
            $data['message'],
            filter_input(INPUT_SERVER, "REMOTE_ADDR")));
    }

}
