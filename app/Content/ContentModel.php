<?php

class ContentModel extends Model {

    public function getPage($id) {
        $sql = $this->sql->prepare('SELECT * from `html` where id = ?');
        $sql->execute(array($id));
        return $sql->fetchAll()[0];
    }

}
