<?php //netteCache[01]000374a:2:{s:4:"time";s:21:"0.65476400 1400967383";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:60:"/home/elopin/www/anniversary/app/templates/Login/login.latte";i:2;i:1400967098;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /home/elopin/www/anniversary/app/templates/Login/login.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '009fmzbvoo')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb46d609c81a_title')) { function _lb46d609c81a_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Přihlášení</h1>
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba9052397d5_content')) { function _lba9052397d5_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div>
<?php if ($unchecked) { ?>
        <h3 style="color : red ">Neplatné přihlašovací údaje!</h3>
<?php } elseif ($registerFail) { ?>
        <h3 style="color : red ">Chyba při registraci uživatele!</h3>
<?php } elseif ($noEmail) { ?>
	<h3 style="color : red ">Není vyplněn e-mail!</h3>
<?php } elseif ($duplicateUser) { ?>
	<h3 style="color : red ">Uživatel se zadaným e-mailem již existuje!</h3>	
<?php } elseif ($passwordFail) { ?>
	<h3 style="color : red ">Chyba při kontrole hesla!</h3>
<?php } ?>
    <div id="loginFormDiv">
<?php if ($newUser) { $_ctrl = $_control->getComponent("registerForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->redrawControl(NULL, FALSE); $_ctrl->render() ;} else { ?>
	    <p>Zadejte přihlašovací údaje nebo vytvořte nový účet!</p>
<?php $_ctrl = $_control->getComponent("loginForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->redrawControl(NULL, FALSE); $_ctrl->render() ;} ?>
    </div>        
</div>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 