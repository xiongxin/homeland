<?php
use Core\Mall;
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/5/23
 * Time: 17:15
 */
class ApiController extends Mall {
    public function userAction() {
        $service = new Yar_Server(new \Api\User());
        $service->handle();

        return false;
    }
}