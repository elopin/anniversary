<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

namespace Nette\Application\UI;

class LoginPresenter extends \App\Presenters\BasePresenter {
    
    
    public function renderLogin() {
        
        $form = new Form();
        $form->addText('email', 'Zadejte e-mail:');
        $form->addPassword('password', 'Zadejte heslo:');
        $form->addSubmit('send', 'Přihlásit');
        
        $this->template->form = $form;
        
    }
}

