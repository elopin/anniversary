<?php

namespace App\Model;

use Nette,
	Nette\Utils\Strings;


/**
 * Repozitář pro práci s výročími.
 */
class AnniversaryRepository extends Nette\Object 
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
	
	/*
	 * Najde a vrátí všechna výročí podle uživatele.
	 */
	public function findAllByUser($user) {
	    
	    $rows =  $this->database->query("SELECT * FROM janacek_php_Anniversary WHERE uzivatel_id = ?", $user->getId())->fetchAll();
	    return $rows;
	}
	
	/*
	 * Odstraní výročí z databáze.
	 */
	public function removeAnniversary($id) {
	    
	    $this->database->query("DELETE FROM janacek_php_Anniversary WHERE id = ?", $id);
	}
	
	/*
	 * Přidá výročí do databáze.
	 */
	public function addAnniversary($anniversary) {
	    $this->database->query("INSERT INTO janacek_php_Anniversary(uzivatel_id, date, text) VALUES(?, ?, ?)", $anniversary->getUser(), $anniversary->getDate(), $anniversary->getText() );
	}
}
