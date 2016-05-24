<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/5/23
 * Time: 17:16
 */
namespace Api;

class User {
    public function __construct()
    {
    }

    public function insertUser($pid, $name)
    {
        for($a = 0; $a<10; $a++) {
            M('t_product')->insert(['name'=>$name]);
        }
    }
}