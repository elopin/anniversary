<?php

namespace App\Presenters;

use Nette,
    App\Model\Anniversary,
    App\Model\UserRepository,
        Nette\Application\UI\Form;


/**
 * Presenter pro hlavní obrazovku aplikace.
 * 
 * @author Lukáš Janáček
 */
class HomepagePresenter extends BasePresenter
{
        /**
	 *
	 * @var \App\Model\AnniversaryRepository
	 * @inject
	 */   
        public $db;   
    
	/**
	 *
	 * @var \App\Model\User
	 */
	private $user;
	
	private $addError = false;
	
	public function startup() {
	    parent::startup();
	    $section = null;
	    if($this->getSession()->hasSection('user')) {
		$section = $this->getSession()->getSection('user');
	    } else {
		$section = $this->getSession()->getSection('user');
		$section->user = array();
	    }
	    
	    $this->user = $section->user[0];
	    
	}
    
	public function renderDefault()	{
            
	    $this->template->name = $this->user->name;
	    $this->template->surname = $this->user->surname;
	    $this->template->addError = $this->addError;
	    
	    $list = $this->db->findAllByUser($this->user);
	    
	    $this->template->anniversaryList = $list;
	   
	}
        
        public function createComponentNewAnniversary() {
            
            $newAnniversary = new Form;
	    $newAnniversary->getElementPrototype()->class('form');
            $newAnniversary->addText('date', 'Den (př.: 26.5.):')->setRequired('Zadejte datum ve formátu den.měsíc., zadávejte čísla!');
            $newAnniversary->addText('text', 'Popis:')->setRequired('Zadejte popis výročí!');
            $newAnniversary->addSubmit('send', 'Přidat');
            $newAnniversary->onSuccess[] = $this->addAnniversary;
            
            return $newAnniversary;
            
        }
	
	public function createComponentLogout() {
	    $logout = new Form;
	    $logout->addSubmit('logout', 'Odhlásit');
	    $logout->onSuccess[] = $this->logout;
	    return $logout;
	}
	
	public function logout() {
	    $this->getSession()->destroy();
	    $this->presenter->redirect('Login:login');
	}
        
        public function addAnniversary($form) {
            $values = $form->getValues();
            
	    if(preg_match('/^[0-9]{1,2}[\.][0-9]{1,2}[\.]$/', $values->date)) {
	    
	        $date = explode('.', $values->date);
	    
		$day = $date[0];
		$month = $date[1];
		
		if(\checkdate($month, $day, 4)) {
		
                    $anniversary = new Anniversary;
	            $anniversary->setUser($this->user->getId());
	    
	            $dateForRepo = new \Nette\DateTime();
	            $dateForRepo->setDate(4, $month, $day);
	    
                    $anniversary->setDate($dateForRepo);
                    $anniversary->setText($values->text);
            
                    $this->db->addAnniversary($anniversary);
		} else {
		    $this->addError = true;
		}
	    } else {
		$this->addError = true;
	    }
        }
	
	public function handleRemoveAnniversary($id) {
	    $this->db->removeAnniversary($id);
	}

}
