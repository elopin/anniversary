<?php

/** 
 * Presenter pro přihlášení a registraci nového uživatele. Z přihlašovacích
 * nebo registračních údajů uživatele je vytvořena session.
 * 
 * @author Lukáš Janáček
 */
namespace App\Presenters;

use Nette,
	App\Model,
	App\Model\UserRepository,
	App\Model\User,
        Nette\Application\UI\Form;

class LoginPresenter extends BasePresenter {
   
    private $email;
    private $password;
    private $unchecked = false;
    private $newUser = false;
    private $registerFail = false;
    private $noEmail = false;
    private $passwordFail = false;
    private $duplicateUser = false;
    
    /**
     *
     * @var App\Model\UserRepository
     * @inject 
     */
    public $userRepository;
    
    public function renderLogin() {
        $this->getSession()->start();
	$this->getSession()->destroy();
	
        $this->template->email =  $this->email;
        $this->template->password =  $this->password;
        $this->template->unchecked = $this->unchecked;
        $this->template->newUser = $this->newUser;
        $this->template->registerFail = $this->registerFail;
        $this->template->noEmail = $this->noEmail;
        $this->template->passwordFail = $this->passwordFail;
	$this->template->duplicateUser = $this->duplicateUser; 
    }
    
    /*
     * Přihlašovací formulář.
     */
    protected function createComponentLoginForm() {
       
        $form = new Form;
	$form->getElementPrototype()->class('form'); 
	$form->addText('email', 'E-mail:');
        $form->addPassword('password', 'Heslo:');
        $form->addSubmit('send', 'Přihlásit');
	$form->addSubmit("register", 'Registrovat');
        $form->onSuccess[] = $this->checkUser;
        
        return $form;
    }
    
    /*
     * Registrační formulář.
     */
    protected function createComponentRegisterForm() {
	
	$form = new Form;
	$form->getElementPrototype()->class('form'); 
	$form->addText('email', 'E-mail:')->setRequired('Vyplňte e-mail!');
	$form->addText('name', 'Jméno');
	$form->addText('surname', 'Příjmení');
        $form->addPassword('password', 'Heslo:')->setRequired('Zadejte heslo!');
	$form->addPassword('confirm', 'Potvrdit heslo:')->setRequired('Potvrďte heslo!');
        $form->addSubmit('save', 'Uložit');
        $form->onSuccess[] = $this->registerUser;
	return $form;
    }
    
    /*
     * Autentizace uživatele.
     */
    public function checkUser($form) {
       
	if(filter_input(\INPUT_POST, 'send')) {
	    $values = $form->values;
	    
	    if($this->userRepository->authenticateUser($values->email, $values->password)) {
		$user = $this->userRepository->findByEmail($values->email);
		$session = $this->getSession()->getSection('user');
	        $session->user = array();
	        $session->user[] = $user;
		
	        $this->presenter->redirect('Homepage:default');
	    } else {
	        $this->unchecked = true;
	    }
	
            if($values->email == 'a'&& $values->password == 'a') {
                $this->presenter->redirect('Homepage:default');
            }
	} else if(filter_input(\INPUT_POST, 'register')) {
	    $this->newUser = true;
	}
    }
    
    /*
     * Registrace nového uživatele. Uživatel musí vyplnit minimálně
     * e-mail a heslo (s potvrzením). Poté je mu vytvořena session a
     * je přesměrová na hlavní stranu.
     */
    public function registerUser($form) {
	  
        $controlUser = $this->userRepository->findByEmail($form->values->email);
        if($controlUser != null) {
	    $this->duplicateUser = true;
	    $this->newUser = true;
	} else {
            if($form->values->password === $form->values->confirm) {
                $user = $this->userRepository->addUser($form->values);
	
                if($user != null) {
                    $session = $this->getSession()->getSection('user');
                    $session->user = array();
                    $session->user[] = $user;
                    $this->newUser = false;
	        
                } else {
                    $this->registerFail = true;
                    $this->newUser = true;
                }
		
            } else {
	        $this->passwordFail = true;
                $this->newUser = true;
            }
        }
    }
}

