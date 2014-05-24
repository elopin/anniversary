<?php

/**
 * Přepravka pro data uživatele.
 *
 * @author Lukáš Janáček
 */

namespace App\Model;

class User extends \Nette\Object {
    private $id;
    private $email;
    private $name;
    private $surname;
    private $password;
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getemail() {
        return $this->email;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setSurname($surname) {
        $this->surname = $surname;
    }
    
    public function getSurname() {
        return $this->surname;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getPassword() {
        return $this->password;
    }
}
