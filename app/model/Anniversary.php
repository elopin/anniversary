<?php

/* 
 * Přepravka pro data výročí,
 * 
 * Lukáš Janáček
 */

namespace App\Model;

class Anniversary extends \Nette\Object {
    
    private $id;
    private $user;
    private $date;
    private $text;
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setUser($user) {
        $this->user = $user;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function setDate($date) {
        $this->date = $date;
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function setText($text) {
        $this->text = $text;
    }
    
    public function getText() {
        return $this->text;
    }
    
}