<?php

namespace App\Model;

use Nette,
	Nette\Utils\Strings,
	App\Model\User;


/**
 * Repozitář pro práci s uživateli.
 */
class UserRepository extends Nette\Object 
{
	/** 
	 *
	 * @var Nette\Database\Context
	 * @inject
	 */
	private $database;

	public function __construct(\Nette\Database\Context $database)
	{
		$this->database = $database;
	}
	
	public function findAll() {
	    return $this->database->query("SELECT * FROM janacek_php_User")->fetchAll();
	}
	
	/*
	 * Najde a vrátí uživatele podle emailu.
	 */
	public function findByEmail($email) {
	    $row = $this->database->query("SELECT * FROM janacek_php_User WHERE email = ?", $email)->fetch();
	    
	    if($row != null) {
	        $user = new User;
	        $user->setId($row->uzivatel_id);
	        $user->setEmail($row->email);
	        $user->setName($row->name);
	        $user->setSurname($row->surname);
	        $user->setPassword($row->password);
	        return $user;
	    } else {
		return null;
	    }
	}
	
	/*
	 * Ověří přihlašovací údaje uživatele.
	 */
	public function authenticateUser($email, $password) {
	    $userPass = $this->database->query("SELECT password FROM janacek_php_User WHERE email = ?", $email)->fetchField();
	    
            if($userPass === $password) {
		return true;
	    } else {
		return false;
	    }
	}
	
	/*
	 * Přidá uživatele do databáze.
	 */
	public function addUser($values) {
	    $this->database->query("INSERT INTO janacek_php_User(email, name, surname, password) VALUES(?, ?, ?, ?)", $values->email, $values->name, $values->surname, $values->password);
	    
	    $row = $this->database->query("SELECT uzivatel_id, name, email, surname, password FROM janacek_php_User WHERE email = ?", $values->email)->fetch();
	    $user = new User;
	    $user->setId($row->uzivatel_id);
	    $user->setEmail($row->email);
	    $user->setName($row->name);
	    $user->setSurname($row->surname);
	    $user->setPassword($row->password);
	    
	    return $user;
	  
	}
}