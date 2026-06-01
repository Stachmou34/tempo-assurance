<?php

/*
|-------------------------------
|	GENERAL SETTINGS
|-------------------------------
*/

$imSettings['general'] = array(
	'site_id' => 'DCDCB9675F3D70EAAA877E65FBAE8398',
	'url' => 'https://www.tempo-assurance.com/',
	'homepage_url' => 'https://www.tempo-assurance.com/index.html',
	'icon' => '',
	'version' => '2026.1.9.0',
	'sitename' => 'Tempo-assurance',
	'lang_code' => 'fr-FR',
	'rtl' => false,
	'public_folder' => '',
	'salt' => 'f5v0o7u4m6p9pgzkxw7e792djv48u5ush',
	'common_email_sender_addres' => 'jean.blard@australdev.eu',
	'enable_sender_header' => true,
	'date_format' => 'dd MMM yyyy',
	'date_format_ext' => 'dddd dd MMM yyyy',
	'date_format_no_day' => 'MMM yyyy',
	'date_format_no_day_ext' => 'MMM yyyy'
);
/*
|-------------------------------
|	BREAKPOINTS
|-------------------------------
*/

$imSettings['breakpoints'] = array(
	array("name" => "Desktop", "hash" => "71b14e2b2a5121661fb7ddae017bdbf6", "start" => "max", "end" => 960.0, "fluid" => false),
	array("name" => "Breakpoint 1", "hash" => "d2f9bff7f63c0d6b7c7d55510409c19b", "start" => 959.9, "end" => 720.0, "fluid" => false),
	array("name" => "Mobile", "hash" => "72e5146e7d399bc2f8a12127e43469f1", "start" => 719.9, "end" => 480.0, "fluid" => false),
	array("name" => "Mobile Fluid", "hash" => "5ecdcca63de80fd3d4fbb36295d22b7d", "start" => 479.9, "end" => 0.0, "fluid" => true),
);
/*
|-------------------------------
|	PASSWORD POLICY
|-------------------------------
*/

$imSettings['password_policy'] = array(
	'required_policy' => false,
	'minimum_characters' => '6',
	'include_uppercase' => false,
	'include_numeric' => false,
	'include_special' => false
);
/*
|-------------------------------
|	Captcha
|-------------------------------
*/ImTopic::$captcha_code = "		<div class=\"x5captcha-wrap\">
			<label for=\"733slawb-imCpt\">Code de sécurité :</label><br />
			<input type=\"text\" id=\"733slawb-imCpt\" class=\"imCpt\" name=\"imCpt\" maxlength=\"5\" />
		</div>
";


$imSettings['admin'] = array(
	'notification_public_key' => 'BDdOMmy2ArOGAzlsmpDqH_rhhPwpbI0Ij7pzajacmzcMpRMThut5H-SzHdrmzJj3A8VCS4nk_PmaWIdHO6EPswM',
	'notification_private_key' => 'X9r9Zmday6Na1eyLJGi2XIjniCoLcvS8x0YJ2FbH6Hw',
	'notification_dbprefix' => 'w5_48c1178e_notifications_',
	'enable_notifications' => false,
	'theme' => 'orange',
	'extra-dashboard' => array(),
	'extra-links' => array()
);


/*
|--------------------------------------------------------------------------------------
|	DATABASES SETTINGS
|--------------------------------------------------------------------------------------
*/

$imSettings['databases'] = array();
$ecommerce = Configuration::getCart();
// Setup the coupon data
$couponData = array();
$couponData['products'] = array();
// Setup the cart
$ecommerce->setPublicFolder('');
$ecommerce->setCouponData($couponData);
$ecommerce->setSettings(array(
	'page_url' => 'https://www.tempo-assurance.com/',
	'force_sender' => false,
	'mail_btn_css' => 'display: inline-block; text-decoration: none; color: rgba(255, 255, 255, 1); background-color: rgba(86, 126, 182, 1); padding: 8px 4px 8px 4px; border: solid; border-block-color: rgba(37, 58, 88, 1) rgba(37, 58, 88, 1); border-inline-color: rgba(37, 58, 88, 1) rgba(37, 58, 88, 1); border-width: 1px; border-radius: 2px; ',
	'email_opening' => 'Cher/chère client(e),<br /><br />Nous vous remercions de votre achat. Nous vous transmettons un récapitulatif de votre commande<br /><br />Vous trouverez ci-dessous la liste des produits commandés, les informations de facturation et les instructions concernant la livraison et le paiement choisi.',
	'email_closing' => 'Nous contacter pour obtenir de plus amples informations.<br /><br />Nos meilleures salutations, Service commercial.',
	'email_payment_opening' => 'Cher/chère client(e),<br /><br />Nous vous remercions de votre achat, on vous confirme qu\'on a correctement reçu le paiement et que votre commande sera traitée dès que possible.<br /><br />Vous trouverez ci-dessous la liste des produits commandés et les informations de facturation et de livraison.',
	'email_payment_closing' => 'Nous restons à votre disposition pour toute information supplémentaire.<br /><br />Cordialement,<br />l’Équipe Commerciale<br />',
	'email_digital_shipment_opening' => 'Bonjour,<br /><br />Nous vous remercions pour votre achat et nous avons le plaisir de vous envoyer la liste des liens de téléchargement correspondant aux produits commandés :<br />',
	'email_digital_shipment_closing' => 'Nous restons à votre disposition pour toute information supplémentaire. <br /><br />Cordialement,<br />l’Équipe Commerciale<br />',
	'email_physical_shipment_opening' => 'Bonjour,<br /><br />Nous vous remercions pour votre achat et nous avons le plaisir de vous envoyer la liste des produits envoyés :',
	'email_physical_shipment_closing' => 'Nous restons à votre disposition pour toute information supplémentaire. <br /><br />Cordialement,<br />l’Équipe Commerciale',
	'sendEmailBeforePayment' => true,
	'sendEmailAfterPayment' => false,
	'useCSV' => false,
	'header_bg_color' => 'rgba(37, 58, 88, 1)',
	'header_text_color' => 'rgba(255, 255, 255, 1)',
	'cell_bg_color' => 'rgba(255, 255, 255, 1)',
	'cell_text_color' => 'rgba(0, 0, 0, 1)',
	'availability_reduction_type' => 1,
	'border_color' => 'rgba(211, 211, 211, 1)',
	'owner_email' => '',
	'vat_type' => 'included',
	'availability_image' => ''
));

$ecommerce->setPriceFormatData(array(
	'decimals' => 2,
	'decimal_sep' => '.',
	'thousands_sep' => '',
	'currency_to_right' => true,
	'currency_separator' => ' ',
	'show_zero_as' => '0',
	'currency_symbol' => '€',
	'currency_code' => 'EUR',
	'currency_name' => 'Euro',
));

$ecommerce->setDigitalProductsData(array());
$ecommerce->setProductsData(array());
$ecommerce->setSlugToProductIdMap(array());
$ecommerce->setCategoriesData(array(
	'ikmcx6vr' => array(
		'id' => 'ikmcx6vr',
		'name' => 'Nouvelle catégorie',
		'containsProductsWithProductPage' => false,
		'products' => array(),
		'categories' => array()
	)
));
$ecommerce->setCommentsData(array(
	'enabled' => false,
	'type' => "websitex5",
	'db' => '',
	'table' => 'w5_48c1178e_products_comments',
	'prefix' => 'x5productPage_',
	'comment_type' => "commentandstars"
));
$ecommerce->setPaymentData(array(
	'8dkejfu5' => array(
		'id' => '8dkejfu5',
		'name' => 'Virement bancaire',
		'description' => 'Payer plus tard par virement bancaire.',
		'email_text' => 'Les données requises pour le paiement par virement bancaire sont les suivantes :

XXX YYY ZZZ

Remarque : au terme du paiement, il est nécessaire d\'envoyer une copie du reçu avec le Numéro de la commande.',
		'enableAfterPaymentEmail' => false
	)));
$ecommerce->setShippingData(array(
	'j48dn4la' => array(
		'id' => 'j48dn4la',
		'name' => 'Courrier',
		'description' => 'Les produits seront livrés dans 3-5 jours.',
		'email_text' => 'Expédition par Courrier.\\nLes produits seront livrés dans 3-5 jours.',
		'tracking_type' => 'none'
	),
	'hdj47dut' => array(
		'id' => 'hdj47dut',
		'name' => 'Livraison express',
		'description' => 'Les produits seront livrés dans 1-2 jours.',
		'email_text' => 'Expédition par Livraison express.\\nLes produits seront livrés dans 1-2 jours.',
		'tracking_type' => 'none'
	)));

/*
|-------------------------------------------------------------------------------------------
|	GUESTBOOK SETTINGS
|-------------------------------------------------------------------------------------------
*/

$imSettings['guestbooks'] = array();

/*
|-------------------------------------------------------------------------------------------
|	Dynamic Objects SETTINGS
|-------------------------------------------------------------------------------------------
*/

$imSettings['dynamicobjects'] = array(	'template' => array(
),
	'pages' => array(

	));


/*
|-------------------------------
|	EMAIL SETTINGS
|-------------------------------
*/

$ImMailer->emailType = 'phpmailer';
$ImMailer->exposeWsx5 = false;
$ImMailer->header = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' . "\n" . '<html>' . "\n" . '<head>' . "\n" . '<meta http-equiv="content-type" content="text/html; charset=utf-8">' . "\n" . '</head>' . "\n" . '<body bgcolor="#253A58" style="background-color: #253A58;">' . "\n\t" . '<table border="0" cellpadding="0" align="center" cellspacing="0" style="padding: 0; margin: 0 auto; width: 700px; border-collapse: separate;">' . "\n\t" . '<tr><td id="imEmailContent" style="min-height: 300px; font: normal normal normal 9pt \'Tahoma\'; color: #000000; background-color: #FFFFFF; text-decoration: none; text-align: left; width: 700px; border-style: solid; border-color: rgba(128, 128, 128, 1) rgba(128, 128, 128, 1) rgba(128, 128, 128, 1) rgba(128, 128, 128, 1); border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0; border-bottom: none; border-left-width: 1px;  padding-top: 25px;  padding-bottom: 25px; padding-left: 25px; padding-right: 25px;  background-color: #FFFFFF" width="700px">' . "\n\t\t";
$ImMailer->footer = "\n\t" . '</td></tr>' . "\n\t" . '<tr><td id="imEmailIcons" style="background-color: #FFFFFF;border-left: 1px solid rgba(128, 128, 128, 1); border-right: 1px solid rgba(128, 128, 128, 1); border-bottom-style: solid; border-bottom-color: #808080; border-bottom-width: 1px; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;  padding-top: 25px;  padding-bottom: 25px; padding-left: 15px; padding-right: 15px;  text-align: center;  min-height: 300px; " width="700"></td></tr>' . "\n\t" . '</table>' . "\n" . '<table width="100%"><tr><td id="imEmailFooter" style="font: normal normal normal 7pt \'Tahoma\'; color: #FFFFFF; background-color: transparent; text-decoration: none; text-align: center;  margin-top: 5px; padding-top: 25px;  padding-bottom: 25px; padding-left: 25px; padding-right: 25px; background-color: transparent">' . "\n\t\t" . 'Ce courriel fournit des informations destinées uniquement au destinataire susmentionné.<br>Si vous n\'êtes par le destinataire de ce message, veuillez le signaler immédiatement à l\'expéditeur et le détruire, sans le copier.' . "\n\t" . '</td></tr></table>' . "\n\t" . '</body>' . "\n" . '</html>';
$ImMailer->bodyBackground = '#FFFFFF';
$ImMailer->bodyBackgroundEven = '#FFFFFF';
$ImMailer->bodyBackgroundOdd = '#F0F0F0';
$ImMailer->bodyBackgroundBorder = '#CDCDCD';
$ImMailer->bodyTextColorOdd = '#000000';
$ImMailer->bodySeparatorBorderColor = '#000000';
$ImMailer->emailBackground = '#253A58';
$ImMailer->emailContentStyle = 'font: normal normal normal 9pt \'Tahoma\'; color: #000000; background-color: #FFFFFF; text-decoration: none; text-align: left; ';
$ImMailer->emailContentFontFamily = 'font-family: Tahoma;';

// End of file x5settings.php