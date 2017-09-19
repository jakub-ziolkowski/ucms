<?php

class ApplicationModel extends Model {

    public function getRoute() {
        $sql = $this->sql->prepare('SELECT * from `router` where requestMask = ?');
        $sql->execute(array(Router::getRequestString()));
        return @$sql->fetchAll()[0];
    }

}
