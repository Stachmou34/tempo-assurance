<?php
if(substr(basename($_SERVER['PHP_SELF']), 0, 11) == "imEmailForm") {
	include '../res/x5engine.php';
	$form = new ImForm();

	$errorMessage = '';
	if(@$_POST['action'] != 'check_answer') {
	$form->setField('Nom', @$_POST['imObjectForm_5_1'], '', false);
	$form->setField('Téléphone', @$_POST['imObjectForm_5_2'], '', false);
	$form->setField('Mail', @$_POST['imObjectForm_5_3'], '', false);
	$form->setField('Message', @$_POST['imObjectForm_5_4'], '', false);
		if(!isset($_POST['imJsCheck']) || $_POST['imJsCheck'] != '3F894334B12464C0752E4D7A50717CDC' || (isset($_POST['imSpProt']) && $_POST['imSpProt'] != ""))
			die(imPrintJsError());
		$form->mailToOwner('jean.blard@australdev.eu', '', 'laetitia@jlassure.com', 'Message provenant du site Tempo-assurance.com', "", false);
		@header('Location: ../index.html');
		exit();
	} else {
		echo $form->checkAnswer(@$_POST['id'], @$_POST['answer']) ? 1 : 0;
	}
}

// End of file