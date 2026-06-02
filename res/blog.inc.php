<?php



$imSettings['blog'] = array(	'description' => 'Toutes les informations et questions posées sur l\'assurance tempo se trouvent dans cette rubrique. Ce blog , point  de réponse aux questions sur la temporaire .',
	'keywords' => '',
	'root' => 'https://www.tempo-assurance.com/blog/',
	'home_posts_number' => 50,
	'card_style' => array(
		'layout' => "fixedheight",
		'cardsPerRow' => 1,
		'rowsPerPage' => 50,
		'card' => array(
			'type' => "leftcoverrightcontents",
			'margin' => 10,
			'height' => 150,
			'backgroundColor' => array(
				'a' => 0,
				'r' => 255,
				'g' => 255,
				'b' => 255
			),
			'border' => array(
				'colors' => array(
					'top' => array(
						'a' => 0,
						'r' => 255,
						'g' => 255,
						'b' => 255
					),
					'bottom' => array(
						'a' => 0,
						'r' => 255,
						'g' => 255,
						'b' => 255
					),
					'left' => array(
						'a' => 0,
						'r' => 255,
						'g' => 255,
						'b' => 255
					),
					'right' => array(
						'a' => 0,
						'r' => 255,
						'g' => 255,
						'b' => 255
					)
				),
				'radius' => array(
					'topLeft' => 0,
					'bottomLeft' => 0,
					'topRight' => 0,
					'bottomRight' => 0
				),
				'widths' => array(
					'top' => 0,
					'bottom' => 0,
					'left' => 0,
					'right' => 0
				)
			),
			'shadow' => array(
				'enabled' => false,
				'color' => array(
					'a' => 255,
					'r' => 128,
					'g' => 128,
					'b' => 128
				),
				'offset' => array(
					'x' => 3,
					'y' => 3
				),
				'spread' => 0,
				'blur' => 5
			),
			'image' => array(
				'percentSize' => 50,
				'margins' => array(
					'top' => 0,
					'bottom' => 0,
					'left' => 0,
					'right' => 0
				),
				'sizeAdapted' => true,
				'mouseovereffect' => 'none'
			),
			'txtBlock' => array(
				'height' => 150,
				'margins' => array(
					'top' => 5,
					'bottom' => 5,
					'left' => 10,
					'right' => 10
				),
				'align' => "left",
				'name' => array(
					'show' => true,
					'style' => array(
						'backgroundColor' => array(
							'a' => 0,
							'r' => 255,
							'g' => 255,
							'b' => 255
						),
						'textColor' => array(
							'a' => 255,
							'r' => 0,
							'g' => 0,
							'b' => 0
						),
						'align' => "left",
						'font' => array(
							'familyName' => 'Arial',
							'size' => 12,
							'style' => "regular"
						)
					)
				),
				'description' => array(
					'show' => true,
					'style' => array(
						'backgroundColor' => array(
							'a' => 0,
							'r' => 255,
							'g' => 255,
							'b' => 255
						),
						'textColor' => array(
							'a' => 255,
							'r' => 0,
							'g' => 0,
							'b' => 0
						),
						'align' => "left",
						'font' => array(
							'familyName' => 'Arial',
							'size' => 9,
							'style' => "regular"
						)
					)
				),
				'details' => array(
					'showCategory' => true,
					'style' => array(
						'backgroundColor' => array(
							'a' => 0,
							'r' => 255,
							'g' => 255,
							'b' => 255
						),
						'textColor' => array(
							'a' => 255,
							'r' => 169,
							'g' => 169,
							'b' => 169
						),
						'align' => "left",
						'font' => array(
							'familyName' => 'Arial',
							'size' => 9,
							'style' => "regular"
						)
					),
					'showAuthor' => true,
					'showDate' => true,
					'showReadTime' => false
				),
				'button' => array(
					'show' => true,
					'useImage' => false,
					'style' => array(
						'backgroundColor' => array(
							'a' => 255,
							'r' => 50,
							'g' => 205,
							'b' => 50
						),
						'textColor' => array(
							'a' => 255,
							'r' => 255,
							'g' => 255,
							'b' => 255
						),
						'align' => "left",
						'font' => array(
							'familyName' => 'Arial',
							'size' => 9,
							'style' => "regular"
						)
					),
					'border' => array(
						'colors' => array(
							'top' => array(
								'a' => 0,
								'r' => 255,
								'g' => 255,
								'b' => 255
							),
							'bottom' => array(
								'a' => 0,
								'r' => 255,
								'g' => 255,
								'b' => 255
							),
							'left' => array(
								'a' => 0,
								'r' => 255,
								'g' => 255,
								'b' => 255
							),
							'right' => array(
								'a' => 0,
								'r' => 255,
								'g' => 255,
								'b' => 255
							)
						),
						'radius' => array(
							'topLeft' => 3,
							'bottomLeft' => 3,
							'topRight' => 3,
							'bottomRight' => 3
						),
						'widths' => array(
							'top' => 0,
							'bottom' => 0,
							'left' => 0,
							'right' => 0
						)
					),
					'margins' => array(
						'top' => 5,
						'bottom' => 5,
						'left' => 5,
						'right' => 5
					),
					'image' => array(
						'image' => 'images/blog_01.png',
						'width' => 32,
						'height' => 32,
						'alt' => '',
						'title' => ''
					),
					'position' => "left"
				)
			)
		),
		'highlight' => array(
			'mode' => "card",
			'count' => 1,
			'height' => 300
		)
	),
	'article_type' => 'titlecontents',
	'article_read_speed' => 180,
	'file_prefix' => 'x5_',
	'comments_source' => 'wsx5',
	'email' => '',
	'moderate' => false,
	'sendmode' => 'file',
	'folder' => '',
	'comment_type' => 'both',
	'comments_order' => 'desc',
	'comments_on_multiple_columns' => false,
	'abuse' => false,
	'captcha' => false,
	'categories' => Array('Assurance temporaire', 'Information générale'),
	'posts' => Array(),
	'posts_cat' => Array(),
	'posts_author' => Array(),
	'posts_month' => Array(),
	'posts_slug' => Array()
)
;

// Post titled "Vous traversez une période difficile et vous avez été résilié pour non paiement de prime, puis-je souscrire?"
$imSettings['blog']['posts']['jj09duxz'] = array(
	'id' => 'jj09duxz',
	'rel_url' => '?vous-traversez-une-periode-difficile-et-vous-avez-ete-resilie-pour-non-paiement-de-prime,-puis-je-souscrire-',
	'title' => 'Vous traversez une période difficile et vous avez été résilié pour non paiement de prime, puis-je souscrire?',
	'tag_title' => 'Vous traversez une période difficile et vous avez été résilié pour non paiement de prime, puis-je souscrire? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'vous-traversez-une-periode-difficile-et-vous-avez-ete-resilie-pour-non-paiement-de-prime,-puis-je-souscrire-',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Souscription possible de 1 à 90 jours suivant le type de véhicule utilisé. Si vous souscrivez une assurance frontière, alors vous aurez le chois entre 15 et 30 jours.',
	'tag_description' => 'Souscription possible de 1 à 90 jours suivant le type de véhicule utilisé. Si vous souscrivez une assurance frontière, alors vous aurez le chois entre 15 et 30 jours.',
	'body' => '<div id="imBlogPost_jj09duxz">
<h2>Puis-je souscrire apr&egrave;s une r&eacute;siliation pour non-paiement ?</h2>
<p>Oui, vous pouvez souscrire une assurance temporaire m&ecirc;me apr&egrave;s avoir &eacute;t&eacute; r&eacute;sili&eacute; par votre assureur habituel pour non-paiement de prime. L&#39;assurance auto temporaire est justement con&ccedil;ue pour r&eacute;pondre aux situations difficiles ou atypiques que les assureurs classiques refusent souvent de couvrir.</p>
<h3>Pourquoi les assureurs classiques refusent-ils ?</h3>
<p>Lorsqu&#39;un conducteur est r&eacute;sili&eacute; pour non-paiement, il peut &ecirc;tre signal&eacute; dans les fichiers de suivi du secteur assuranciel. Cette situation constitue un signal d&#39;alarme pour les assureurs traditionnels, qui refusent alors souvent de proposer un nouveau contrat ou qui appliquent des surprimes importantes.</p>
<h3>L&#39;assurance temporaire : une alternative accessible</h3>
<p>L&#39;assurance auto temporaire n&#39;est pas soumise aux m&ecirc;mes contraintes que les contrats annuels. Elle permet de s&#39;assurer pour une dur&eacute;e de 1 &agrave; 90 jours, sans engagement sur la dur&eacute;e.</p>
<ul>
<li>Vous traversez une p&eacute;riode financi&egrave;re difficile et n&#39;avez pas pu honorer vos cotisations,</li>
<li>Vous venez d&#39;&ecirc;tre r&eacute;sili&eacute; et cherchez une couverture imm&eacute;diate pour continuer &agrave; circuler l&eacute;galement,</li>
<li>Vous souhaitez reprendre une activit&eacute; professionnelle n&eacute;cessitant l&#39;utilisation d&#39;un v&eacute;hicule.</li>
</ul>
<h3>Quelles garanties sont propos&eacute;es ?</h3>
<p>L&#39;assurance temporaire inclut au minimum la Responsabilit&eacute; Civile, obligatoire pour circuler en France. Des garanties compl&eacute;mentaires comme l&#39;assistance au v&eacute;hicule ou la d&eacute;fense et recours peuvent &ecirc;tre ajout&eacute;es selon les options choisies.</p>
<h3>Comment souscrire ?</h3>
<p>La souscription se fait enti&egrave;rement en ligne, en quelques minutes. Vous avez besoin de votre permis de conduire, de la carte grise du v&eacute;hicule et d&#39;un moyen de paiement s&eacute;curis&eacute;. Une fois le paiement valid&eacute;, l&#39;attestation d&#39;assurance vous est transmise imm&eacute;diatement par email.</p>
<p>N&#39;attendez pas d&#39;&ecirc;tre en infraction : un d&eacute;faut d&#39;assurance expose &agrave; une amende pouvant atteindre 3&nbsp;750&nbsp;&euro;, la confiscation du v&eacute;hicule et une suspension de permis.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T09:41:00',
			'dateModified' => '2017-08-30T09:41:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Vous traversez une période difficile et vous avez été résilié pour non paiement de prime, puis-je souscrire?',
			'description' => 'Souscription possible de 1 à 90 jours suivant le type de véhicule utilisé. Si vous souscrivez une assurance frontière, alors vous aurez le chois entre 15 et 30 jours.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?vous-traversez-une-periode-difficile-et-vous-avez-ete-resilie-pour-non-paiement-de-prime,-puis-je-souscrire-',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Vous traversez une période difficile et vous avez été résilié pour non paiement de prime, puis-je souscrire?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Vous traversez une période difficile et vous avez été résilié pour non paiement de prime, puis-je souscrire?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '2 Juin 2026',
	'timestampExt' => '2 Juin 2026',
	'utc_time' => 1504086060,
	'month' => '202606',
	'comments' => false,
	'word_count' => 13,
	'readTime' => '1:00',
	'sources' => array(),
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?vous-traversez-une-periode-difficile-et-vous-avez-ete-resilie-pour-non-paiement-de-prime,-puis-je-souscrire-',
		'type' => 'article',
		'title' => 'Vous traversez une période difficile et vous avez été résilié pour non paiement de prime, puis-je souscrire?',
		'description' => 'Souscription possible de 1 à 90 jours suivant le type de véhicule utilisé. Si vous souscrivez une assurance frontière, alors vous aurez le chois entre 15 et 30 jours.',
		'keywords' => '',
		'updated_time' => '1504089661',
		'images' => array()
	)
);$imSettings['blog']['posts_slug']['vous-traversez-une-periode-difficile-et-vous-avez-ete-resilie-pour-non-paiement-de-prime,-puis-je-souscrire-'] = 'jj09duxz';

// Post titled "Véhicule immobilisé par la police et mise en fourrière pour défaut d' assurance"
$imSettings['blog']['posts']['jfv0ey90'] = array(
	'id' => 'jfv0ey90',
	'rel_url' => '?vehicule-immobilise-par-la-police-et-mise-en-fourriere-pour-defaut-d--assurance',
	'title' => 'Véhicule immobilisé par la police et mise en fourrière pour défaut d\' assurance',
	'tag_title' => 'Véhicule immobilisé par la police et mise en fourrière pour défaut d\' assurance - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'vehicule-immobilise-par-la-police-et-mise-en-fourriere-pour-defaut-d--assurance',
	'author' => '',
	'category' => 'Information générale',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Votre véhicule n\'est pas assuré et vous avez été mis en fourrière pour défaut d\'assurance par les forces de police. Souscription minimale de 1 ou 3 jours suivant les communes.',
	'tag_description' => 'Votre véhicule n\'est pas assuré et vous avez été mis en fourrière pour défaut d\'assurance par les forces de police. Souscription minimale de 1 ou 3 jours suivant les communes.',
	'body' => '<div id="imBlogPost_jfv0ey90">
<h2>V&eacute;hicule immobilis&eacute; par la police pour d&eacute;faut d&#39;assurance : que faire ?</h2>
<p>Si votre v&eacute;hicule a &eacute;t&eacute; immobilis&eacute; par les forces de l&#39;ordre ou mis en fourri&egrave;re pour d&eacute;faut d&#39;assurance, vous pouvez souscrire une assurance auto temporaire en ligne pour le r&eacute;cup&eacute;rer rapidement. Cette d&eacute;marche est 100&nbsp;% l&eacute;gale et reconnue par les autorit&eacute;s.</p>
<h3>Les cons&eacute;quences d&#39;un d&eacute;faut d&#39;assurance</h3>
<ul>
<li><b>Amende</b> : jusqu&#39;&agrave; 3&nbsp;750&nbsp;&euro; (article L324-2 du Code de la route),</li>
<li><b>Immobilisation et mise en fourri&egrave;re</b> du v&eacute;hicule,</li>
<li><b>Suspension ou annulation du permis</b> jusqu&#39;&agrave; 3 ans,</li>
<li><b>Frais de fourri&egrave;re</b> &agrave; la charge du propri&eacute;taire (enl&egrave;vement + gardiennage).</li>
</ul>
<h3>Comment r&eacute;cup&eacute;rer son v&eacute;hicule ?</h3>
<p>Pour r&eacute;cup&eacute;rer un v&eacute;hicule mis en fourri&egrave;re pour d&eacute;faut d&#39;assurance, vous devez imp&eacute;rativement pr&eacute;senter :</p>
<ol>
<li>Votre <b>permis de conduire</b> valide,</li>
<li>Une <b>attestation d&#39;assurance</b> en cours de validit&eacute; couvrant le v&eacute;hicule.</li>
</ol>
<p>L&#39;assurance temporaire &laquo;&nbsp;sortie de fourri&egrave;re&nbsp;&raquo; permet de r&eacute;pondre &agrave; cette obligation imm&eacute;diatement. Vous souscrivez en ligne, obtenez votre attestation par email, et vous pouvez vous pr&eacute;senter &agrave; la fourri&egrave;re d&egrave;s que possible.</p>
<h3>Dur&eacute;e de souscription recommand&eacute;e</h3>
<p>La plupart des communes accordent un d&eacute;lai de 3 jours ouvr&eacute;s pour r&eacute;cup&eacute;rer le v&eacute;hicule apr&egrave;s immobilisation. Un contrat de 1 &agrave; 3 jours suffit g&eacute;n&eacute;ralement, mais vous pouvez souscrire jusqu&#39;&agrave; 90 jours pour vous laisser le temps de r&eacute;gulariser votre situation.</p>
<p>Chaque ann&eacute;e, plus de 700&nbsp;000 v&eacute;hicules circuleraient sans assurance en France selon le Fonds de Garantie des Assurances Obligatoires (FGAO). Les contr&ocirc;les se sont intensifi&eacute;s, rendant le risque de mise en fourri&egrave;re plus &eacute;lev&eacute; que jamais. N&#39;attendez pas : assurez-vous avant de reprendre le volant.
</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T09:36:00',
			'dateModified' => '2017-08-30T09:36:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Véhicule immobilisé par la police et mise en fourrière pour défaut d\' assurance',
			'description' => 'Votre véhicule n\'est pas assuré et vous avez été mis en fourrière pour défaut d\'assurance par les forces de police. Souscription minimale de 1 ou 3 jours suivant les communes.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?vehicule-immobilise-par-la-police-et-mise-en-fourriere-pour-defaut-d--assurance',
			'image' => 'https://www.tempo-assurance.com/images\\mise-fourriere.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Véhicule immobilisé par la police et mise en fourrière pour défaut d\' assurance',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Information générale',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Information générale',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Véhicule immobilisé par la police et mise en fourrière pour défaut d\' assurance',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '9 Juin 2026',
	'timestampExt' => '9 Juin 2026',
	'utc_time' => 1504085760,
	'month' => '202606',
	'comments' => false,
	'word_count' => 40,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_jfv0ey90" style="max-width: 400px; margin: 0 auto;"></div></div><script>function loadpostgalleryjfv0ey90() {$(\'#ss_jfv0ey90\').empty().width(\'auto\');var settings = { target: \'#ss_jfv0ey90\', media: [{ url: \'../images/mise-fourriere.jpg\', width: 400, height: 168, autoplayTime: 7000, effect: \'none\'}],width: 400,height: 168, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 400;settings.height = 168;}if (currentBp.end == 720) {settings.width = 400;settings.height = 168;}if (currentBp.end == 480) {settings.width = 400;settings.height = 168;}if (currentBp.end == 0) {settings.width = Math.min(400, $(\'#ss_jfv0ey90\').width());settings.height = settings.width / 400 * 168;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryjfv0ey90).on(\'breakpointChangedOrFluid\', loadpostgalleryjfv0ey90);}x5engine.boot.push(loadpostgalleryjfv0ey90);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?vehicule-immobilise-par-la-police-et-mise-en-fourriere-pour-defaut-d--assurance',
		'type' => 'article',
		'title' => 'Véhicule immobilisé par la police et mise en fourrière pour défaut d\' assurance',
		'description' => 'Votre véhicule n\'est pas assuré et vous avez été mis en fourrière pour défaut d\'assurance par les forces de police. Souscription minimale de 1 ou 3 jours suivant les communes.',
		'keywords' => '',
		'updated_time' => '1504089360',
		'images' => array('https://www.tempo-assurance.com/blog/files/mise-fourriere_og.jpg','https://www.tempo-assurance.com/blog/files/mise-fourriere_og_small.jpg'),
		'postimage' => 'images/mise-fourriere.jpg'
	)
);$imSettings['blog']['posts_slug']['vehicule-immobilise-par-la-police-et-mise-en-fourriere-pour-defaut-d--assurance'] = 'jfv0ey90';

// Post titled "Ramener un camion acheté dans son pays?"
$imSettings['blog']['posts']['kv6thljn'] = array(
	'id' => 'kv6thljn',
	'rel_url' => '?ramener-un-camion-achete-dans-son-pays-',
	'title' => 'Ramener un camion acheté dans son pays?',
	'tag_title' => 'Ramener un camion acheté dans son pays? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'ramener-un-camion-achete-dans-son-pays-',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Le contrat d\' assurance provisoire ne concerne pas que les véhicules légers, il peut être aussi utilisé pour les poids lourds, les bus et camping car',
	'tag_description' => 'Le contrat d\' assurance provisoire ne concerne pas que les véhicules légers, il peut être aussi utilisé pour les poids lourds, les bus et camping car',
	'body' => '<div id="imBlogPost_kv6thljn">
<h2>Assurance temporaire pour ramener un camion achet&eacute; &agrave; l&#39;&eacute;tranger</h2>
<p>Vous venez d&#39;acqu&eacute;rir un camion dans un pays &eacute;tranger et vous souhaitez le ramener en France ou dans votre pays de r&eacute;sidence ? L&#39;assurance auto temporaire est la solution id&eacute;ale pour ce type de d&eacute;placement ponctuel, m&ecirc;me pour un poids lourd.</p>
<h3>L&#39;assurance temporaire pour les poids lourds</h3>
<p>L&#39;assurance temporaire ne concerne pas uniquement les voitures particuli&egrave;res. Elle s&#39;applique &eacute;galement aux v&eacute;hicules utilitaires l&eacute;gers et aux poids lourds, notamment :</p>
<ul>
<li>Les camions de toutes tailles (porteurs, bennes, frigorifiques...),</li>
<li>Les tracteurs routiers et semi-remorques,</li>
<li>Les bus et autocars,</li>
<li>Les utilitaires de moins et plus de 3,5 tonnes.</li>
</ul>
<p>La dur&eacute;e du contrat peut varier de 1 &agrave; 15 jours pour les poids lourds, ce qui est largement suffisant pour un trajet de retour depuis un pays europ&eacute;en.</p>
<h3>Les d&eacute;marches pour souscrire</h3>
<p>Pour assurer un camion achet&eacute; &agrave; l&#39;&eacute;tranger, vous aurez besoin :</p>
<ul>
<li>Du document d&#39;immatriculation du v&eacute;hicule (carte grise &eacute;trang&egrave;re accept&eacute;e),</li>
<li>De votre permis de conduire poids lourds (C, CE ou &eacute;quivalent),</li>
<li>Des coordonn&eacute;es du v&eacute;hicule (marque, mod&egrave;le, num&eacute;ro de s&eacute;rie, plaque),</li>
<li>D&#39;un moyen de paiement.</li>
</ul>
<h3>Quelle couverture g&eacute;ographique ?</h3>
<p>Le contrat d&#39;assurance temporaire couvre la France m&eacute;tropolitaine et l&#39;ensemble des pays de l&#39;Union Europ&eacute;enne, ainsi que la Suisse, Monaco, Andorre, le Liechtenstein et Saint-Marin. Cela permet de couvrir un trajet depuis l&#39;Allemagne, l&#39;Espagne, l&#39;Italie, la Belgique ou tout autre pays membre de l&#39;UE.</p>
<p><b>Attention</b> : certains pays comme le Maroc, l&#39;Alg&eacute;rie, la Tunisie, la Turquie et Isra&euml;l sont exclus du contrat standard. Pour ces destinations, contactez directement notre service client.</p>
<h3>Pourquoi choisir une assurance temporaire ?</h3>
<p>Une assurance annuelle impose des d&eacute;lais de souscription, des justificatifs nombreux et un engagement financier important. L&#39;assurance temporaire vous offre une solution souple, imm&eacute;diate et adapt&eacute;e au trajet unique que repr&eacute;sente le rapatriement de votre v&eacute;hicule.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T09:34:00',
			'dateModified' => '2017-08-30T09:34:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Ramener un camion acheté dans son pays?',
			'description' => 'Le contrat d\' assurance provisoire ne concerne pas que les véhicules légers, il peut être aussi utilisé pour les poids lourds, les bus et camping car',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?ramener-un-camion-achete-dans-son-pays-',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Ramener un camion acheté dans son pays?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Ramener un camion acheté dans son pays?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '16 Juin 2026',
	'timestampExt' => '16 Juin 2026',
	'utc_time' => 1504085640,
	'month' => '202606',
	'comments' => false,
	'word_count' => 59,
	'readTime' => '1:00',
	'sources' => array(),
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?ramener-un-camion-achete-dans-son-pays-',
		'type' => 'article',
		'title' => 'Ramener un camion acheté dans son pays?',
		'description' => 'Le contrat d\' assurance provisoire ne concerne pas que les véhicules légers, il peut être aussi utilisé pour les poids lourds, les bus et camping car',
		'keywords' => '',
		'updated_time' => '1504089241',
		'images' => array()
	)
);$imSettings['blog']['posts_slug']['ramener-un-camion-achete-dans-son-pays-'] = 'kv6thljn';

// Post titled "Quels sont les véhicules qui peuvent être couverts par une assurance auto tempo ?"
$imSettings['blog']['posts']['t43smc0r'] = array(
	'id' => 't43smc0r',
	'rel_url' => '?quels-sont-les-vehicules-qui-peuvent-etre-couverts-par-une-assurance-auto-tempo--',
	'title' => 'Quels sont les véhicules qui peuvent être couverts par une assurance auto tempo ?',
	'tag_title' => 'Quels sont les véhicules qui peuvent être couverts par une assurance auto tempo ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'quels-sont-les-vehicules-qui-peuvent-etre-couverts-par-une-assurance-auto-tempo--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Nous pouvons assurer l\'ensemble des véhicules roulant immatriculé',
	'tag_description' => 'Nous pouvons assurer l\'ensemble des véhicules roulant immatriculé',
	'body' => '<div id="imBlogPost_t43smc0r">
<h2>Quels v&eacute;hicules peuvent &ecirc;tre assur&eacute;s avec une assurance auto temporaire ?</h2>
<p>L&#39;assurance temporaire est bien plus polyvalente qu&#39;on ne le croit souvent. Au-del&agrave; des voitures particuli&egrave;res, elle couvre une large gamme de v&eacute;hicules terrestres &agrave; moteur, qu&#39;il s&#39;agisse de deux-roues, de poids lourds ou de v&eacute;hicules de loisirs.</p>
<h3>Les v&eacute;hicules couverts</h3>
<ul>
<li><b>Automobiles</b> de moins de 3,5 tonnes (berlines, breaks, SUV, coup&eacute;s...),</li>
<li><b>V&eacute;hicules utilitaires l&eacute;gers</b> de moins de 3,5 tonnes,</li>
<li><b>Motos</b> &agrave; partir de 125 cm&sup3;,</li>
<li><b>Voiturettes</b> (v&eacute;hicules sans permis),</li>
<li><b>Camions</b> (porteurs, grues, bennes, frigorifiques...),</li>
<li><b>Poids lourds</b> et v&eacute;hicules de plus de 3,5 tonnes,</li>
<li><b>Tracteurs routiers</b>,</li>
<li><b>Semi-remorques</b>,</li>
<li><b>Remorques</b> de moins et de plus de 750 kg,</li>
<li><b>Camping-cars</b> et fourgons am&eacute;nag&eacute;s,</li>
<li><b>Bus, autobus, cars et autocars</b>.</li>
</ul>
<h3>Conditions g&eacute;n&eacute;rales d&#39;&eacute;ligibilit&eacute;</h3>
<ul>
<li>&Ecirc;tre immatricul&eacute; (en France ou &agrave; l&#39;&eacute;tranger),</li>
<li>&Ecirc;tre en &eacute;tat de marche,</li>
<li>Ne pas &ecirc;tre d&eacute;clar&eacute; en perte totale,</li>
<li>Le conducteur doit poss&eacute;der le permis adapt&eacute; au type de v&eacute;hicule.</li>
</ul>
<h3>Cas des deux-roues</h3>
<p>Pour les scooters et motos, la puissance minimale est de 125 cm&sup3;. Les cyclomoteurs (50 cm&sup3;) ne sont g&eacute;n&eacute;ralement pas &eacute;ligibles &agrave; l&#39;assurance temporaire standard.</p>
<h3>Cas des remorques</h3>
<p>Les remorques de moins de 750 kg sont souvent couvertes automatiquement par le contrat du v&eacute;hicule tracteur, mais les remorques plus lourdes n&eacute;cessitent une d&eacute;claration sp&eacute;cifique.</p>
<h3>V&eacute;hicules non &eacute;ligibles</h3>
<p>Certains v&eacute;hicules sont exclus du contrat temporaire standard : tracteurs agricoles, engins de chantier, v&eacute;hicules d&eacute;clar&eacute;s &eacute;paves. Dans ces cas, contactez directement notre service pour trouver une solution adapt&eacute;e.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T09:26:00',
			'dateModified' => '2017-08-30T09:26:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Quels sont les véhicules qui peuvent être couverts par une assurance auto tempo ?',
			'description' => 'Nous pouvons assurer l\'ensemble des véhicules roulant immatriculé',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?quels-sont-les-vehicules-qui-peuvent-etre-couverts-par-une-assurance-auto-tempo--',
			'image' => 'https://www.tempo-assurance.com/images\\premier-ensemble-de-vehicules.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Quels sont les véhicules qui peuvent être couverts par une assurance auto tempo ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Quels sont les véhicules qui peuvent être couverts par une assurance auto tempo ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '23 Juin 2026',
	'timestampExt' => '23 Juin 2026',
	'utc_time' => 1504085160,
	'month' => '202606',
	'comments' => false,
	'word_count' => 44,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_t43smc0r" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgalleryt43smc0r() {$(\'#ss_t43smc0r\').empty().width(\'auto\');var settings = { target: \'#ss_t43smc0r\', media: [{ url: \'../images/premier-ensemble-de-vehicules.jpg\', width: 300, height: 173, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 173, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_t43smc0r\').width());settings.height = settings.width / 300 * 173;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryt43smc0r).on(\'breakpointChangedOrFluid\', loadpostgalleryt43smc0r);}x5engine.boot.push(loadpostgalleryt43smc0r);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?quels-sont-les-vehicules-qui-peuvent-etre-couverts-par-une-assurance-auto-tempo--',
		'type' => 'article',
		'title' => 'Quels sont les véhicules qui peuvent être couverts par une assurance auto tempo ?',
		'description' => 'Nous pouvons assurer l\'ensemble des véhicules roulant immatriculé',
		'keywords' => '',
		'updated_time' => '1504088760',
		'images' => array('https://www.tempo-assurance.com/blog/files/premier-ensemble-de-vehicules_og.jpg','https://www.tempo-assurance.com/blog/files/premier-ensemble-de-vehicules_og_small.jpg'),
		'postimage' => 'images/premier-ensemble-de-vehicules.jpg'
	)
);$imSettings['blog']['posts_slug']['quels-sont-les-vehicules-qui-peuvent-etre-couverts-par-une-assurance-auto-tempo--'] = 't43smc0r';

// Post titled "Quels sont les pays couverts par la Garantie"
$imSettings['blog']['posts']['7oo7d3r2'] = array(
	'id' => '7oo7d3r2',
	'rel_url' => '?quels-sont-les-pays-couverts-par-la-garantie',
	'title' => 'Quels sont les pays couverts par la Garantie',
	'tag_title' => 'Quels sont les pays couverts par la Garantie - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'quels-sont-les-pays-couverts-par-la-garantie',
	'author' => '',
	'category' => 'Information générale',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Attention avant de souscrire votre contrat temporaire en ligne vérifier votre pays de destination qui ne doit pas être barré sur votre carte verte d\'assurance temporaire',
	'tag_description' => 'Attention avant de souscrire votre contrat temporaire en ligne vérifier votre pays de destination qui ne doit pas être barré sur votre carte verte d\'assurance temporaire',
	'body' => '<div id="imBlogPost_7oo7d3r2">
<h2>Quels pays sont couverts par l&#39;assurance auto temporaire ?</h2>
<p>L&#39;assurance auto temporaire propos&eacute;e par Tempo-assurance couvre un large p&eacute;rim&egrave;tre g&eacute;ographique, incluant la France et la grande majorit&eacute; des pays europ&eacute;ens. Cependant, certains pays sont expressément exclus du contrat. Voici tout ce que vous devez savoir avant de souscrire.</p>
<h3>Pays exclus de la garantie</h3>
<p>En aucun cas la garantie ne sera accord&eacute;e pour un transit ou une circulation dans les pays suivants :</p>
<p><b>Tunisie &nbsp;&nbsp;&nbsp;Isra&euml;l &nbsp;&nbsp;&nbsp;Turquie &nbsp;&nbsp;&nbsp;Maroc &nbsp;&nbsp;&nbsp;R&eacute;publique Islamique D&#39;Iran</b></p>
<p>Pour les pays tels que le Maroc et la Tunisie, merci de nous contacter au 04.67.36.72.01 ou 06.08.23.04.79</p>
<h3>Pays couverts</h3>
<p>Nous accordons la garantie Responsabilit&eacute; Civile pour l&#39;assurance auto temporaire en France m&eacute;tropolitaine, dans les autres pays de l&#39;Union europ&eacute;enne, en Suisse, dans les &eacute;tats du Vatican, Saint-Marin, Monaco, Andorre et le Liechtenstein ainsi que dans la liste des pays ci-dessous :</p>
<p>Allemagne &nbsp;&nbsp;Autriche &nbsp;&nbsp;Belgique &nbsp;&nbsp;Bulgarie &nbsp;&nbsp;Chypre &nbsp;&nbsp;Croatie &nbsp;&nbsp;Danemark &nbsp;&nbsp;Espagne &nbsp;&nbsp;Estonie &nbsp;&nbsp;Finlande &nbsp;&nbsp;France &nbsp;&nbsp;Gr&egrave;ce &nbsp;&nbsp;Hongrie &nbsp;&nbsp;Irlande &nbsp;&nbsp;Italie &nbsp;&nbsp;Lettonie &nbsp;&nbsp;Lituanie &nbsp;&nbsp;Luxembourg &nbsp;&nbsp;Malte &nbsp;&nbsp;Pays-Bas &nbsp;&nbsp;Pologne &nbsp;&nbsp;Portugal &nbsp;&nbsp;R&eacute;publique Tch&egrave;que &nbsp;&nbsp;Roumanie &nbsp;&nbsp;Royaume-Uni &nbsp;&nbsp;Slovaquie &nbsp;&nbsp;Slov&eacute;nie &nbsp;&nbsp;Su&egrave;de</p>
<h3>L&#39;assurance fronti&egrave;re pour les pays exclus</h3>
<p>Si vous voyagez au Maroc, en Alg&eacute;rie ou en Tunisie, il existe une solution sp&eacute;cifique : l&#39;assurance fronti&egrave;re. Il s&#39;agit d&#39;une assurance temporaire souscrite &agrave; la fronti&egrave;re ou en ligne avant le d&eacute;part, qui vous couvre pour la dur&eacute;e de votre s&eacute;jour dans ces pays. Elle est obligatoire pour circuler l&eacute;galement.</p>
<p>Tempo-assurance propose des solutions adapt&eacute;es &agrave; ces destinations via son partenaire JL Assure. Contactez-nous pour en savoir plus.</p>
<h3>Que faire en cas de voyage multi-pays ?</h3>
<p>Si votre voyage traverse plusieurs pays, dont certains couverts et d&#39;autres non, assurez-vous de bien v&eacute;rifier votre itin&eacute;raire avant la souscription. Pour toute incertitude, notre &eacute;quipe est disponible pour vous conseiller.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T09:13:00',
			'dateModified' => '2017-08-30T09:13:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Quels sont les pays couverts par la Garantie',
			'description' => 'Attention avant de souscrire votre contrat temporaire en ligne vérifier votre pays de destination qui ne doit pas être barré sur votre carte verte d\'assurance temporaire',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?quels-sont-les-pays-couverts-par-la-garantie',
			'image' => 'https://www.tempo-assurance.com/images\\pays-monde-continents.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Quels sont les pays couverts par la Garantie',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Information générale',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Information générale',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Quels sont les pays couverts par la Garantie',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '30 Juin 2026',
	'timestampExt' => '30 Juin 2026',
	'utc_time' => 1504084380,
	'month' => '202606',
	'comments' => false,
	'word_count' => 172,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_7oo7d3r2" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallery7oo7d3r2() {$(\'#ss_7oo7d3r2\').empty().width(\'auto\');var settings = { target: \'#ss_7oo7d3r2\', media: [{ url: \'../images/pays-monde-continents.jpg\', width: 300, height: 297, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 297, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_7oo7d3r2\').width());settings.height = settings.width / 300 * 297;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallery7oo7d3r2).on(\'breakpointChangedOrFluid\', loadpostgallery7oo7d3r2);}x5engine.boot.push(loadpostgallery7oo7d3r2);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?quels-sont-les-pays-couverts-par-la-garantie',
		'type' => 'article',
		'title' => 'Quels sont les pays couverts par la Garantie',
		'description' => 'Attention avant de souscrire votre contrat temporaire en ligne vérifier votre pays de destination qui ne doit pas être barré sur votre carte verte d\'assurance temporaire',
		'keywords' => '',
		'updated_time' => '1504087981',
		'images' => array('https://www.tempo-assurance.com/blog/files/pays-monde-continents_og.jpg','https://www.tempo-assurance.com/blog/files/pays-monde-continents_og_small.jpg'),
		'postimage' => 'images/pays-monde-continents.jpg'
	)
);$imSettings['blog']['posts_slug']['quels-sont-les-pays-couverts-par-la-garantie'] = '7oo7d3r2';

// Post titled "Quelles sont les garanties de mon contrat ?"
$imSettings['blog']['posts']['ifg9f26r'] = array(
	'id' => 'ifg9f26r',
	'rel_url' => '?quelles-sont-les-garanties-de-mon-contrat--',
	'title' => 'Quelles sont les garanties de mon contrat ?',
	'tag_title' => 'Quelles sont les garanties de mon contrat ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'quelles-sont-les-garanties-de-mon-contrat--',
	'author' => '',
	'category' => 'Information générale',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'La garantie est la Responsabilité Civile et en option, l\'assistance.',
	'tag_description' => 'La garantie est la Responsabilité Civile et en option, l\'assistance.',
	'body' => '<div id="imBlogPost_ifg9f26r">
<h2>Quelles sont les garanties incluses dans un contrat d&#39;assurance temporaire ?</h2>
<p>L&#39;assurance auto temporaire propose diff&eacute;rents niveaux de garanties, de la couverture minimale obligatoire &agrave; des options plus &eacute;tendues. Voici un tour d&#39;horizon complet des garanties disponibles.</p>
<h3>La Responsabilit&eacute; Civile Obligatoire (RC)</h3>
<p>Toute assurance automobile, m&ecirc;me temporaire, doit inclure au minimum la <b>Responsabilit&eacute; Civile</b>, aussi appel&eacute;e &laquo;&nbsp;assurance au tiers&nbsp;&raquo;. C&#39;est une obligation l&eacute;gale en France et dans toute l&#39;Union Europ&eacute;enne.</p>
<p>La RC couvre :</p>
<ul>
<li>Les <b>dommages corporels</b> inflig&eacute;s &agrave; des tiers (pi&eacute;tons, cyclistes, passagers, autres conducteurs),</li>
<li>Les <b>dommages mat&eacute;riels</b> caus&eacute;s aux biens d&#39;autrui (v&eacute;hicules, maisons, mobilier urbain).</li>
</ul>
<h3>L&#39;assistance au v&eacute;hicule</h3>
<p>Cette garantie prend en charge le d&eacute;pannage et le remorquage de votre v&eacute;hicule en cas de panne ou d&#39;accident, que ce soit en France ou &agrave; l&#39;&eacute;tranger.</p>
<h3>La garantie D&eacute;fense et Recours</h3>
<p>Cette option prot&egrave;ge vos int&eacute;r&ecirc;ts juridiques en cas de litige suite &agrave; un accident. Pour acc&eacute;der &agrave; cette garantie, merci de nous appeler au 04.67.36.72.01 ou par mail laetitia@jlassure.com</p>
<h3>L&#39;individuelle conducteur</h3>
<p>Contrairement &agrave; la RC qui couvre uniquement les tiers, la garantie individuelle conducteur couvre le conducteur assur&eacute; lui-m&ecirc;me en cas de blessures lors d&#39;un accident, m&ecirc;me si celui-ci est responsable.</p>
<h3>Ce que l&#39;assurance temporaire ne couvre pas</h3>
<ul>
<li>Les dommages caus&eacute;s &agrave; votre propre v&eacute;hicule (sauf si une garantie dommages collision est souscrite),</li>
<li>Le vol, l&#39;incendie ou le bris de glace (sauf options sp&eacute;cifiques),</li>
<li>Les sinistres survenus dans les pays exclus du contrat.</li>
</ul>
<p>Nous proposons aussi l&#39;Assistance au v&eacute;hicule. Si vous souhaitez les garanties D&eacute;fense et recours merci de nous appeler au 04.67.36.72.01 ou par mail laetitia@jlassure.com</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T09:04:00',
			'dateModified' => '2017-08-30T09:04:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Quelles sont les garanties de mon contrat ?',
			'description' => 'La garantie est la Responsabilité Civile et en option, l\'assistance.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?quelles-sont-les-garanties-de-mon-contrat--',
			'image' => 'https://www.tempo-assurance.com/images\\rc-assistance.png',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Quelles sont les garanties de mon contrat ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Information générale',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Information générale',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Quelles sont les garanties de mon contrat ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '7 Juillet 2026',
	'timestampExt' => '7 Juillet 2026',
	'utc_time' => 1504083840,
	'month' => '202607',
	'comments' => false,
	'word_count' => 62,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_ifg9f26r" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgalleryifg9f26r() {$(\'#ss_ifg9f26r\').empty().width(\'auto\');var settings = { target: \'#ss_ifg9f26r\', media: [{ url: \'../images/rc-assistance.png\', width: 300, height: 136, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 136, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_ifg9f26r\').width());settings.height = settings.width / 300 * 136;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryifg9f26r).on(\'breakpointChangedOrFluid\', loadpostgalleryifg9f26r);}x5engine.boot.push(loadpostgalleryifg9f26r);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?quelles-sont-les-garanties-de-mon-contrat--',
		'type' => 'article',
		'title' => 'Quelles sont les garanties de mon contrat ?',
		'description' => 'La garantie est la Responsabilité Civile et en option, l\'assistance.',
		'keywords' => '',
		'updated_time' => '1504087441',
		'images' => array('https://www.tempo-assurance.com/blog/files/rc-assistance_og.png','https://www.tempo-assurance.com/blog/files/rc-assistance_og_small.png'),
		'postimage' => 'images/rc-assistance.png'
	)
);$imSettings['blog']['posts_slug']['quelles-sont-les-garanties-de-mon-contrat--'] = 'ifg9f26r';

// Post titled "Quel site pour souscrire immédiatement en ligne"
$imSettings['blog']['posts']['om68cr07'] = array(
	'id' => 'om68cr07',
	'rel_url' => '?quel-site-pour-souscrire-immediatement-en-ligne',
	'title' => 'Quel site pour souscrire immédiatement en ligne',
	'tag_title' => 'Quel site pour souscrire immédiatement en ligne - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'quel-site-pour-souscrire-immediatement-en-ligne',
	'author' => '',
	'category' => 'Information générale',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Certains site vous propose de souscrire directement en ligne et de vous délivrer la Garantie',
	'tag_description' => 'Certains site vous propose de souscrire directement en ligne et de vous délivrer la Garantie',
	'body' => '<div id="imBlogPost_om68cr07">
<h2>Quel site pour souscrire une assurance temporaire imm&eacute;diatement en ligne ?</h2>
<p>La plupart des sites Internet qui proposent de l&#39;assurance vous donnent un tarif imm&eacute;diatement en ligne mais tr&egrave;s peu permettent de souscrire en ligne. Vous devez contacter un conseiller par t&eacute;l&eacute;phone et lui communiquer les coordonn&eacute;es de votre carte bancaire pour souscrire votre contrat d&#39;assurance.</p>
<p>Aujourd&#39;hui les internautes souhaitent communiquer avec un conseiller pour obtenir des renseignements ou une aide &agrave; l&#39;&eacute;tablissement de leur devis mais ne souhaitent pas communiquer par t&eacute;l&eacute;phone leurs coordonn&eacute;es de carte bancaire.</p>
<h3>La souscription 100&nbsp;% en ligne : un vrai avantage</h3>
<p>Tempo-assurance via JL Assure propose une souscription enti&egrave;rement d&eacute;mat&eacute;rialis&eacute;e gr&acirc;ce au syst&egrave;me de paiement s&eacute;curis&eacute; CM-CIC. Voici le d&eacute;roulement :</p>
<ol>
<li>Vous renseignez les informations relatives au v&eacute;hicule et au conducteur,</li>
<li>Vous recevez un devis imm&eacute;diat,</li>
<li>Vous proc&eacute;dez au paiement en ligne (crypt&eacute; SSL, protocole 3D Secure),</li>
<li>Votre attestation d&#39;assurance vous est envoy&eacute;e <b>imm&eacute;diatement par email</b>.</li>
</ol>
<p>Toute la proc&eacute;dure prend entre 5 et 10 minutes, et fonctionne 24h/24, 7j/7.</p>
<h3>Quels documents faut-il pr&eacute;parer ?</h3>
<ul>
<li>Votre <b>permis de conduire</b> (num&eacute;ro, date d&#39;obtention),</li>
<li>La <b>carte grise</b> du v&eacute;hicule (num&eacute;ro d&#39;immatriculation, marque, mod&egrave;le),</li>
<li>Vos <b>coordonn&eacute;es personnelles</b> (nom, pr&eacute;nom, adresse, date de naissance),</li>
<li>Votre <b>carte bancaire</b> pour le paiement.</li>
</ul>
<h3>L&#39;attestation re&ccedil;ue est-elle valable imm&eacute;diatement ?</h3>
<p>Oui. L&#39;attestation d&#39;assurance provisoire re&ccedil;ue par email est imm&eacute;diatement valable et juridiquement reconnue conform&eacute;ment &agrave; l&#39;article R211-17 du Code des assurances. Vous pouvez l&#39;imprimer ou la pr&eacute;senter sur votre smartphone lors d&#39;un contr&ocirc;le routier.</p>
<p><img class="image-0 fleft" src="../images/Paiement_Securise.jpg" width="141" height="107" /></p>
<p><span class="fs11">Gr&acirc;ce &agrave; la mise en place du paiement s&eacute;curis&eacute; par CB, vous pouvez souscrire en toute s&eacute;curit&eacute; et obtenir rapidement votre garantie en ligne sur l&#39;ensemble de nos sites partenaires.</span></p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:58:00',
			'dateModified' => '2017-08-30T08:58:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Quel site pour souscrire immédiatement en ligne',
			'description' => 'Certains site vous propose de souscrire directement en ligne et de vous délivrer la Garantie',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?quel-site-pour-souscrire-immediatement-en-ligne',
			'image' => 'https://www.tempo-assurance.com/images\\Paiement_Securise.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Quel site pour souscrire immédiatement en ligne',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Information générale',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Information générale',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Quel site pour souscrire immédiatement en ligne',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '14 Juillet 2026',
	'timestampExt' => '14 Juillet 2026',
	'utc_time' => 1504083480,
	'month' => '202607',
	'comments' => false,
	'word_count' => 107,
	'readTime' => '1:00',
	'sources' => array(),
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?quel-site-pour-souscrire-immediatement-en-ligne',
		'type' => 'article',
		'title' => 'Quel site pour souscrire immédiatement en ligne',
		'description' => 'Certains site vous propose de souscrire directement en ligne et de vous délivrer la Garantie',
		'keywords' => '',
		'updated_time' => '1504087080',
		'images' => array('https://www.tempo-assurance.com/blog/files/Paiement_Securise_og.jpg','https://www.tempo-assurance.com/blog/files/Paiement_Securise_og_small.jpg'),
		'postimage' => 'images/Paiement_Securise.jpg'
	)
);$imSettings['blog']['posts_slug']['quel-site-pour-souscrire-immediatement-en-ligne'] = 'om68cr07';

// Post titled "Que faire en cas d’accident de voiture ?"
$imSettings['blog']['posts']['io7avank'] = array(
	'id' => 'io7avank',
	'rel_url' => '?que-faire-en-cas-d-accident-de-voiture--',
	'title' => 'Que faire en cas d’accident de voiture ?',
	'tag_title' => 'Que faire en cas d’accident de voiture ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'que-faire-en-cas-d-accident-de-voiture--',
	'author' => '',
	'category' => 'Information générale',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Rester calme, se mettre en sécurité et remplir un constat amiable d\'accident. Aussitot, prévenir votre assureur afin qu\'il prenne en compte votre sinistre et vous informe sur la suite des démarches qui seront prises.',
	'tag_description' => 'Rester calme, se mettre en sécurité et remplir un constat amiable d\'accident. Aussitot, prévenir votre assureur afin qu\'il prenne en compte votre sinistre et vous informe sur la suite des démarches qui seront prises.',
	'body' => '<div id="imBlogPost_io7avank">
<h2>Que faire en cas d&#39;accident de voiture avec une assurance temporaire ?</h2>
<p>M&ecirc;me avec une assurance temporaire, les d&eacute;marches &agrave; suivre en cas d&#39;accident sont similaires &agrave; celles d&#39;un contrat annuel classique. Il est essentiel de conna&icirc;tre ces &eacute;tapes &agrave; l&#39;avance pour r&eacute;agir rapidement et prot&eacute;ger vos droits.</p>
<h3>1. Assurer la s&eacute;curit&eacute; sur les lieux</h3>
<ul>
<li>Allumez vos <b>feux de d&eacute;tresse</b>,</li>
<li>Placez le <b>triangle de signalisation</b> &agrave; au moins 30 m&egrave;tres en amont sur autoroute,</li>
<li>Portez votre <b>gilet jaune</b> si vous devez sortir du v&eacute;hicule.</li>
</ul>
<h3>2. Remplir le constat &agrave; l&#39;amiable</h3>
<p>Le constat &agrave; l&#39;amiable est le document officiel &agrave; remplir sur les lieux de l&#39;accident et &agrave; envoyer &agrave; votre assurance auto sous 5 jours. Il permet de d&eacute;terminer les causes de l&#39;accident et les responsabilit&eacute;s de chacun des conducteurs.</p>
<p>Dans le meilleur des cas, les automobilistes remplissent le constat &agrave; l&#39;amiable et le signent sans aucune objection.</p>
<p>Il peut arriver que vous ne soyez pas d&#39;accord avec l&#39;autre automobiliste sur les circonstances de l&#39;accident. Un constat sign&eacute; est un document difficile &agrave; contester ult&eacute;rieurement. S&#39;il y a complication lors de l&#39;&eacute;tablissement du constat, ne signez rien. Pr&eacute;f&eacute;rez envoyer votre propre d&eacute;claration officielle des faits &agrave; votre assureur plus tard.</p>
<p>Si l&#39;autre automobiliste refuse de remplir le constat &agrave; l&#39;amiable, relevez son num&eacute;ro de plaque d&#39;immatriculation, reportez-le dans la case &laquo;&nbsp;observation&nbsp;&raquo; en pr&eacute;cisant sa contestation.</p>
<h3>3. Envoyer le constat &agrave; votre assureur</h3>
<p>Vous disposez de <b>5 jours ouvr&eacute;s</b> pour envoyer le constat &agrave; votre compagnie d&#39;assurance. Pour un contrat d&#39;assurance temporaire, envoyez le constat &agrave; : <b>laetitia@jlassure.com</b> ou contactez le <b>04.67.36.72.01</b>.</p>
<h3>4. Que couvre l&#39;assurance temporaire en cas d&#39;accident ?</h3>
<p>La garantie RC de votre assurance temporaire prend en charge les dommages caus&eacute;s aux tiers. Elle ne couvre pas votre propre v&eacute;hicule sauf si vous avez souscrit une option dommages. La garantie individuelle conducteur couvre vos propres blessures corporelles.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:52:00',
			'dateModified' => '2017-08-30T08:52:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Que faire en cas d’accident de voiture ?',
			'description' => 'Rester calme, se mettre en sécurité et remplir un constat amiable d\'accident. Aussitot, prévenir votre assureur afin qu\'il prenne en compte votre sinistre et vous informe sur la suite des démarches qui seront prises.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?que-faire-en-cas-d-accident-de-voiture--',
			'image' => 'https://www.tempo-assurance.com/images\\constat-amiable-accident.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Que faire en cas d’accident de voiture ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Information générale',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Information générale',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Que faire en cas d’accident de voiture ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '21 Juillet 2026',
	'timestampExt' => '21 Juillet 2026',
	'utc_time' => 1504083120,
	'month' => '202607',
	'comments' => false,
	'word_count' => 150,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_io7avank" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgalleryio7avank() {$(\'#ss_io7avank\').empty().width(\'auto\');var settings = { target: \'#ss_io7avank\', media: [{ url: \'../images/constat-amiable-accident.jpg\', width: 300, height: 169, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 169, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_io7avank\').width());settings.height = settings.width / 300 * 169;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryio7avank).on(\'breakpointChangedOrFluid\', loadpostgalleryio7avank);}x5engine.boot.push(loadpostgalleryio7avank);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?que-faire-en-cas-d-accident-de-voiture--',
		'type' => 'article',
		'title' => 'Que faire en cas d’accident de voiture ?',
		'description' => 'Rester calme, se mettre en sécurité et remplir un constat amiable d\'accident. Aussitot, prévenir votre assureur afin qu\'il prenne en compte votre sinistre et vous informe sur la suite des démarches qui seront prises.',
		'keywords' => '',
		'updated_time' => '1504086720',
		'images' => array('https://www.tempo-assurance.com/blog/files/constat-amiable-accident_og.jpg','https://www.tempo-assurance.com/blog/files/constat-amiable-accident_og_small.jpg'),
		'postimage' => 'images/constat-amiable-accident.jpg'
	)
);$imSettings['blog']['posts_slug']['que-faire-en-cas-d-accident-de-voiture--'] = 'io7avank';

// Post titled "Qu’est-ce que la responsabilité civile?"
$imSettings['blog']['posts']['xfes2m0j'] = array(
	'id' => 'xfes2m0j',
	'rel_url' => '?qu-est-ce-que-la-responsabilite-civile-',
	'title' => 'Qu’est-ce que la responsabilité civile?',
	'tag_title' => 'Qu’est-ce que la responsabilité civile? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'qu-est-ce-que-la-responsabilite-civile-',
	'author' => '',
	'category' => 'Information générale',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'L’assurance responsabilité civile incluse dans tout contrat d’assurance auto est obligatoire. Elle couvre les dommages causé par votre voiture lors d\'un accident avec un tiers.',
	'tag_description' => 'L’assurance responsabilité civile incluse dans tout contrat d’assurance auto est obligatoire. Elle couvre les dommages causé par votre voiture lors d\'un accident avec un tiers.',
	'body' => '<div id="imBlogPost_xfes2m0j">
<h2>Qu&#39;est-ce que la responsabilit&eacute; civile en assurance auto ?</h2>
<p>Depuis la loi du 27 f&eacute;vrier 1958, l&#39;assurance responsabilit&eacute; civile incluse dans tout contrat d&#39;assurance auto est obligatoire. Cette garantie sert &agrave; couvrir des dommages corporels et/ou mat&eacute;riels caus&eacute;s par votre voiture lors d&#39;un accident et ce, quelle qu&#39;en soit la victime (passagers ou pi&eacute;tons, autre auto...).</p>
<h3>D&eacute;finition l&eacute;gale</h3>
<p>La RC auto est d&eacute;finie par l&#39;article L211-1 du Code des assurances : &laquo;&nbsp;Toute personne physique ou morale, dont la responsabilit&eacute; civile peut &ecirc;tre engag&eacute;e en raison de dommages subis par des tiers r&eacute;sultant d&#39;atteintes aux personnes ou aux biens dans la r&eacute;alisation desquels un v&eacute;hicule terrestre &agrave; moteur est impliqu&eacute;, [...] est tenue de souscrire une assurance garantissant cette responsabilit&eacute;.&nbsp;&raquo;</p>
<h3>Ce que la RC couvre</h3>
<ul>
<li>Les <b>dommages corporels</b> inflig&eacute;s &agrave; des tiers,</li>
<li>Les <b>dommages mat&eacute;riels</b> caus&eacute;s aux biens d&#39;autrui,</li>
<li>Les dommages caus&eacute;s par <b>les passagers de votre v&eacute;hicule</b>.</li>
</ul>
<h3>Ce que la RC ne couvre pas</h3>
<p>Cependant, cette couverture ne s&#39;applique ni au conducteur qui, s&#39;il veut &ecirc;tre assur&eacute;, devra souscrire une garantie &laquo;&nbsp;individuelle conducteur&nbsp;&raquo;, ni &agrave; la voiture elle-m&ecirc;me.</p>
<p>D&#39;autres facteurs excluent l&#39;applicabilit&eacute; de cette garantie : les mauvaises conditions de s&eacute;curit&eacute; (l&#39;absence de ceinture de s&eacute;curit&eacute; par exemple), la nature des dommages ou encore le fait que les passagers aient pay&eacute; le transport.</p>
<h3>RC et assurance temporaire</h3>
<p>L&#39;assurance temporaire inclut obligatoirement la garantie RC. C&#39;est la base non n&eacute;gociable du contrat. En France, circuler sans RC est passible d&#39;une amende maximale de <b>3&nbsp;750&nbsp;&euro;</b>, d&#39;une suspension de permis et d&#39;une mise en fourri&egrave;re du v&eacute;hicule.</p>
<p>Pour une protection compl&egrave;te, il est recommand&eacute; d&#39;ajouter la garantie individuelle conducteur et l&#39;assistance &agrave; votre contrat.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:45:00',
			'dateModified' => '2017-08-30T08:45:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Qu’est-ce que la responsabilité civile?',
			'description' => 'L’assurance responsabilité civile incluse dans tout contrat d’assurance auto est obligatoire. Elle couvre les dommages causé par votre voiture lors d\'un accident avec un tiers.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?qu-est-ce-que-la-responsabilite-civile-',
			'image' => 'https://www.tempo-assurance.com/images\\rc-auto.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Qu’est-ce que la responsabilité civile?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Information générale',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Information générale',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Qu’est-ce que la responsabilité civile?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '28 Juillet 2026',
	'timestampExt' => '28 Juillet 2026',
	'utc_time' => 1504082700,
	'month' => '202607',
	'comments' => false,
	'word_count' => 106,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_xfes2m0j" style="max-width: 500px; margin: 0 auto;"></div></div><script>function loadpostgalleryxfes2m0j() {$(\'#ss_xfes2m0j\').empty().width(\'auto\');var settings = { target: \'#ss_xfes2m0j\', media: [{ url: \'../images/rc-auto.jpg\', width: 500, height: 120, autoplayTime: 7000, effect: \'none\'}],width: 500,height: 120, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 500;settings.height = 120;}if (currentBp.end == 720) {settings.width = 438;settings.height = 105;}if (currentBp.end == 480) {settings.width = 470;settings.height = 113;}if (currentBp.end == 0) {settings.width = Math.min(500, $(\'#ss_xfes2m0j\').width());settings.height = settings.width / 500 * 120;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryxfes2m0j).on(\'breakpointChangedOrFluid\', loadpostgalleryxfes2m0j);}x5engine.boot.push(loadpostgalleryxfes2m0j);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?qu-est-ce-que-la-responsabilite-civile-',
		'type' => 'article',
		'title' => 'Qu’est-ce que la responsabilité civile?',
		'description' => 'L’assurance responsabilité civile incluse dans tout contrat d’assurance auto est obligatoire. Elle couvre les dommages causé par votre voiture lors d\'un accident avec un tiers.',
		'keywords' => '',
		'updated_time' => '1504086301',
		'images' => array('https://www.tempo-assurance.com/blog/files/rc-auto_og.jpg','https://www.tempo-assurance.com/blog/files/rc-auto_og_small.jpg'),
		'postimage' => 'images/rc-auto.jpg'
	)
);$imSettings['blog']['posts_slug']['qu-est-ce-que-la-responsabilite-civile-'] = 'xfes2m0j';

// Post titled "Puis-je régler en ligne en toute sécurité?"
$imSettings['blog']['posts']['a167lwmy'] = array(
	'id' => 'a167lwmy',
	'rel_url' => '?puis-je-regler-en-ligne-en-toute-securite-',
	'title' => 'Puis-je régler en ligne en toute sécurité?',
	'tag_title' => 'Puis-je régler en ligne en toute sécurité? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'puis-je-regler-en-ligne-en-toute-securite-',
	'author' => '',
	'category' => 'Information générale',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Paiement sécurisé en ligne avec notre Banque. ',
	'tag_description' => 'Paiement sécurisé en ligne avec notre Banque. ',
	'body' => '<div id="imBlogPost_a167lwmy">
<h2>Puis-je r&eacute;gler mon assurance temporaire en ligne en toute s&eacute;curit&eacute; ?</h2>
<p>Oui, votre paiement passe par le syst&egrave;me &laquo;&nbsp;CM-CIC p@iement&nbsp;&raquo;. Lors d&#39;un achat sur internet &eacute;quip&eacute; de CM-CIC p@iement, l&#39;ensemble de la transaction s&#39;effectue sur leur site bancaire en mode crypt&eacute;. Vous quittez temporairement notre site commerçant en toute transparence pour enregistrer vos coordonn&eacute;es bancaires et ceci est la garantie que :</p>
<ul>
<li><span class="fs11">Nous ne conna&icirc;trons jamais votre num&eacute;ro de carte,</span></li>
<li><span class="fs11">CM-CIC p@iement ne pourra rien savoir du d&eacute;tail de vos achats puisque seul le montant total et le num&eacute;ro de commande lui est retransmis.</span></li>
</ul>
<h3>Quelle s&eacute;curit&eacute; utilise CM-CIC p@iement ?</h3>
<p>CM-CIC p@iement utilise le syst&egrave;me normalis&eacute; de cryptage appel&eacute; &laquo;&nbsp;le protocole SSL&nbsp;&raquo;. Il se concr&eacute;tise, lorsque vous &ecirc;tes sur la page de paiement, par :</p>
<ul>
<li><span class="fs11">Un pictogramme dans un coin de votre navigateur : un cadenas ferm&eacute; doit &ecirc;tre pr&eacute;sent.</span></li>
<li><span class="fs11">Dans la barre d&#39;adresse de votre navigateur, le navigateur est en mode &laquo;&nbsp;https://&nbsp;&raquo; au lieu de &laquo;&nbsp;http://&nbsp;&raquo;.</span></li>
<li><span class="fs11">Lorsque vous passez de mode non-crypt&eacute; en mode crypt&eacute; (et inversement), les navigateurs affichent un message vous pr&eacute;venant du changement.</span></li>
</ul>
<p>V&eacute;rifiez ces &eacute;l&eacute;ments avant la saisie de donn&eacute;es confidentielles, c&#39;est un gage de s&eacute;curit&eacute;. Afin d&#39;utiliser les protocoles les plus puissants, nous vous recommandons l&#39;usage d&#39;un navigateur de derni&egrave;re version.</p>
<h3>Quelles informations sont n&eacute;cessaires pour utiliser CM-CIC p@iement ?</h3>
<p>Sur notre site via CM-CIC p@iement, votre banque vous demandera :</p>
<ul>
<li><span class="fs11">le num&eacute;ro de carte bancaire ou de carte privative (num&eacute;ros &agrave; 15 ou 16 chiffres)</span></li>
<li><span class="fs11">la date d&#39;expiration</span></li>
<li><span class="fs11">le cryptogramme visuel (3 ou 4 derniers chiffres sur la bande de signature de votre carte)</span></li>
</ul>
<p>Avec le d&eacute;ploiement du 3D Secure (reconnaissable avec les logos &laquo;&nbsp;Verified By Visa&nbsp;&raquo; ou &laquo;&nbsp;MasterCard SecureCode&nbsp;&raquo;) votre banque vous demandera &eacute;galement lors du paiement de vous authentifier par une information confidentielle &agrave; saisir sur une page internet de votre propre banque.</p>
<h3>Recommandations pour un paiement s&eacute;curis&eacute;</h3>
<ul>
<li>Utilisez toujours un appareil personnel (évitez les ordinateurs publics),</li>
<li>Assurez-vous que votre connexion Wi-Fi est s&eacute;curis&eacute;e,</li>
<li>V&eacute;rifiez toujours le cadenas et le &laquo;&nbsp;https&nbsp;&raquo; avant de saisir vos donn&eacute;es.</li>
</ul>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:38:00',
			'dateModified' => '2017-08-30T08:38:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Puis-je régler en ligne en toute sécurité?',
			'description' => 'Paiement sécurisé en ligne avec notre Banque. ',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?puis-je-regler-en-ligne-en-toute-securite-',
			'image' => 'https://www.tempo-assurance.com/images\\paiement-en-ligne.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Puis-je régler en ligne en toute sécurité?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Information générale',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Information générale',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Puis-je régler en ligne en toute sécurité?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '4 Août 2026',
	'timestampExt' => '4 Août 2026',
	'utc_time' => 1504082280,
	'month' => '202608',
	'comments' => false,
	'word_count' => 292,
	'readTime' => '1:45',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_a167lwmy" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallerya167lwmy() {$(\'#ss_a167lwmy\').empty().width(\'auto\');var settings = { target: \'#ss_a167lwmy\', media: [{ url: \'../images/paiement-en-ligne.jpg\', width: 300, height: 277, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 277, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_a167lwmy\').width());settings.height = settings.width / 300 * 277;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallerya167lwmy).on(\'breakpointChangedOrFluid\', loadpostgallerya167lwmy);}x5engine.boot.push(loadpostgallerya167lwmy);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?puis-je-regler-en-ligne-en-toute-securite-',
		'type' => 'article',
		'title' => 'Puis-je régler en ligne en toute sécurité?',
		'description' => 'Paiement sécurisé en ligne avec notre Banque. ',
		'keywords' => '',
		'updated_time' => '1504085880',
		'images' => array('https://www.tempo-assurance.com/blog/files/paiement-en-ligne_og.jpg','https://www.tempo-assurance.com/blog/files/paiement-en-ligne_og_small.jpg'),
		'postimage' => 'images/paiement-en-ligne.jpg'
	)
);$imSettings['blog']['posts_slug']['puis-je-regler-en-ligne-en-toute-securite-'] = 'a167lwmy';

// Post titled "Pourquoi une assurance auto temporaire ?"
$imSettings['blog']['posts']['o5wx88sl'] = array(
	'id' => 'o5wx88sl',
	'rel_url' => '?pourquoi-une-assurance-auto-temporaire--',
	'title' => 'Pourquoi une assurance auto temporaire ?',
	'tag_title' => 'Pourquoi une assurance auto temporaire ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'pourquoi-une-assurance-auto-temporaire--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'L\'assurance temporaire couvre bien des cas et surtout vous permet de circuler en étant couvert vis à vis de la loi.',
	'tag_description' => 'L\'assurance temporaire couvre bien des cas et surtout vous permet de circuler en étant couvert vis à vis de la loi.',
	'body' => '<div id="imBlogPost_o5wx88sl">
<h2>Pourquoi souscrire une assurance auto temporaire ?</h2>
<p>L&#39;assurance auto temporaire r&eacute;pond &agrave; une multitude de situations de la vie quotidienne o&ugrave; un contrat annuel serait inadapt&eacute;, trop co&ucirc;teux ou impossible &agrave; mettre en place &agrave; temps. Voici les cas les plus fr&eacute;quents qui justifient le recours &agrave; ce type d&#39;assurance :</p>
<ul>
<li><span class="fs11">On vous pr&ecirc;te un v&eacute;hicule,</span></li>
<li><span class="fs11">Vous venez d&#39;acheter un nouveau v&eacute;hicule,</span></li>
<li><span class="fs11">Vous venez de vendre votre v&eacute;hicule,</span></li>
<li><span class="fs11">Car vous avez &eacute;t&eacute; r&eacute;sili&eacute; pour non paiement de prime,</span></li>
<li><span class="fs11">Vous faites de l&#39;import-export ou du transit,</span></li>
<li><span class="fs11">Vous venez d&#39;acheter aux ench&egrave;res,</span></li>
<li><span class="fs11">Car un membre de votre famille vient vous rendre visite, et il a un permis hors union europ&eacute;enne avec un v&eacute;hicule en plaque hors union europ&eacute;enne (par ex : permis alg&eacute;rien + plaques alg&eacute;riennes),</span></li>
<li><span class="fs11">Vous importez un v&eacute;hicule d&#39;Italie avec targa di cartone</span></li>
<li><span class="fs11">Vous devez r&eacute;cup&eacute;rer votre v&eacute;hicule qui a &eacute;t&eacute; mis en fourri&egrave;re pour d&eacute;faut d&#39;assurance</span></li>
<li><span class="fs11">Et bien d&#39;autres raisons encore, n&#39;h&eacute;sitez pas &agrave; nous questionner au 04.67.36.72.01 ou par mail laetitia@jlassure.com</span></li>
</ul>
<h3>L&#39;assurance temporaire : souple et imm&eacute;diate</h3>
<p>Contrairement aux contrats annuels qui n&eacute;cessitent des d&eacute;lais de traitement, l&#39;assurance temporaire est disponible <b>imm&eacute;diatement</b>, 24h/24 et 7j/7. La souscription en ligne prend moins de 10 minutes, et vous recevez votre attestation par email d&egrave;s la confirmation du paiement.</p>
<p>Pour une utilisation de 1 &agrave; 90 jours, c&#39;est la solution la plus adapt&eacute;e &agrave; votre situation. Au-del&agrave; de 90 jours, un contrat annuel devient plus avantageux financi&egrave;rement.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:19:00',
			'dateModified' => '2017-08-30T08:19:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Pourquoi une assurance auto temporaire ?',
			'description' => 'L\'assurance temporaire couvre bien des cas et surtout vous permet de circuler en étant couvert vis à vis de la loi.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?pourquoi-une-assurance-auto-temporaire--',
			'image' => 'https://www.tempo-assurance.com/images\\pourquoi.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Pourquoi une assurance auto temporaire ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Pourquoi une assurance auto temporaire ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '11 Août 2026',
	'timestampExt' => '11 Août 2026',
	'utc_time' => 1504081140,
	'month' => '202608',
	'comments' => false,
	'word_count' => 103,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_o5wx88sl" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgalleryo5wx88sl() {$(\'#ss_o5wx88sl\').empty().width(\'auto\');var settings = { target: \'#ss_o5wx88sl\', media: [{ url: \'../images/pourquoi.jpg\', width: 300, height: 150, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 150, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_o5wx88sl\').width());settings.height = settings.width / 300 * 150;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryo5wx88sl).on(\'breakpointChangedOrFluid\', loadpostgalleryo5wx88sl);}x5engine.boot.push(loadpostgalleryo5wx88sl);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?pourquoi-une-assurance-auto-temporaire--',
		'type' => 'article',
		'title' => 'Pourquoi une assurance auto temporaire ?',
		'description' => 'L\'assurance temporaire couvre bien des cas et surtout vous permet de circuler en étant couvert vis à vis de la loi.',
		'keywords' => '',
		'updated_time' => '1504084740',
		'images' => array('https://www.tempo-assurance.com/blog/files/pourquoi_og.jpg','https://www.tempo-assurance.com/blog/files/pourquoi_og_small.jpg'),
		'postimage' => 'images/pourquoi.jpg'
	)
);$imSettings['blog']['posts_slug']['pourquoi-une-assurance-auto-temporaire--'] = 'o5wx88sl';

// Post titled "Soucrire avec un permis de conduire et carte grise hors union européenne ?"
$imSettings['blog']['posts']['4tm0vbfa'] = array(
	'id' => '4tm0vbfa',
	'rel_url' => '?soucrire-avec-un-permis-de-conduire-et-carte-grise-hors-union-europeenne--',
	'title' => 'Soucrire avec un permis de conduire et carte grise hors union européenne ?',
	'tag_title' => 'Soucrire avec un permis de conduire et carte grise hors union européenne ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'soucrire-avec-un-permis-de-conduire-et-carte-grise-hors-union-europeenne--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Il existe une garanite temporaire pour les immatriculation Hors Union Européenne qui est identique à l\'aasurance temporaire mais porte le nom de Assurance Frontière.',
	'tag_description' => 'Il existe une garanite temporaire pour les immatriculation Hors Union Européenne qui est identique à l\'aasurance temporaire mais porte le nom de Assurance Frontière.',
	'body' => '<div id="imBlogPost_4tm0vbfa">
<h2>Souscrire avec un permis et une carte grise hors Union Europ&eacute;enne</h2>
<p>Oui, par exemple avec un permis alg&eacute;rien + immatriculation alg&eacute;rienne vous aurez la possibilit&eacute; de souscrire un contrat d&#39;assurance provisoire de 15 ou 30 jours. Ces garanties sont des Assurances Fronti&egrave;res.</p>
<h3>Qu&#39;est-ce qu&#39;une assurance fronti&egrave;re ?</h3>
<p>L&#39;assurance fronti&egrave;re (aussi appel&eacute;e &laquo;&nbsp;carte verte fronti&egrave;re&nbsp;&raquo;) est un contrat d&#39;assurance temporaire permettant &agrave; un conducteur &eacute;tranger de circuler l&eacute;galement en France et dans les pays de l&#39;Union Europ&eacute;enne. Elle est d&eacute;livr&eacute;e pour une dur&eacute;e limit&eacute;e (g&eacute;n&eacute;ralement 15 ou 30 jours) et couvre au minimum la Responsabilit&eacute; Civile.</p>
<h3>Conditions d&#39;&eacute;ligibilit&eacute;</h3>
<ul>
<li>Le permis de conduire &eacute;tranger doit &ecirc;tre en cours de validit&eacute;,</li>
<li>Il doit &ecirc;tre r&eacute;dig&eacute; en caract&egrave;res latins, ou accompagn&eacute; d&#39;une traduction officielle en fran&ccedil;ais, ou compl&eacute;t&eacute; par un permis de conduire international,</li>
<li>Le v&eacute;hicule doit poss&eacute;der un document d&#39;immatriculation valide,</li>
<li>Le conducteur doit avoir au moins 20 ans et justifier d&#39;au moins 2 ans de permis.</li>
</ul>
<h3>Documents &agrave; fournir</h3>
<ul>
<li>Copie du permis de conduire &eacute;tranger,</li>
<li>Copie du passeport ou de la carte d&#39;identit&eacute;,</li>
<li>Copie de la carte grise (&eacute;trang&egrave;re),</li>
<li>Adresse de r&eacute;sidence en France (si disponible) ou adresse &eacute;trang&egrave;re.</li>
</ul>
<h3>Dur&eacute;e et renouvellement</h3>
<p>L&#39;assurance fronti&egrave;re peut &ecirc;tre souscrite pour 15 ou 30 jours. Elle est renouvelable dans la limite de 90 jours cons&eacute;cutifs. Au-del&agrave;, le conducteur devra souscrire un contrat d&#39;assurance classique avec une immatriculation fran&ccedil;aise.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:14:00',
			'dateModified' => '2017-08-30T08:14:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Soucrire avec un permis de conduire et carte grise hors union européenne ?',
			'description' => 'Il existe une garanite temporaire pour les immatriculation Hors Union Européenne qui est identique à l\'aasurance temporaire mais porte le nom de Assurance Frontière.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?soucrire-avec-un-permis-de-conduire-et-carte-grise-hors-union-europeenne--',
			'image' => 'https://www.tempo-assurance.com/images\\douane.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Soucrire avec un permis de conduire et carte grise hors union européenne ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Soucrire avec un permis de conduire et carte grise hors union européenne ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '18 Août 2026',
	'timestampExt' => '18 Août 2026',
	'utc_time' => 1504080840,
	'month' => '202608',
	'comments' => false,
	'word_count' => 30,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_4tm0vbfa" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallery4tm0vbfa() {$(\'#ss_4tm0vbfa\').empty().width(\'auto\');var settings = { target: \'#ss_4tm0vbfa\', media: [{ url: \'../images/douane.jpg\', width: 300, height: 169, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 169, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_4tm0vbfa\').width());settings.height = settings.width / 300 * 169;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallery4tm0vbfa).on(\'breakpointChangedOrFluid\', loadpostgallery4tm0vbfa);}x5engine.boot.push(loadpostgallery4tm0vbfa);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?soucrire-avec-un-permis-de-conduire-et-carte-grise-hors-union-europeenne--',
		'type' => 'article',
		'title' => 'Soucrire avec un permis de conduire et carte grise hors union européenne ?',
		'description' => 'Il existe une garanite temporaire pour les immatriculation Hors Union Européenne qui est identique à l\'aasurance temporaire mais porte le nom de Assurance Frontière.',
		'keywords' => '',
		'updated_time' => '1504084440',
		'images' => array('https://www.tempo-assurance.com/blog/files/douane_og.jpg','https://www.tempo-assurance.com/blog/files/douane_og_small.jpg'),
		'postimage' => 'images/douane.jpg'
	)
);$imSettings['blog']['posts_slug']['soucrire-avec-un-permis-de-conduire-et-carte-grise-hors-union-europeenne--'] = '4tm0vbfa';

// Post titled "Peut-on résilier un contrat auto tempo ?"
$imSettings['blog']['posts']['kyrkj9ah'] = array(
	'id' => 'kyrkj9ah',
	'rel_url' => '?peut-on-resilier-un-contrat-auto-tempo--',
	'title' => 'Peut-on résilier un contrat auto tempo ?',
	'tag_title' => 'Peut-on résilier un contrat auto tempo ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'peut-on-resilier-un-contrat-auto-tempo--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Non, car un contrat d\' assurance temporaire est un contrat sans tacite recondution.',
	'tag_description' => 'Non, car un contrat d\' assurance temporaire est un contrat sans tacite recondution.',
	'body' => '<div id="imBlogPost_kyrkj9ah">
<h2>Peut-on r&eacute;silier un contrat d&#39;assurance auto temporaire ?</h2>
<p>Non, car un contrat d&#39;assurance temporaire est un contrat sans tacite reconduction. Le contrat auto temporaire se termine automatiquement &agrave; la fin de la p&eacute;riode pour laquelle il a &eacute;t&eacute; souscrit.</p>
<h3>Pourquoi le contrat temporaire ne se r&eacute;silie-t-il pas ?</h3>
<p>Un contrat d&#39;assurance temporaire est un contrat &agrave; <b>dur&eacute;e d&eacute;termin&eacute;e</b> : il prend fin automatiquement &agrave; la date et &agrave; l&#39;heure pr&eacute;vues lors de la souscription. Il n&#39;y a donc :</p>
<ul>
<li><b>Pas de pr&eacute;avis &agrave; respecter</b>,</li>
<li><b>Pas de lettre de r&eacute;siliation &agrave; envoyer</b>,</li>
<li><b>Pas de proc&eacute;dure administrative</b>.</li>
</ul>
<h3>Si vous souhaitez annuler avant le d&eacute;but de la garantie</h3>
<p>Si la date de d&eacute;but de votre garantie n&#39;a pas encore &eacute;t&eacute; atteinte, il est possible d&#39;annuler votre contrat. Dans ce cas, contactez <b>imm&eacute;diatement</b> notre service client :</p>
<ul>
<li>Par t&eacute;l&eacute;phone : <b>04.67.36.72.01</b> ou <b>06.08.23.04.79</b>,</li>
<li>Par email : <b>laetitia@jlassure.com</b>.</li>
</ul>
<h3>Si vous souhaitez annuler apr&egrave;s le d&eacute;but de la garantie</h3>
<p>&Agrave; partir du moment o&ugrave; votre garantie a pris effet, <b>aucun remboursement ne sera effectu&eacute;</b> sauf cas exceptionnel &agrave; nous soumettre par t&eacute;l&eacute;phone au 04.67.36.72.01 ou 06.08.23.04.79.</p>
<h3>Puis-je prolonger mon contrat ?</h3>
<p>Oui. Si vous avez souscrit pour 3 jours mais que votre situation se prolonge, vous pouvez souscrire un nouveau contrat &agrave; l&#39;expiration du premier. Attention : il n&#39;est pas possible de prolonger un contrat en cours ; il faut cr&eacute;er un nouveau contrat sur la plateforme.</p>
<p>&Agrave; l&#39;expiration du contrat temporaire, vous n&#39;&ecirc;tes plus assur&eacute;. Il est de votre responsabilit&eacute; de vous assurer &agrave; nouveau avant de reprendre le volant.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:12:00',
			'dateModified' => '2017-08-30T08:12:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Peut-on résilier un contrat auto tempo ?',
			'description' => 'Non, car un contrat d\' assurance temporaire est un contrat sans tacite recondution.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?peut-on-resilier-un-contrat-auto-tempo--',
			'image' => 'https://www.tempo-assurance.com/images\\annulation_9b934jzr.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Peut-on résilier un contrat auto tempo ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Peut-on résilier un contrat auto tempo ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '25 Août 2026',
	'timestampExt' => '25 Août 2026',
	'utc_time' => 1504080720,
	'month' => '202608',
	'comments' => false,
	'word_count' => 31,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_kyrkj9ah" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallerykyrkj9ah() {$(\'#ss_kyrkj9ah\').empty().width(\'auto\');var settings = { target: \'#ss_kyrkj9ah\', media: [{ url: \'../images/annulation_9b934jzr.jpg\', width: 300, height: 170, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 170, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_kyrkj9ah\').width());settings.height = settings.width / 300 * 170;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallerykyrkj9ah).on(\'breakpointChangedOrFluid\', loadpostgallerykyrkj9ah);}x5engine.boot.push(loadpostgallerykyrkj9ah);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?peut-on-resilier-un-contrat-auto-tempo--',
		'type' => 'article',
		'title' => 'Peut-on résilier un contrat auto tempo ?',
		'description' => 'Non, car un contrat d\' assurance temporaire est un contrat sans tacite recondution.',
		'keywords' => '',
		'updated_time' => '1504084320',
		'images' => array('https://www.tempo-assurance.com/blog/files/annulation_og.jpg','https://www.tempo-assurance.com/blog/files/annulation_og_small.jpg'),
		'postimage' => 'images/annulation_9b934jzr.jpg'
	)
);$imSettings['blog']['posts_slug']['peut-on-resilier-un-contrat-auto-tempo--'] = 'kyrkj9ah';

// Post titled "La carte grise est barrée ?"
$imSettings['blog']['posts']['deqiqqcm'] = array(
	'id' => 'deqiqqcm',
	'rel_url' => '?la-carte-grise-est-barree--',
	'title' => 'La carte grise est barrée ?',
	'tag_title' => 'La carte grise est barrée ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'la-carte-grise-est-barree--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Oui même si la garte grise est barrée et quel que soit le moment ou elle a été barrée, nous pouvons assurer votre véhicule',
	'tag_description' => 'Oui même si la garte grise est barrée et quel que soit le moment ou elle a été barrée, nous pouvons assurer votre véhicule',
	'body' => '<div id="imBlogPost_deqiqqcm">
<h2>La carte grise est barr&eacute;e : puis-je souscrire une assurance temporaire ?</h2>
<p>Oui, vous pouvez souscrire un contrat auto temporaire avec une carte grise barr&eacute;e. Cette situation se produit fr&eacute;quemment lors d&#39;une vente de v&eacute;hicule et ne constitue pas un obstacle &agrave; la souscription.</p>
<h3>Pourquoi une carte grise est-elle barr&eacute;e ?</h3>
<p>En France, lorsque vous vendez un v&eacute;hicule d&#39;occasion, vous devez remettre la carte grise &agrave; l&#39;acheteur en la <b>barrant de fa&ccedil;on diagonale</b> avec votre signature et la mention &laquo;&nbsp;Vendu le [date]&nbsp;&raquo;. Cette proc&eacute;dure est pr&eacute;vue par l&#39;article R322-8 du Code de la route et sert &agrave; emp&ecirc;cher toute r&eacute;utilisation frauduleuse du document.</p>
<h3>Dans quelles situations rencontre-t-on ce cas ?</h3>
<ul>
<li>Achat d&#39;un v&eacute;hicule d&#39;occasion entre particuliers,</li>
<li>Achat dans une vente aux ench&egrave;res,</li>
<li>Reprise d&#39;un v&eacute;hicule de succession avant la nouvelle immatriculation.</li>
</ul>
<h3>Comment souscrire avec une carte grise barr&eacute;e ?</h3>
<p>La proc&eacute;dure de souscription est identique &agrave; celle d&#39;une carte grise normale. Vous devez fournir les informations du v&eacute;hicule (num&eacute;ro d&#39;immatriculation, marque, mod&egrave;le), votre permis de conduire et vos coordonn&eacute;es personnelles.</p>
<p>La carte grise barr&eacute;e est accept&eacute;e car elle confirme que vous &ecirc;tes bien l&#39;acqu&eacute;reur du v&eacute;hicule et que vous avez le droit de l&#39;utiliser.</p>
<h3>Quel d&eacute;lai pour l&#39;immatriculation d&eacute;finitive ?</h3>
<p>Vous disposez de <b>30 jours</b> pour effectuer la demande de certificat d&#39;immatriculation &agrave; votre nom aupr&egrave;s de l&#39;ANTS ou d&#39;un professionnel habilit&eacute;. L&#39;assurance temporaire est id&eacute;ale pour couvrir cette p&eacute;riode de transition, en attendant de recevoir la nouvelle carte grise et de souscrire un contrat annuel.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:06:00',
			'dateModified' => '2017-08-30T08:06:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'La carte grise est barrée ?',
			'description' => 'Oui même si la garte grise est barrée et quel que soit le moment ou elle a été barrée, nous pouvons assurer votre véhicule',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?la-carte-grise-est-barree--',
			'image' => 'https://www.tempo-assurance.com/images\\carte-grise-barree.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'La carte grise est barrée ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'La carte grise est barrée ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '1 Septembre 2026',
	'timestampExt' => '1 Septembre 2026',
	'utc_time' => 1504080360,
	'month' => '202609',
	'comments' => false,
	'word_count' => 13,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_deqiqqcm" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallerydeqiqqcm() {$(\'#ss_deqiqqcm\').empty().width(\'auto\');var settings = { target: \'#ss_deqiqqcm\', media: [{ url: \'../images/carte-grise-barree.jpg\', width: 300, height: 399, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 399, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_deqiqqcm\').width());settings.height = settings.width / 300 * 399;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallerydeqiqqcm).on(\'breakpointChangedOrFluid\', loadpostgallerydeqiqqcm);}x5engine.boot.push(loadpostgallerydeqiqqcm);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?la-carte-grise-est-barree--',
		'type' => 'article',
		'title' => 'La carte grise est barrée ?',
		'description' => 'Oui même si la garte grise est barrée et quel que soit le moment ou elle a été barrée, nous pouvons assurer votre véhicule',
		'keywords' => '',
		'updated_time' => '1504083960',
		'images' => array('https://www.tempo-assurance.com/blog/files/carte-grise-barree_og.jpg','https://www.tempo-assurance.com/blog/files/carte-grise-barree_og_small.jpg'),
		'postimage' => 'images/carte-grise-barree.jpg'
	)
);$imSettings['blog']['posts_slug']['la-carte-grise-est-barree--'] = 'deqiqqcm';

// Post titled "La carte grise n'est pas à mon nom ?"
$imSettings['blog']['posts']['d1m9eirp'] = array(
	'id' => 'd1m9eirp',
	'rel_url' => '?la-carte-grise-n-est-pas-a-mon-nom--',
	'title' => 'La carte grise n\'est pas à mon nom ?',
	'tag_title' => 'La carte grise n\'est pas à mon nom ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'la-carte-grise-n-est-pas-a-mon-nom--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Oui, vous pouvez faire un contrat d\'assurance de courte durée même si la carte grise donc le véhicule appartient à une autre personne.',
	'tag_description' => 'Oui, vous pouvez faire un contrat d\'assurance de courte durée même si la carte grise donc le véhicule appartient à une autre personne.',
	'body' => '<div id="imBlogPost_d1m9eirp">
<h2>La carte grise n&#39;est pas &agrave; mon nom : puis-je m&#39;assurer temporairement ?</h2>
<p>Oui, vous pouvez faire un contrat d&#39;assurance de courte dur&eacute;e m&ecirc;me si la carte grise n&#39;est pas &agrave; votre nom. C&#39;est une situation courante et parfaitement l&eacute;gale dans de nombreux cas de figure.</p>
<h3>Dans quels cas la carte grise n&#39;est-elle pas au nom du conducteur ?</h3>
<ul>
<li>Vous <b>conduisez le v&eacute;hicule d&#39;un proche</b> (parent, ami, conjoint) qui vous le pr&ecirc;te,</li>
<li>Vous avez <b>achet&eacute; un v&eacute;hicule</b> et n&#39;avez pas encore effectu&eacute; le changement de titulaire,</li>
<li>Vous utilisez un <b>v&eacute;hicule de soci&eacute;t&eacute;</b> ou de fonction,</li>
<li>Vous r&eacute;cup&eacute;rez un <b>v&eacute;hicule de succession</b> avant le r&egrave;glement de la succession.</li>
</ul>
<h3>L&#39;assurance temporaire est-elle valable dans ce cas ?</h3>
<p>Oui. L&#39;assurance temporaire couvre le conducteur <b>pour l&#39;utilisation du v&eacute;hicule</b>, ind&eacute;pendamment du propri&eacute;taire. Elle correspond juridiquement &agrave; une &laquo;&nbsp;assurance pour compte de qui il appartiendra&nbsp;&raquo;, ce qui est express&eacute;ment pr&eacute;vu par le Code des assurances.</p>
<h3>Documents &agrave; fournir</h3>
<ul>
<li>Votre permis de conduire,</li>
<li>Les informations du v&eacute;hicule (num&eacute;ro d&#39;immatriculation, marque, mod&egrave;le, date de mise en circulation),</li>
<li>Si possible, une copie ou les informations de la carte grise (m&ecirc;me au nom d&#39;un tiers).</li>
</ul>
<h3>Attention aux situations non couvertes</h3>
<p>Certaines situations font exception : si vous n&#39;avez pas l&#39;autorisation du propri&eacute;taire pour utiliser le v&eacute;hicule, l&#39;assurance ne pourra pas s&#39;appliquer en cas de sinistre. L&#39;utilisation sans consentement du propri&eacute;taire constitue une violation du contrat d&#39;assurance et potentiellement un d&eacute;lit.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T08:05:00',
			'dateModified' => '2017-08-30T08:05:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'La carte grise n\'est pas à mon nom ?',
			'description' => 'Oui, vous pouvez faire un contrat d\'assurance de courte durée même si la carte grise donc le véhicule appartient à une autre personne.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?la-carte-grise-n-est-pas-a-mon-nom--',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'La carte grise n\'est pas à mon nom ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'La carte grise n\'est pas à mon nom ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '8 Septembre 2026',
	'timestampExt' => '8 Septembre 2026',
	'utc_time' => 1504080300,
	'month' => '202609',
	'comments' => false,
	'word_count' => 20,
	'readTime' => '1:00',
	'sources' => array(),
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?la-carte-grise-n-est-pas-a-mon-nom--',
		'type' => 'article',
		'title' => 'La carte grise n\'est pas à mon nom ?',
		'description' => 'Oui, vous pouvez faire un contrat d\'assurance de courte durée même si la carte grise donc le véhicule appartient à une autre personne.',
		'keywords' => '',
		'updated_time' => '1504083901',
		'images' => array()
	)
);$imSettings['blog']['posts_slug']['la-carte-grise-n-est-pas-a-mon-nom--'] = 'd1m9eirp';

// Post titled "Peut-on faire une assurance provisoire 24h/24 et 7j/7 ?"
$imSettings['blog']['posts']['76sy9ovz'] = array(
	'id' => '76sy9ovz',
	'rel_url' => '?peut-on-faire-une-assurance-provisoire-24h-24-et-7j-7--',
	'title' => 'Peut-on faire une assurance provisoire 24h/24 et 7j/7 ?',
	'tag_title' => 'Peut-on faire une assurance provisoire 24h/24 et 7j/7 ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'peut-on-faire-une-assurance-provisoire-24h-24-et-7j-7--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Oui, vous pouvez soucrire une assurance auto temporaire à n\'importe quel moment du jour et de la nuit mais avec une contraite, elle ne sera délivrée qu\'entre 9h00 et 23h00 et ce, tous les jours de l\'année.',
	'tag_description' => 'Oui, vous pouvez soucrire une assurance auto temporaire à n\'importe quel moment du jour et de la nuit mais avec une contraite, elle ne sera délivrée qu\'entre 9h00 et 23h00 et ce, tous les jours de l\'année.',
	'body' => '<div id="imBlogPost_76sy9ovz">
<h2>Peut-on souscrire une assurance provisoire 24h/24 et 7j/7 ?</h2>
<p>Oui, vous pouvez souscrire une assurance auto temporaire &agrave; n&#39;importe quel moment. Gr&acirc;ce &agrave; la souscription en ligne, vous pouvez obtenir une attestation d&#39;assurance &agrave; n&#39;importe quelle heure du jour ou de la nuit, y compris le week-end et les jours f&eacute;ri&eacute;s.</p>
<h3>Les Garanties seront d&eacute;livr&eacute;es du lundi au dimanche inclus entre 9h00 et 23h00.</h3>
<p>La plateforme de souscription de Tempo-assurance est accessible <b>&agrave; toute heure</b>. Que vous ayez besoin d&#39;une assurance &agrave; 3h du matin pour r&eacute;cup&eacute;rer un v&eacute;hicule en urgence ou le dimanche soir avant un d&eacute;part &agrave; l&#39;&eacute;tranger, le processus de souscription est enti&egrave;rement automatis&eacute;.</p>
<p>En quelques clics, vous remplissez le formulaire, effectuez votre paiement s&eacute;curis&eacute; et recevez votre attestation par email. Le tout en moins de 10 minutes.</p>
<h3>Assistance t&eacute;l&eacute;phonique</h3>
<p><span class="imUl">En cas de probl&egrave;me : 04.67.36.72.01</span> ou 06.08.23.04.79 de 09h00 &agrave; 23h00.</p>
<h3>Pourquoi cette disponibilit&eacute; est-elle importante ?</h3>
<p>Les situations n&eacute;cessitant une assurance temporaire urgente se produisent souvent de mani&egrave;re impr&eacute;visible : immobilisation d&#39;un v&eacute;hicule par la police un vendredi soir, achat coup de c&oelig;ur d&#39;un v&eacute;hicule le week-end, d&eacute;part &agrave; l&#39;&eacute;tranger pr&eacute;vu pour le lendemain matin...</p>
<p>Dans toutes ces situations, attendre l&#39;ouverture d&#39;une agence le lundi matin n&#39;est pas une option. L&#39;assurance temporaire en ligne r&eacute;sout ce probl&egrave;me en quelques minutes.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T07:53:00',
			'dateModified' => '2017-08-30T07:53:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Peut-on faire une assurance provisoire 24h/24 et 7j/7 ?',
			'description' => 'Oui, vous pouvez soucrire une assurance auto temporaire à n\'importe quel moment du jour et de la nuit mais avec une contraite, elle ne sera délivrée qu\'entre 9h00 et 23h00 et ce, tous les jours de l\'année.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?peut-on-faire-une-assurance-provisoire-24h-24-et-7j-7--',
			'image' => 'https://www.tempo-assurance.com/images\\jour-nuit.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Peut-on faire une assurance provisoire 24h/24 et 7j/7 ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Peut-on faire une assurance provisoire 24h/24 et 7j/7 ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '15 Septembre 2026',
	'timestampExt' => '15 Septembre 2026',
	'utc_time' => 1504079580,
	'month' => '202609',
	'comments' => false,
	'word_count' => 34,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_76sy9ovz" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallery76sy9ovz() {$(\'#ss_76sy9ovz\').empty().width(\'auto\');var settings = { target: \'#ss_76sy9ovz\', media: [{ url: \'../images/jour-nuit.jpg\', width: 300, height: 246, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 246, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_76sy9ovz\').width());settings.height = settings.width / 300 * 246;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallery76sy9ovz).on(\'breakpointChangedOrFluid\', loadpostgallery76sy9ovz);}x5engine.boot.push(loadpostgallery76sy9ovz);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?peut-on-faire-une-assurance-provisoire-24h-24-et-7j-7--',
		'type' => 'article',
		'title' => 'Peut-on faire une assurance provisoire 24h/24 et 7j/7 ?',
		'description' => 'Oui, vous pouvez soucrire une assurance auto temporaire à n\'importe quel moment du jour et de la nuit mais avec une contraite, elle ne sera délivrée qu\'entre 9h00 et 23h00 et ce, tous les jours de l\'année.',
		'keywords' => '',
		'updated_time' => '1504083181',
		'images' => array('https://www.tempo-assurance.com/blog/files/jour-nuit_og.jpg','https://www.tempo-assurance.com/blog/files/jour-nuit_og_small.jpg'),
		'postimage' => 'images/jour-nuit.jpg'
	)
);$imSettings['blog']['posts_slug']['peut-on-faire-une-assurance-provisoire-24h-24-et-7j-7--'] = '76sy9ovz';

// Post titled "Permis étranger pour une assurance de courte durée ?"
$imSettings['blog']['posts']['ppezxr8o'] = array(
	'id' => 'ppezxr8o',
	'rel_url' => '?permis-etranger-pour-une-assurance-de-courte-duree--',
	'title' => 'Permis étranger pour une assurance de courte durée ?',
	'tag_title' => 'Permis étranger pour une assurance de courte durée ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'permis-etranger-pour-une-assurance-de-courte-duree--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Oui, vous pouvez assurer votre véhicule avec un permis étranger ...',
	'tag_description' => 'Oui, vous pouvez assurer votre véhicule avec un permis étranger ...',
	'body' => '<div id="imBlogPost_ppezxr8o">
<h2>Permis &eacute;tranger pour une assurance de courte dur&eacute;e</h2>
<p>Oui, vous pouvez assurer votre v&eacute;hicule avec un permis &eacute;tranger &agrave; partir du moment o&ugrave; celui-ci est en cours de validit&eacute; sur le territoire fran&ccedil;ais pendant la dur&eacute;e de la garantie auto tempo.</p>
<p>En ce qui concerne les permis de conduire obtenus hors union europ&eacute;enne, il doit &ecirc;tre r&eacute;dig&eacute; en fran&ccedil;ais ou accompagn&eacute; d&#39;une traduction officielle en fran&ccedil;ais ou accompagn&eacute; du permis de conduire international en cours de validit&eacute;.</p>
<h3>Permis de conduire europ&eacute;en</h3>
<p>Si vous poss&eacute;dez un permis de conduire d&eacute;livr&eacute; par un pays membre de l&#39;Union Europ&eacute;enne ou de l&#39;Espace &Eacute;conomique Europ&eacute;en (EEE), il est reconnu en France sans aucune restriction et sans besoin de traduction. Vous pouvez souscrire une assurance temporaire avec ce permis comme avec un permis fran&ccedil;ais.</p>
<h3>Qu&#39;est-ce que le permis de conduire international ?</h3>
<p>Le permis international est un livret multilingue officiel qui traduit votre permis national dans les langues des pays signataires de la Convention de Vienne. Il est valable 3 ans et reconnu dans plus de 150 pays. Pour les ressortissants alg&eacute;riens, marocains, tunisiens, s&eacute;n&eacute;galais et de nombreux autres pays, c&#39;est la solution la plus simple pour circuler en France.</p>
<h3>Dur&eacute;e de validit&eacute; du permis &eacute;tranger en France</h3>
<p>Si vous vous installez durablement en France, vous devrez &eacute;changer votre permis &eacute;tranger contre un permis fran&ccedil;ais dans un d&eacute;lai d&#39;1 an &agrave; compter de l&#39;obtention de votre titre de s&eacute;jour. L&#39;assurance temporaire vous permet de vous couvrir l&eacute;galement le temps d&#39;effectuer cet &eacute;change.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T07:38:00',
			'dateModified' => '2017-08-30T07:38:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Permis étranger pour une assurance de courte durée ?',
			'description' => 'Oui, vous pouvez assurer votre véhicule avec un permis étranger ...',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?permis-etranger-pour-une-assurance-de-courte-duree--',
			'image' => 'https://www.tempo-assurance.com/images\\Permis-etranger.png',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Permis étranger pour une assurance de courte durée ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Permis étranger pour une assurance de courte durée ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '22 Septembre 2026',
	'timestampExt' => '22 Septembre 2026',
	'utc_time' => 1504078680,
	'month' => '202609',
	'comments' => false,
	'word_count' => 68,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_ppezxr8o" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgalleryppezxr8o() {$(\'#ss_ppezxr8o\').empty().width(\'auto\');var settings = { target: \'#ss_ppezxr8o\', media: [{ url: \'../images/Permis-etranger.png\', width: 300, height: 175, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 175, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_ppezxr8o\').width());settings.height = settings.width / 300 * 175;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryppezxr8o).on(\'breakpointChangedOrFluid\', loadpostgalleryppezxr8o);}x5engine.boot.push(loadpostgalleryppezxr8o);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?permis-etranger-pour-une-assurance-de-courte-duree--',
		'type' => 'article',
		'title' => 'Permis étranger pour une assurance de courte durée ?',
		'description' => 'Oui, vous pouvez assurer votre véhicule avec un permis étranger ...',
		'keywords' => '',
		'updated_time' => '1504082280',
		'images' => array('https://www.tempo-assurance.com/blog/files/Permis-etranger_og.png','https://www.tempo-assurance.com/blog/files/Permis-etranger_og_small.png'),
		'postimage' => 'images/Permis-etranger.png'
	)
);$imSettings['blog']['posts_slug']['permis-etranger-pour-une-assurance-de-courte-duree--'] = 'ppezxr8o';

// Post titled "Peut-on annuler un contrat ?"
$imSettings['blog']['posts']['nkrjfkr4'] = array(
	'id' => 'nkrjfkr4',
	'rel_url' => '?peut-on-annuler-un-contrat--',
	'title' => 'Peut-on annuler un contrat ?',
	'tag_title' => 'Peut-on annuler un contrat ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'peut-on-annuler-un-contrat--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'A partir du moment où votre garantie a pris effet, il vous sera impossible d\'annuler la garantie',
	'tag_description' => 'A partir du moment où votre garantie a pris effet, il vous sera impossible d\'annuler la garantie',
	'body' => '<div id="imBlogPost_nkrjfkr4">
<h2>Peut-on annuler un contrat d&#39;assurance temporaire ?</h2>
<ol>
<li><span class="fs11">&Agrave; partir du moment o&ugrave; votre garantie a pris effet, il vous sera impossible d&#39;annuler la garantie auto tempo (sauf cas exceptionnel &agrave; nous soumettre par t&eacute;l&eacute;phone au 04.67.36.72.01 ou 06.08.23.04.79), par cons&eacute;quent aucun remboursement ne sera effectu&eacute;.</span></li>
<li><span class="fs11">Si votre garantie auto temporaire n&#39;a pas encore pris effet, nous vous invitons &agrave; prendre contact imm&eacute;diatement avec nos conseillers au 04.67.36.72.01 ou 06.08.23.04.79 ou laetitia@jlassure.com</span></li>
</ol>
<h3>Puis-je b&eacute;n&eacute;ficier du d&eacute;lai de r&eacute;tractation l&eacute;gal ?</h3>
<p>En principe, les contrats d&#39;assurance conclus &agrave; distance (en ligne) b&eacute;n&eacute;ficient d&#39;un d&eacute;lai de r&eacute;tractation de 14 jours en vertu du Code de la consommation. Cependant, ce d&eacute;lai <b>ne s&#39;applique pas</b> aux contrats d&#39;assurance dont l&#39;ex&eacute;cution a commenc&eacute;, m&ecirc;me &agrave; la demande du souscripteur, avant l&#39;expiration de ce d&eacute;lai.</p>
<p>Cela signifie que si vous avez demand&eacute; une prise d&#39;effet imm&eacute;diate (ou dans les 24 heures), vous ne b&eacute;n&eacute;ficiez pas du d&eacute;lai de r&eacute;tractation de 14 jours.</p>
<h3>Conseils pour &eacute;viter les erreurs lors de la souscription</h3>
<ul>
<li>V&eacute;rifiez bien les dates de d&eacute;but et de fin de garantie avant de valider,</li>
<li>Contr&ocirc;lez les informations sur le v&eacute;hicule (plaque d&#39;immatriculation, marque, mod&egrave;le),</li>
<li>Assurez-vous que les donn&eacute;es du conducteur sont exactes,</li>
<li>Relisez les conditions g&eacute;n&eacute;rales avant de payer.</li>
</ul>
<p>Si vous constatez une erreur apr&egrave;s paiement, contactez imm&eacute;diatement notre service client pour correction avant la prise d&#39;effet de la garantie.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T07:20:00',
			'dateModified' => '2017-08-30T07:20:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Peut-on annuler un contrat ?',
			'description' => 'A partir du moment où votre garantie a pris effet, il vous sera impossible d\'annuler la garantie',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?peut-on-annuler-un-contrat--',
			'image' => 'https://www.tempo-assurance.com/images\\annulation_9b934jzr.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Peut-on annuler un contrat ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Peut-on annuler un contrat ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '29 Septembre 2026',
	'timestampExt' => '29 Septembre 2026',
	'utc_time' => 1504077600,
	'month' => '202609',
	'comments' => false,
	'word_count' => 62,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_nkrjfkr4" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallerynkrjfkr4() {$(\'#ss_nkrjfkr4\').empty().width(\'auto\');var settings = { target: \'#ss_nkrjfkr4\', media: [{ url: \'../images/annulation_9b934jzr.jpg\', width: 300, height: 170, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 170, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_nkrjfkr4\').width());settings.height = settings.width / 300 * 170;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallerynkrjfkr4).on(\'breakpointChangedOrFluid\', loadpostgallerynkrjfkr4);}x5engine.boot.push(loadpostgallerynkrjfkr4);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?peut-on-annuler-un-contrat--',
		'type' => 'article',
		'title' => 'Peut-on annuler un contrat ?',
		'description' => 'A partir du moment où votre garantie a pris effet, il vous sera impossible d\'annuler la garantie',
		'keywords' => '',
		'updated_time' => '1504081201',
		'images' => array('https://www.tempo-assurance.com/blog/files/annulation_og.jpg','https://www.tempo-assurance.com/blog/files/annulation_og_small.jpg'),
		'postimage' => 'images/annulation_9b934jzr.jpg'
	)
);$imSettings['blog']['posts_slug']['peut-on-annuler-un-contrat--'] = 'nkrjfkr4';

// Post titled "L’assurance auto temporaire pour qui ?"
$imSettings['blog']['posts']['3p46pgxw'] = array(
	'id' => '3p46pgxw',
	'rel_url' => '?l-assurance-auto-temporaire-pour-qui--',
	'title' => 'L’assurance auto temporaire pour qui ?',
	'tag_title' => 'L’assurance auto temporaire pour qui ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'l-assurance-auto-temporaire-pour-qui--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Pour tout automobiliste, particulier ou professionnel, âgé de 20 à 90 ans et ayant un permis de plus de 2 ans valide sur le territoire français.',
	'tag_description' => 'Pour tout automobiliste, particulier ou professionnel, âgé de 20 à 90 ans et ayant un permis de plus de 2 ans valide sur le territoire français.',
	'body' => '<div id="imBlogPost_3p46pgxw">
<h2>L&#39;assurance auto temporaire pour qui ?</h2>
<p>Tout automobiliste, particulier ou professionnel, &acirc;g&eacute; de 20 &agrave; 90 ans, peut opter pour l&#39;assurance auto temporaire d&egrave;s lors qu&#39;il justifie d&#39;au moins 2 ans de permis de conduire.</p>
<p>Elle est id&eacute;ale dans bien des cas, par exemple : pour un conducteur occasionnel, pour un week-end, lors d&#39;un s&eacute;jour &agrave; l&#39;&eacute;tranger, pendant la dur&eacute;e d&#39;immobilisation d&#39;un v&eacute;hicule par les forces de l&#39;ordre, pour un v&eacute;hicule immatricul&eacute; en France en transit entre l&#39;Hexagone et un pays &eacute;tranger...</p>
<p>L&#39;assurance auto de courte dur&eacute;e s&#39;adresse aux conducteurs qui n&#39;utilisent pas leur voiture de fa&ccedil;on r&eacute;guli&egrave;re.</p>
<p>Sa dur&eacute;e peut &ecirc;tre de 1 &agrave; 90 jours. Pour &ecirc;tre valable &agrave; l&#39;&eacute;tranger, la dur&eacute;e de cette assurance provisoire doit &ecirc;tre sup&eacute;rieure &agrave; 3 jours.</p>
<h3>Profils types</h3>
<ul>
<li><b>Le conducteur occasionnel</b> : vous n&#39;utilisez pas de voiture au quotidien mais avez besoin d&#39;en emprunter une ponctuellement,</li>
<li><b>Le jeune conducteur (20 ans et plus)</b> : &eacute;vitez les surprimes des assureurs annuels pour une utilisation limit&eacute;e,</li>
<li><b>Le conducteur r&eacute;sili&eacute;</b> : l&#39;assurance temporaire reste accessible m&ecirc;me apr&egrave;s une r&eacute;siliation,</li>
<li><b>Le voyageur ou le touriste</b> : couverture adapt&eacute;e &agrave; la dur&eacute;e de votre s&eacute;jour en France,</li>
<li><b>Le professionnel de l&#39;automobile</b> : couvrez les v&eacute;hicules en transit ou confi&eacute;s temporairement,</li>
<li><b>Le particulier lors d&#39;une transaction</b> : achat, vente, succession, divorce — couvrez la p&eacute;riode de transition.</li>
</ul>
<h3>Pourquoi choisir Tempo-assurance ?</h3>
<ul>
<li>Partenaire officiel de JL Assure, courtier en assurances reconnu,</li>
<li>Paiement 100% s&eacute;curis&eacute; via CM-CIC p@iement,</li>
<li>Attestation instantan&eacute;e par email,</li>
<li>Service client disponible de 9h &agrave; 23h, 7j/7,</li>
<li>Couverture France + Europe.</li>
</ul>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T07:12:00',
			'dateModified' => '2017-08-30T07:12:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'L’assurance auto temporaire pour qui ?',
			'description' => 'Pour tout automobiliste, particulier ou professionnel, âgé de 20 à 90 ans et ayant un permis de plus de 2 ans valide sur le territoire français.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?l-assurance-auto-temporaire-pour-qui--',
			'image' => 'https://www.tempo-assurance.com/images\\groupe_humain.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'L’assurance auto temporaire pour qui ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'L’assurance auto temporaire pour qui ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '6 Octobre 2026',
	'timestampExt' => '6 Octobre 2026',
	'utc_time' => 1504077120,
	'month' => '202610',
	'comments' => false,
	'word_count' => 115,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_3p46pgxw" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallery3p46pgxw() {$(\'#ss_3p46pgxw\').empty().width(\'auto\');var settings = { target: \'#ss_3p46pgxw\', media: [{ url: \'../images/groupe_humain.jpg\', width: 300, height: 226, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 226, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_3p46pgxw\').width());settings.height = settings.width / 300 * 226;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallery3p46pgxw).on(\'breakpointChangedOrFluid\', loadpostgallery3p46pgxw);}x5engine.boot.push(loadpostgallery3p46pgxw);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?l-assurance-auto-temporaire-pour-qui--',
		'type' => 'article',
		'title' => 'L’assurance auto temporaire pour qui ?',
		'description' => 'Pour tout automobiliste, particulier ou professionnel, âgé de 20 à 90 ans et ayant un permis de plus de 2 ans valide sur le territoire français.',
		'keywords' => '',
		'updated_time' => '1504080720',
		'images' => array('https://www.tempo-assurance.com/blog/files/groupe_humain_og.jpg','https://www.tempo-assurance.com/blog/files/groupe_humain_og_small.jpg'),
		'postimage' => 'images/groupe_humain.jpg'
	)
);$imSettings['blog']['posts_slug']['l-assurance-auto-temporaire-pour-qui--'] = '3p46pgxw';

// Post titled "Est-ce que l'attestation d'assurance provisoire que j'ai téléchargée est valable pour circuler ?"
$imSettings['blog']['posts']['q7hbjrbe'] = array(
	'id' => 'q7hbjrbe',
	'rel_url' => '?est-ce-que-l-attestation-d-assurance-provisoire-que-j-ai-telechargee-est-valable-pour-circuler--',
	'title' => 'Est-ce que l\'attestation d\'assurance provisoire que j\'ai téléchargée est valable pour circuler ?',
	'tag_title' => 'Est-ce que l\'attestation d\'assurance provisoire que j\'ai téléchargée est valable pour circuler ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'est-ce-que-l-attestation-d-assurance-provisoire-que-j-ai-telechargee-est-valable-pour-circuler--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Oui, si elle est en vigueur au Code des assurances - Article R211-17',
	'tag_description' => 'Oui, si elle est en vigueur au Code des assurances - Article R211-17',
	'body' => '<div id="imBlogPost_q7hbjrbe">
<h2>Est-ce que l&#39;attestation d&#39;assurance provisoire t&eacute;l&eacute;charg&eacute;e est valable pour circuler ?</h2>
<p>Oui, en vigueur au Code des assurances - Article R211-17 : &laquo;&nbsp;<b>La carte internationale d&#39;assurance, dite &ldquo;carte verte&rdquo;</b>&nbsp;&raquo;, vaut comme document justificatif pendant sa p&eacute;riode de validit&eacute;.</p>
<p>Cette attestation doit mentionner :</p>
<ul>
<li><span class="fs11">la d&eacute;nomination et l&#39;adresse de l&#39;entreprise d&#39;assurance,</span></li>
<li><span class="fs11">les noms, pr&eacute;noms et adresse du souscripteur du contrat,</span></li>
<li><span class="fs11">la nature et le type du v&eacute;hicule,</span></li>
<li><span class="fs11">la p&eacute;riode pendant laquelle elle est valable.</span></li>
</ul>
<h3>Sous quelle forme pr&eacute;senter l&#39;attestation ?</h3>
<ul>
<li><b>Imprim&eacute;e sur papier</b> : la forme traditionnelle, toujours accept&eacute;e,</li>
<li><b>Sur smartphone</b> : depuis 2017, les forces de l&#39;ordre acceptent la pr&eacute;sentation num&eacute;rique d&#39;une attestation d&#39;assurance sur t&eacute;l&eacute;phone mobile.</li>
</ul>
<h3>La validit&eacute; est-elle imm&eacute;diate ?</h3>
<p>Oui. D&egrave;s r&eacute;ception de l&#39;email de confirmation de votre paiement, votre attestation est valable selon la date et l&#39;heure de d&eacute;but que vous avez indiqu&eacute;es lors de la souscription (dans les plages horaires de 9h00 &agrave; 23h00).</p>
<h3>Que faire si vous perdez votre attestation ?</h3>
<p>En cas de perte ou de probl&egrave;me avec votre attestation, contactez notre service client au 04.67.36.72.01. Un duplicata peut vous &ecirc;tre envoy&eacute; par email dans les plus brefs d&eacute;lais.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-30T06:51:00',
			'dateModified' => '2017-08-30T06:51:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Est-ce que l\'attestation d\'assurance provisoire que j\'ai téléchargée est valable pour circuler ?',
			'description' => 'Oui, si elle est en vigueur au Code des assurances - Article R211-17',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?est-ce-que-l-attestation-d-assurance-provisoire-que-j-ai-telechargee-est-valable-pour-circuler--',
			'image' => 'https://www.tempo-assurance.com/images\\garantie_couleur.png',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Est-ce que l\'attestation d\'assurance provisoire que j\'ai téléchargée est valable pour circuler ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Est-ce que l\'attestation d\'assurance provisoire que j\'ai téléchargée est valable pour circuler ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '13 Octobre 2026',
	'timestampExt' => '13 Octobre 2026',
	'utc_time' => 1504075860,
	'month' => '202610',
	'comments' => false,
	'word_count' => 57,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_q7hbjrbe" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgalleryq7hbjrbe() {$(\'#ss_q7hbjrbe\').empty().width(\'auto\');var settings = { target: \'#ss_q7hbjrbe\', media: [{ url: \'../images/garantie_couleur.png\', width: 300, height: 134, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 134, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_q7hbjrbe\').width());settings.height = settings.width / 300 * 134;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryq7hbjrbe).on(\'breakpointChangedOrFluid\', loadpostgalleryq7hbjrbe);}x5engine.boot.push(loadpostgalleryq7hbjrbe);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?est-ce-que-l-attestation-d-assurance-provisoire-que-j-ai-telechargee-est-valable-pour-circuler--',
		'type' => 'article',
		'title' => 'Est-ce que l\'attestation d\'assurance provisoire que j\'ai téléchargée est valable pour circuler ?',
		'description' => 'Oui, si elle est en vigueur au Code des assurances - Article R211-17',
		'keywords' => '',
		'updated_time' => '1504079460',
		'images' => array('https://www.tempo-assurance.com/blog/files/garantie_couleur_og.png','https://www.tempo-assurance.com/blog/files/garantie_couleur_og_small.png'),
		'postimage' => 'images/garantie_couleur.png'
	)
);$imSettings['blog']['posts_slug']['est-ce-que-l-attestation-d-assurance-provisoire-que-j-ai-telechargee-est-valable-pour-circuler--'] = 'q7hbjrbe';

// Post titled "Comment souscrire en ligne ?"
$imSettings['blog']['posts']['kvz1jy7n'] = array(
	'id' => 'kvz1jy7n',
	'rel_url' => '?comment-souscrire-en-ligne--',
	'title' => 'Comment souscrire en ligne ?',
	'tag_title' => 'Comment souscrire en ligne ? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'comment-souscrire-en-ligne--',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Grâce à la simplicité de notre module, laissez vous guider en répondant aux questions posées et ensuite payez et adressez vos pièces par mail.',
	'tag_description' => 'Grâce à la simplicité de notre module, laissez vous guider en répondant aux questions posées et ensuite payez et adressez vos pièces par mail.',
	'body' => '<div id="imBlogPost_kvz1jy7n">
<h2>Comment souscrire une assurance temporaire en ligne ?</h2>
<p>Souscrire une assurance auto temporaire en ligne est simple, rapide et s&eacute;curis&eacute;. Voici le processus complet, &eacute;tape par &eacute;tape, pour obtenir votre attestation d&#39;assurance en quelques minutes.</p>
<h3>&Eacute;tape 1 : Acc&eacute;der au formulaire de devis</h3>
<p>Rendez-vous sur notre page de souscription. Vous trouverez un formulaire en ligne &agrave; remplir avec les informations relatives &agrave; votre situation.</p>
<h3>&Eacute;tape 2 : Renseigner les informations du v&eacute;hicule</h3>
<ul>
<li>Le <b>type de v&eacute;hicule</b> (voiture, moto, camion, utilitaire...),</li>
<li>La <b>marque et le mod&egrave;le</b>,</li>
<li>Le <b>num&eacute;ro d&#39;immatriculation</b>,</li>
<li>L&#39;<b>ann&eacute;e de mise en circulation</b>.</li>
</ul>
<h3>&Eacute;tape 3 : Renseigner les informations du conducteur</h3>
<ul>
<li>Vos <b>nom, pr&eacute;nom et date de naissance</b>,</li>
<li>Votre <b>adresse postale</b>,</li>
<li>Le <b>num&eacute;ro de votre permis de conduire</b>,</li>
<li>La <b>date d&#39;obtention du permis</b>,</li>
<li>Votre <b>adresse email</b> (pour recevoir l&#39;attestation).</li>
</ul>
<h3>&Eacute;tape 4 : Choisir la dur&eacute;e et la formule</h3>
<p>S&eacute;lectionnez la dur&eacute;e souhait&eacute;e (de 1 &agrave; 90 jours) et la date de d&eacute;but de la garantie. Choisissez &eacute;galement votre formule d&#39;assurance : Responsabilit&eacute; Civile seule, ou avec options compl&eacute;mentaires.</p>
<h3>&Eacute;tape 5 : Obtenir votre devis et proc&eacute;der au paiement</h3>
<p>Un devis vous est pr&eacute;sent&eacute; imm&eacute;diatement. Si vous l&#39;acceptez, vous &ecirc;tes redirig&eacute; vers la page de paiement s&eacute;curis&eacute; CM-CIC. Saisissez vos coordonn&eacute;es bancaires et validez le paiement.</p>
<h3>&Eacute;tape 6 : Recevoir votre attestation par email</h3>
<p>D&egrave;s la confirmation du paiement, votre attestation d&#39;assurance provisoire vous est envoy&eacute;e par email dans les <b>5 &agrave; 10 minutes</b>. Elle est valable imm&eacute;diatement selon la date de d&eacute;but choisie.</p>
<p>En cas de doute sur une information, n&#39;h&eacute;sitez pas &agrave; contacter notre &eacute;quipe au <b>04.67.36.72.01</b>.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-24T15:34:00',
			'dateModified' => '2017-08-24T15:34:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Comment souscrire en ligne ?',
			'description' => 'Grâce à la simplicité de notre module, laissez vous guider en répondant aux questions posées et ensuite payez et adressez vos pièces par mail.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?comment-souscrire-en-ligne--',
			'image' => 'https://www.tempo-assurance.com/images\\assurance_camping-car.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Comment souscrire en ligne ?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Comment souscrire en ligne ?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '20 Octobre 2026',
	'timestampExt' => '20 Octobre 2026',
	'utc_time' => 1503588840,
	'month' => '202610',
	'comments' => false,
	'word_count' => 45,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_kvz1jy7n" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallerykvz1jy7n() {$(\'#ss_kvz1jy7n\').empty().width(\'auto\');var settings = { target: \'#ss_kvz1jy7n\', media: [{ url: \'../images/assurance_camping-car.jpg\', width: 300, height: 157, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 157, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_kvz1jy7n\').width());settings.height = settings.width / 300 * 157;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallerykvz1jy7n).on(\'breakpointChangedOrFluid\', loadpostgallerykvz1jy7n);}x5engine.boot.push(loadpostgallerykvz1jy7n);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?comment-souscrire-en-ligne--',
		'type' => 'article',
		'title' => 'Comment souscrire en ligne ?',
		'description' => 'Grâce à la simplicité de notre module, laissez vous guider en répondant aux questions posées et ensuite payez et adressez vos pièces par mail.',
		'keywords' => '',
		'updated_time' => '1503592440',
		'images' => array('https://www.tempo-assurance.com/blog/files/assurance_camping-car_og.jpg','https://www.tempo-assurance.com/blog/files/assurance_camping-car_og_small.jpg'),
		'postimage' => 'images/assurance_camping-car.jpg'
	)
);$imSettings['blog']['posts_slug']['comment-souscrire-en-ligne--'] = 'kvz1jy7n';

// Post titled "Assurance temporaire"
$imSettings['blog']['posts']['5uli40tu'] = array(
	'id' => '5uli40tu',
	'rel_url' => '?assurance-temporaire',
	'title' => 'Assurance temporaire',
	'tag_title' => 'Assurance temporaire - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'assurance-temporaire',
	'author' => '',
	'category' => 'Assurance temporaire',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'L’assurance auto temporaire est comme son nom l’indique une assurance de courte durée qui correspond à une demande ponctuelle afin de vous garantir lors de vos déplacements.',
	'tag_description' => 'L’assurance auto temporaire est comme son nom l’indique une assurance de courte durée qui correspond à une demande ponctuelle afin de vous garantir lors de vos déplacements.',
	'body' => '<div id="imBlogPost_5uli40tu">
<h2>Assurance temporaire : tout ce que vous devez savoir</h2>
<p>L&#39;assurance temporaire est un contrat d&#39;assurance automobile &agrave; dur&eacute;e d&eacute;termin&eacute;e, qui offre une couverture flexible pour tous les conducteurs ayant des besoins ponctuels d&#39;assurance. Contrairement aux contrats annuels, elle ne vous engage que pour la dur&eacute;e que vous choisissez.</p>
<h3>D&eacute;finition et fonctionnement</h3>
<p>Une assurance temporaire (aussi appel&eacute;e assurance provisoire ou assurance de courte dur&eacute;e) couvre un v&eacute;hicule et son conducteur pour une p&eacute;riode d&eacute;termin&eacute;e, allant de <b>1 jour &agrave; 90 jours</b>. &Agrave; l&#39;inverse d&#39;un contrat annuel, l&#39;assurance temporaire <b>ne se reconduit pas tacitement</b> : elle s&#39;arr&ecirc;te automatiquement &agrave; la date et l&#39;heure pr&eacute;vues. Aucune d&eacute;marche de r&eacute;siliation n&#39;est n&eacute;cessaire.</p>
<h3>Les principales caract&eacute;ristiques</h3>
<ul>
<li><b>Dur&eacute;e</b> : de 1 &agrave; 90 jours,</li>
<li><b>Souscription</b> : enti&egrave;rement en ligne, en moins de 10 minutes,</li>
<li><b>Disponibilit&eacute;</b> : 24h/24, 7j/7,</li>
<li><b>Attestation</b> : re&ccedil;ue par email imm&eacute;diatement apr&egrave;s paiement,</li>
<li><b>Couverture g&eacute;ographique</b> : France et Union Europ&eacute;enne (+ pays associ&eacute;s),</li>
<li><b>Sans engagement</b> : pas de r&eacute;siliation &agrave; g&eacute;rer.</li>
</ul>
<h3>Pour quels v&eacute;hicules ?</h3>
<p>L&#39;assurance temporaire couvre une large gamme de v&eacute;hicules : voitures, motos (125 cm&sup3; et plus), utilitaires, camions, semi-remorques, camping-cars, bus, autocars, et voiturettes (sans permis).</p>
<h3>L&#39;assurance temporaire est-elle plus ch&egrave;re qu&#39;une assurance annuelle ?</h3>
<p>Pour une utilisation ponctuelle, l&#39;assurance temporaire est g&eacute;n&eacute;ralement <b>moins co&ucirc;teuse</b> qu&#39;un contrat annuel pro-ratis&eacute;. En revanche, pour une utilisation r&eacute;guli&egrave;re de plus de 90 jours, un contrat annuel devient plus avantageux. L&#39;assurance temporaire est l&#39;outil id&eacute;al pour une utilisation v&eacute;ritablement occasionnelle.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-23T07:17:00',
			'dateModified' => '2017-08-23T07:17:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Assurance temporaire',
			'description' => 'L’assurance auto temporaire est comme son nom l’indique une assurance de courte durée qui correspond à une demande ponctuelle afin de vous garantir lors de vos déplacements.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?assurance-temporaire',
			'image' => 'https://www.tempo-assurance.com/images\\calendrier_1jour.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Assurance temporaire',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Assurance temporaire',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '27 Octobre 2026',
	'timestampExt' => '27 Octobre 2026',
	'utc_time' => 1503472620,
	'month' => '202610',
	'comments' => false,
	'word_count' => 40,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_5uli40tu" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgallery5uli40tu() {$(\'#ss_5uli40tu\').empty().width(\'auto\');var settings = { target: \'#ss_5uli40tu\', media: [{ url: \'../images/calendrier_1jour.jpg\', width: 300, height: 225, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 225, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_5uli40tu\').width());settings.height = settings.width / 300 * 225;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgallery5uli40tu).on(\'breakpointChangedOrFluid\', loadpostgallery5uli40tu);}x5engine.boot.push(loadpostgallery5uli40tu);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?assurance-temporaire',
		'type' => 'article',
		'title' => 'Assurance temporaire',
		'description' => 'L’assurance auto temporaire est comme son nom l’indique une assurance de courte durée qui correspond à une demande ponctuelle afin de vous garantir lors de vos déplacements.',
		'keywords' => '',
		'updated_time' => '1503476220',
		'images' => array('https://www.tempo-assurance.com/blog/files/calendrier_1jour_og.jpg','https://www.tempo-assurance.com/blog/files/calendrier_1jour_og_small.jpg'),
		'postimage' => 'images/calendrier_1jour.jpg'
	)
);$imSettings['blog']['posts_slug']['assurance-temporaire'] = '5uli40tu';

// Post titled "Combien de temps faut-il pour être assuré?"
$imSettings['blog']['posts']['foadc224'] = array(
	'id' => 'foadc224',
	'rel_url' => '?combien-de-temps-faut-il-pour-etre-assure-',
	'title' => 'Combien de temps faut-il pour être assuré?',
	'tag_title' => 'Combien de temps faut-il pour être assuré? - Questions Assurance Temporaire - Tempo-assurance',
	'title_heading_tag' => 'h1',
	'slug' => 'combien-de-temps-faut-il-pour-etre-assure-',
	'author' => '',
	'category' => 'Information générale',
	'cardCover' => '',
	'coverAlt' => '',
	'coverTitle' => '',
	'cover' => '',
	'summary' => 'Vous pouvez être assuré en moins de 5mn à condition d\'avoir correctement rempli les formulaires et d\'avoir les documents en règles.',
	'tag_description' => 'Vous pouvez être assuré en moins de 5mn à condition d\'avoir correctement rempli les formulaires et d\'avoir les documents en règles.',
	'body' => '<div id="imBlogPost_foadc224">
<h2>Combien de temps faut-il pour &ecirc;tre assur&eacute; avec une assurance temporaire ?</h2>
<p>L&#39;un des principaux atouts de l&#39;assurance auto temporaire est sa rapidit&eacute;. Dans la grande majorit&eacute; des cas, vous pouvez &ecirc;tre couvert en moins de 10 minutes.</p>
<h3>Le processus de souscription en d&eacute;tail</h3>
<ol>
<li><b>Remplir le formulaire</b> : 3 &agrave; 5 minutes (informations v&eacute;hicule + conducteur),</li>
<li><b>Obtenir le devis</b> : imm&eacute;diat (calcul automatis&eacute;),</li>
<li><b>Proc&eacute;der au paiement</b> : 1 &agrave; 2 minutes (paiement s&eacute;curis&eacute; CM-CIC),</li>
<li><b>Recevoir l&#39;attestation</b> : 5 &agrave; 10 minutes apr&egrave;s la confirmation du paiement.</li>
</ol>
<p>Au total, la proc&eacute;dure compl&egrave;te prend entre 5 et 15 minutes, du d&eacute;but du formulaire &agrave; la r&eacute;ception de l&#39;attestation dans votre bo&icirc;te email.</p>
<h3>Quand la garantie prend-elle effet ?</h3>
<p>La prise d&#39;effet de votre garantie d&eacute;pend de la date et de l&#39;heure que vous avez s&eacute;lectionn&eacute;es lors de la souscription. Vous pouvez choisir :</p>
<ul>
<li><b>Une prise d&#39;effet imm&eacute;diate</b> : votre couverture commence d&egrave;s la confirmation du paiement (dans les plages horaires 9h00-23h00),</li>
<li><b>Une prise d&#39;effet diff&eacute;r&eacute;e</b> : vous choisissez une date de d&eacute;but future (utile si vous avez besoin d&#39;assurance pour un d&eacute;placement pr&eacute;vu dans quelques jours).</li>
</ul>
<h3>Documents n&eacute;cessaires &agrave; pr&eacute;parer</h3>
<p>Pour acc&eacute;l&eacute;rer la proc&eacute;dure, ayez &agrave; port&eacute;e de main :</p>
<ul>
<li>Votre <b>permis de conduire</b> (num&eacute;ro et date d&#39;obtention),</li>
<li>La <b>carte grise</b> du v&eacute;hicule (num&eacute;ro d&#39;immatriculation, marque, mod&egrave;le),</li>
<li>Votre <b>adresse email</b> valide (pour recevoir l&#39;attestation),</li>
<li>Votre <b>carte bancaire</b>.</li>
</ul>
<h3>Disponible 24h/24</h3>
<p>La plateforme de souscription fonctionne <b>24h/24 et 7j/7</b>, sans aucune interruption. Que ce soit &agrave; 2h du matin ou le jour de No&euml;l, vous pouvez souscrire votre assurance temporaire et recevoir votre attestation imm&eacute;diatement.</p>
<p>Notre service client est &eacute;galement disponible par t&eacute;l&eacute;phone (<b>04.67.36.72.01</b>) ou par mail (<b>laetitia@jlassure.com</b>) en cas de question ou de difficult&eacute;.</p>
<div class="cta-souscription" style="background:#f0f4ff;border:2px solid #3a5caa;border-radius:8px;padding:20px;margin-top:30px;text-align:center;"><strong>Pr&ecirc;t(e) &agrave; vous assurer rapidement ?</strong><br><br>Souscrivez votre assurance temporaire en quelques minutes, 24h/24 et 7j/7.<br><br><a href="https://www.tempo-assurance.com/devis-ou-souscription.html" style="background:#3a5caa;color:#fff;padding:12px 28px;border-radius:5px;text-decoration:none;font-weight:bold;display:inline-block;margin-top:10px;">Obtenir mon devis en ligne &rarr;</a></div><div style="clear: both;"></div></div>',
	'rich_data_type' => array(
		array(
			'@type' => 'BlogPosting',
			'@context' => 'https://schema.org',
			'publisher' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'datePublished' => '2017-08-23T07:16:00',
			'dateModified' => '2017-08-23T07:16:00',
			'author' => array(
				'@type' => 'Organization',
				'name' => 'Questions Assurance Temporaire'
			),
			'headline' => 'Combien de temps faut-il pour être assuré?',
			'description' => 'Vous pouvez être assuré en moins de 5mn à condition d\'avoir correctement rempli les formulaires et d\'avoir les documents en règles.',
			'mainEntityOfPage' => 'https://www.tempo-assurance.com/blog/?combien-de-temps-faut-il-pour-etre-assure-',
			'image' => 'https://www.tempo-assurance.com/images\\calendrier_montre.jpg',
			'speakable' => array(
				'@type' => 'SpeakableSpecification',
				'xpath' => array(
					'/html/head/title',
					'/html/head/meta[@name=\'description\']/@content'
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Août 2017',
					'item' => 'https://www.tempo-assurance.com/blog/?month=201708',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Combien de temps faut-il pour être assuré?',
					'position' => 3
				)
			)
		),
		array(
			'@type' => 'BreadcrumbList',
			'@context' => 'https://schema.org',
			'numberOfItems' => 3,
			'itemListElement' => array(
				array(
					'@type' => 'ListItem',
					'name' => 'Questions Assurance Temporaire',
					'item' => 'https://www.tempo-assurance.com/blog',
					'position' => 1
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Information générale',
					'item' => 'https://www.tempo-assurance.com/blog/?category=Information générale',
					'position' => 2
				),
				array(
					'@type' => 'ListItem',
					'name' => 'Combien de temps faut-il pour être assuré?',
					'position' => 3
				)
			)
		)
	),
	'keywords' => '',
	'timestamp' => '3 Novembre 2026',
	'timestampExt' => '3 Novembre 2026',
	'utc_time' => 1503472560,
	'month' => '202611',
	'comments' => false,
	'word_count' => 61,
	'readTime' => '1:00',
	'sources' => array(),
	'slideshow' => '<div style="margin: 5px auto;"><div id="ss_foadc224" style="max-width: 300px; margin: 0 auto;"></div></div><script>function loadpostgalleryfoadc224() {$(\'#ss_foadc224\').empty().width(\'auto\');var settings = { target: \'#ss_foadc224\', media: [{ url: \'../images/calendrier_montre.jpg\', width: 300, height: 200, autoplayTime: 7000, effect: \'none\'}],width: 300,height: 200, backgroundColor: \'transparent\', resFolder: \'../res\', autoplay: true,slideshow: { active: true, buttonPrev: { url: x5engine.settings.currentPath + \'blog/files/b17_l.png\', x: 4, y: 0 }, buttonNext: { url: x5engine.settings.currentPath + \'blog/files/b17_r.png\', x: 4, y: 0 }, nextPrevMode: \'hover\'}};var currentBp = x5engine.responsive.getCurrentBreakPoint();if (currentBp.end == 960) {settings.width = 300;settings.height = 225;}if (currentBp.end == 720) {settings.width = 300;settings.height = 225;}if (currentBp.end == 480) {settings.width = 300;settings.height = 225;}if (currentBp.end == 0) {settings.width = Math.min(300, $(\'#ss_foadc224\').width());settings.height = settings.width / 300 * 200;}x5engine.gallery(settings);$(\'#imContent\').off(\'breakpointChangedOrFluid\', loadpostgalleryfoadc224).on(\'breakpointChangedOrFluid\', loadpostgalleryfoadc224);}x5engine.boot.push(loadpostgalleryfoadc224);</script>',
	'tag' => array(),
	'opengraph' => array(
		'url' => 'https://www.tempo-assurance.com/blog/?combien-de-temps-faut-il-pour-etre-assure-',
		'type' => 'article',
		'title' => 'Combien de temps faut-il pour être assuré?',
		'description' => 'Vous pouvez être assuré en moins de 5mn à condition d\'avoir correctement rempli les formulaires et d\'avoir les documents en règles.',
		'keywords' => '',
		'updated_time' => '1503476161',
		'images' => array('https://www.tempo-assurance.com/blog/files/calendrier_montre_og.jpg','https://www.tempo-assurance.com/blog/files/calendrier_montre_og_small.jpg'),
		'postimage' => 'images/calendrier_montre.jpg'
	)
);$imSettings['blog']['posts_slug']['combien-de-temps-faut-il-pour-etre-assure-'] = 'foadc224';
$imSettings['blog']['posts_cat'] = array(
	'Assurance temporaire' => array(
		'jj09duxz',
		'kv6thljn',
		't43smc0r',
		'o5wx88sl',
		'4tm0vbfa',
		'kyrkj9ah',
		'deqiqqcm',
		'd1m9eirp',
		'76sy9ovz',
		'ppezxr8o',
		'nkrjfkr4',
		'3p46pgxw',
		'q7hbjrbe',
		'kvz1jy7n',
		'5uli40tu'
	),
	'Information générale' => array(
		'jfv0ey90',
		'7oo7d3r2',
		'ifg9f26r',
		'om68cr07',
		'io7avank',
		'xfes2m0j',
		'a167lwmy',
		'foadc224'
	)
);
$imSettings['blog']['posts_author'] = array();
$imSettings['blog']['posts_month'] = array(
	'201708' => array(
		'jj09duxz',
		'jfv0ey90',
		'kv6thljn',
		't43smc0r',
		'7oo7d3r2',
		'ifg9f26r',
		'om68cr07',
		'io7avank',
		'xfes2m0j',
		'a167lwmy',
		'o5wx88sl',
		'4tm0vbfa',
		'kyrkj9ah',
		'deqiqqcm',
		'd1m9eirp',
		'76sy9ovz',
		'ppezxr8o',
		'nkrjfkr4',
		'3p46pgxw',
		'q7hbjrbe',
		'kvz1jy7n',
		'5uli40tu',
		'foadc224'
	)
);
$imSettings['blog']['posts_tag'] = array();

// End of file blog.inc.php