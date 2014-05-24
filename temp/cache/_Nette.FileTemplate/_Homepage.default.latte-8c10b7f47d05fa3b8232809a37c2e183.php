<?php //netteCache[01]000379a:2:{s:4:"time";s:21:"0.17974500 1400967533";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:65:"/home/elopin/www/anniversary/app/templates/Homepage/default.latte";i:2;i:1400965756;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /home/elopin/www/anniversary/app/templates/Homepage/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'cdu1il5dto')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb5ad19e188b_content')) { function _lb5ad19e188b_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div id="header">
    <label class="nameLabel">Přihlášený uživatel: <?php echo Nette\Templating\Helpers::escapeHtml($name, ENT_NOQUOTES) ?>
 <?php echo Nette\Templating\Helpers::escapeHtml($surname, ENT_NOQUOTES) ?></label>
<?php $_ctrl = $_control->getComponent("logout"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->redrawControl(NULL, FALSE); $_ctrl->render() ?>
</div>

<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<div>
    <div id="anniversaryFormDiv">
<?php if ($addError) { ?>
            <h3 style="color : red ">Chyba při ukládání výročí! Zkontrolujte formát data (např. 24.12. )!</h3>
<?php } $_ctrl = $_control->getComponent("newAnniversary"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->redrawControl(NULL, FALSE); $_ctrl->render() ?>
    </div>
    <div id="anniversaryListDiv">
        <table class="form">
<?php $iterations = 0; foreach ($anniversaryList as $anniversary) { ?>            <tr>
                <td><label><?php echo Nette\Templating\Helpers::escapeHtml(date_format($anniversary->date, 'd.m.'), ENT_NOQUOTES) ?></label></td>
	        <td><label><?php echo Nette\Templating\Helpers::escapeHtml($anniversary->text, ENT_NOQUOTES) ?></label></td>
	        <td><a class="button"  href="<?php echo htmlSpecialChars($_control->link("removeAnniversary!", array($anniversary->id))) ?>
">Odstranit</a></td>
            </tr>
<?php $iterations++; } ?>
        </table>
    </div>
</div>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb30f778e702_title')) { function _lb30f778e702_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Seznam výročí</h1>
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
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 