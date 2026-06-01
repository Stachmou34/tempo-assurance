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
	'body' => "<div id=\"imBlogPost_jj09duxz\"><div>Oui, vous pouvez souscrire une assurance temporaire de 1 à 90 jours renouvelables.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504086060,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_jfv0ey90\"><div>Oui, vous pouvez-vous souscrire en ligne une assurance temporaire.</div><div><br></div><div>Le contrat auto tempo permet à ceux dont le véhicule a été mis en fourrière pour défaut d' assurance, de s'assurer 1 journée ou même plus, le temps de récupérer leur automobile.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504085760,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_kv6thljn\"><div>Vous êtes étranger et venez d'acheter un camion, pouvez-vous faire un contrat d' assurance temporaire le temps de le ramener dans votre pays ?</div><div><br></div><div>Oui, le contrat d' assurance provisoire ne concerne pas que les véhicules légers. </div><div>Vous pouvez donc souscrire en ligne un contrat d' assurance temporaire pour les camions pour une courte durée de 1 à 15 jours.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504085640,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_t43smc0r\">Les véhicules suivant peuvent être couverts:<div><br><div><div><ul><li><span class=\"fs11\">Les automobiles de moins de 3.5 tonnes,</span><br></li><li><span class=\"fs11\">Les Utilitaires de moins de 3.5 tonnes,</span><br></li><li><span class=\"fs11\">Les Motos à partir de 125cm3,</span><br></li><li><span class=\"fs11\">les voiturettes (sans permis),</span><br></li><li><span class=\"fs11\">Les camions,</span><br></li><li><span class=\"fs11\">Les poids lourds,</span><br></li><li><span class=\"fs11\">Les tracteurs routiers,</span><br></li><li><span class=\"fs11\">Les semi-remorques,</span><br></li><li><span class=\"fs11\">Les remorques de moins et plus de 750kg,</span><br></li><li><span class=\"fs11\">Les camping-cars,</span><br></li><li><span class=\"fs11\">Les bus,</span><br></li><li><span class=\"fs11\">Les auto-bus,</span><br></li><li><span class=\"fs11\">Les cars,</span><br></li><li><span class=\"fs11\">Les autocars.</span><br></li></ul></div></div></div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504085160,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_7oo7d3r2\"><div>Assurance Auto Temporaire : Couverture par Pays</div><div><br></div><div>Attention avant de souscrire votre contrat temporaire en ligne vérifier votre pays de destination, car nous excluons de notre garantie assurance temporaire certains pays voir la liste ci-dessous.</div><div><br></div><div>En aucun cas notre garantie temporaire auto ne sera acquise en cas de transit ou circulation dans les pays exclus de l'assurance temporaire.</div><div><br></div><div><i><span class=\"imUl\">Les pays suivants ne sont pas couverts</span> par notre Contrat Assurance Auto Temporaire</i></div><div><span class=\"cf1\"><b>Tunisie &nbsp;&nbsp;&nbsp;Israël &nbsp;&nbsp;&nbsp;Turquie &nbsp;&nbsp;&nbsp;Maroc &nbsp;&nbsp;&nbsp;République Islamique D’Iran</b></span></div><div>Pour les pays tels que le Maroc et la Tunisie merci de nous contacter au 04.67.36.72.01 ou 06.08.23.04.79</div><div><br></div><div><i><span class=\"cf2\"><b>Les pays suivants sont couverts par notre Contrat Assurance Auto Temporaire </b></span></i></div><div>Nous accordons la garantie Responsabilité Civile pour l’assurance auto temporaire en France métropolitaine, dans les autres pays de l’Union européenne, en Suisse, dans les états du Vatican, Saint-Marin, Monaco, Andorre et le Liechtenstein ainsi que dans la liste des pays ci dessous :</div><div>Allemagne &nbsp;&nbsp;Autriche &nbsp;&nbsp;Belgique &nbsp;&nbsp;Bulgarie &nbsp;&nbsp;Chypre &nbsp;&nbsp;Croatie &nbsp;&nbsp;Danemark &nbsp;&nbsp;<span class=\"fs11\">Espagne &nbsp;&nbsp;Estonie &nbsp;&nbsp;Finlande &nbsp;&nbsp;France &nbsp;&nbsp;&nbsp;Grèce &nbsp;&nbsp;&nbsp;Hongrie &nbsp;&nbsp;&nbsp;Irlande &nbsp;&nbsp;</span><span class=\"fs11\">Italie &nbsp;&nbsp;Lettonie &nbsp;&nbsp;Lituanie &nbsp;&nbsp;Luxembourg &nbsp;&nbsp;Malte &nbsp;&nbsp;Pays-Bas &nbsp;&nbsp;Pologne </span><span class=\"fs11\"> &nbsp;Portugal &nbsp;&nbsp;République Tchèque &nbsp;&nbsp;Roumanie &nbsp;&nbsp;Royaume-Uni &nbsp;&nbsp;Slovaquie &nbsp;&nbsp;Slovénie &nbsp;&nbsp;Suède</span></div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504084380,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_ifg9f26r\"><div><b>La Responsabilité Civile Obligatoire</b></div><div><br></div><div>Un véhicule doit être assuré, au moins avec une assurance responsabilité civile (appelée parfois assurance au tiers).</div><div><br></div><div>Cela couvre uniquement les dommages que ce véhicule peut occasionner à autrui (blessure d'un piéton ou dégât causé à un véhicule).</div><div><br></div><div>Nous proposons aussi l'Assistance au véhicule.</div><div><br></div><div>Si vous souhaitez les garanties Défense et recours merci de nous appeler au 04.67.36.72.01 ou par mail laetitia@jlassure.com</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504083840,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_om68cr07\"><div>La plupart des sites Internet qui proposent de l’assurance vous donne un tarif immédiatement en ligne mais très peu permettent de souscrire en ligne. Vous devez contacter un conseiller par téléphone et lui communiquer les coordonnées de votre carte bancaire pour souscrire votre contrat d’assurance en ligne.</div><div><br></div><div>Aujourd’hui les internautes &nbsp;souhaitent communiquer avec un conseiller pour obtenir des renseignement ou une aide à l’etablissement de leur devis mais ne souhaitent pas communiquer par téléphone leurs coordonnées de carte bancaire.</div><div><br></div><div><img class=\"image-0 fleft\" src=\"../images/Paiement_Securise.jpg\"  width=\"141\" height=\"107\" /></div><div><br></div><div><span class=\"fs11\">Grâce à la mise en place du paiement sécurisé par CB, vous pouvez souscrire en toute sécurité et obtenir rapidement votre garantie en ligne sur l'ensemble de nos sites partenaires.</span><br></div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504083480,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_io7avank\"><div>Le constat à l’amiable est le document officiel à remplir sur les lieux de l’accident et à envoyer à votre assurance auto sous 5 jours. Il permet de déterminer les causes de l’accident et les responsabilités de chacun des conducteurs. Il peut sembler laborieux mais permet à votre assureur auto de traiter votre dossier plus rapidement.</div><div><br></div><div>Dans le meilleur des cas, les automobilistes remplissent le constat à l’amiable et le signent sans aucune objection.</div><div><br></div><div>Il peut arriver que vous ne soyez pas d’accord avec l’autre automobiliste sur les circonstances de l’accident. Un constat signé est un document difficile à contester ultérieurement. S’il y a complication lors de l'établissement du constat, ne signez rien. Préférez envoyer votre propre déclaration officielle des faits à votre assureur plus tard.</div><div><br></div><div>Si l’autre automobiliste refuse de remplir le constat à l’amiable, relevez son numéro de plaque d’immatriculation, reportez-le dans la case « observation » en précisant sa contestation.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504083120,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_xfes2m0j\"><div>Depuis la loi du 27 février 1958, l’assurance responsabilité civile incluse dans tout contrat d’assurance auto est obligatoire. Cette garantie sert à couvrir des dommages corporels et/ou matériels causés par votre voiture lors d’un accident et ce, quelle qu’en soit la victime (passagers ou piétons, autre auto…).</div><div><br></div><div>Cependant, cette couverture ne s’applique ni au conducteur qui, s’il veut être assuré, devra souscrire une garantie « individuelle conducteur », ni à la voiture elle-même.</div><div><br></div><div>D’autres facteurs excluent l’applicabilité de cette garantie : les mauvaises conditions de sécurité (l’absence de ceinture de sécurité par exemple), la nature des dommages ou encore le fait que les passagers aient payé le transport.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504082700,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_a167lwmy\"><div><span class=\"fs11\">- Oui votre paiement passe par le système \"CM-CIC p@iement\". </span></div><div><span class=\"fs11\">Lors d'un achat sur internet équipé de CM-CIC p@iement, l'ensemble de la transaction s'effectue sur leur site bancaire en mode crypté. </span></div><div><span class=\"fs11\">Vous quittez </span><span class=\"fs11\">temporairement notre site commerçant en toute transparence pour enregistrer vos coordonnées bancaires et ceci est la garantie que :</span></div><div><br></div><div><ul><li><span class=\"fs11\">Nous ne connaîtrons jamais votre numéro de carte,</span><br></li><li><span class=\"fs11\">CM-CIC p@iement ne pourra rien savoir du détail de vos achats puisque seul le montant total et le numéro de commande lui est retransmis.</span><br></li></ul></div><div><br></div><div>Quelle sécurités utilise CM-CIC p@iement ?</div><div><br></div><div> &nbsp;&nbsp;&nbsp;- CM-CIC p@iement utilise le système normalisé de cryptage appelé \"le protocole SSL\". Il se concrétise, lorsque vous êtes sur la page de paiement, par :</div><div><br></div><div><ul><li><span class=\"fs11\">Un pictogramme dans un coin de votre navigateur : l'un de ces signes doit être présent. &nbsp;&nbsp;logos de cadenas .Le cadenas doit être fermé.</span><br></li><li><span class=\"fs11\">Dans la barre d'adresse de votre navigateur, le navigateur est en mode \" https://\" au lieu de \"http://\".</span><br></li><li><span class=\"fs11\">Lorsque vous passez de mode non-crypté en mode crypté (et inversement), les navigateurs affichent un message vous prévenant du changement.</span><br></li></ul></div><div><br></div><div>Vérifiez ces éléments avant la saisie de données confidentielles, c'est un gage de sécurité. Afin d'utiliser les protocoles les plus puissants, nous vous recommandons l'usage d'un navigateur de dernière version.</div><div><br></div><div>Quelles sont les informations nécessaires pour utiliser CM-CIC p@iement ?</div><div><br></div><div> &nbsp;&nbsp;&nbsp;-Sur notre site via CM-CIC p@iement, votre banque vous demandera :</div><div><br></div><div><ul><li><span class=\"fs11\">le numéro de carte bancaire ou de carte privative (numéros à 15 ou 16 chiffres)</span><br></li><li><span class=\"fs11\">la date d'expiration</span><br></li><li><span class=\"fs11\">le cryptogramme visuel (3 ou 4 derniers chiffres sur la bande de signature de votre carte)</span><br></li></ul></div><div><br></div><div>Avec le déploiement du 3D Secure (reconnaissable avec les logos \"Verifed By Visa\" ou \"MasterCard SecureCode\") votre banque vous demandera également lors du paiement de vous authentifier par une information confidentielle à saisir sur une page internet de votre propre banque.</div><div><br></div><div><br></div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504082280,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_o5wx88sl\"><div><ul><li><span class=\"fs11\">On vous prête un véhicule,</span><br></li><li><span class=\"fs11\">Vous venez d'acheter un nouveau véhicule,</span><br></li><li><span class=\"fs11\">Vous venez de vendre votre véhicule,</span><br></li><li><span class=\"fs11\">Car vous avez été résilié pour non paiement de prime,</span><br></li><li><span class=\"fs11\">vous faîtes de l'import-export ou du transit,</span><br></li><li><span class=\"fs11\">Vous venez d'acheter aux enchères,</span><br></li><li><span class=\"fs11\">Car un membre de votre famille vient vous rendre visite, et il a un permis hors union européenne avec </span><span class=\"fs11\">un véhicule en plaque hors union européenne (par ex : permis algérien + plaques algériennes),</span></li><li><span class=\"fs11\">Vous importez un véhicule d'Italie avec targa di cartone</span><br></li><li><span class=\"fs11\">Vous devez récupérer votre véhicule qui a été mis en fourrière pour défaut d'assurance</span><br></li><li><span class=\"fs11\">Et bien d'autres raisons encore, n'hésitez pas à nous questionner au 04.67.36.72.01 </span><span class=\"fs11\">ou par mail laetitia@jlassure.com</span></li></ul></div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504081140,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_4tm0vbfa\"><div>Oui, par exemple avec un permis algérien + immatriculation algérienne vous aurez la possibilité de souscrire un contrat d'assurance provisoire de 15 ou 30 jours.</div><div>Ces garanties sont des Assurances Frontières.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504080840,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_kyrkj9ah\"><div>Non, car un contrat d' assurance temporaire est un contrat sans tacite recondution.</div><div><br></div><div>Le contrat auto temporaire se termine automatiquement à la fin de la période pour laquelle il a été souscrit.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504080720,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_deqiqqcm\"><div>Oui, vous pouvez souscrire un contrat auto temporaire avec une carte grise barrée</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504080360,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_d1m9eirp\"><div>Oui, vous pouvez faire un contrat d'assurance de courte durée même si la carte grise n'est pas à votre nom </div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504080300,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_76sy9ovz\"><div>Oui, vous pouvez soucrire une assurance auto temporaire à n'importe quel moment.</div><div><br></div><div><b>Les Garanties seront délivrées du lundi au dimanche inclus entre 9h00 et 23h00.</b></div><div><br></div><div><span class=\"imUl\">En cas de problème 04.67.36.72.01</span> ou 06.08.23.04.79 de 09h00 à 23h00.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504079580,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_ppezxr8o\"><div>Oui, vous pouvez assurer votre véhicule avec un permis étranger à partir du moment où celui-ci est en cours de validité sur le territoire français pendant la durée de la garantie auto tempo.</div><div><br></div><div>En ce qui concerne les permis de conduire obtenu hors union européenne, il doit être rédigé en Français ou accompagné d'une traduction officielle en français ou accompagné du permis de conduire international en cours de validité.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504078680,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_nkrjfkr4\"><div><ol><li><span class=\"fs11\">A partir du moment où votre garantie a pris effet, il vous sera impossible d'annuler la garantie auto tempo (sauf cas exceptionel à nous soumettre par téléphone au 04.67.36.72.01 ou 06.08.23.04.79),</span><span class=\"fs11\">par conséquent aucun remboursement ne sera effectué.</span><br></li><li><span class=\"fs11\">Si votre garantie auto temporaire n'a pas encore pris effet, nous vous invitons à prendre contacte immédiatement avec nos conseillers au 04.67.36.72.01 ou 06.08.23.04.79 ou laetitia@jlassure.com</span><br></li></ol></div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504077600,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_3p46pgxw\"><div>Tout automobiliste, particulier ou professionnel, âgé de 20 à 90 ans, peut opter pour l'assurance auto temporaire dès lors qu'il justifie d'au moins 2 ans de permis de conduire.</div><div><br></div><div>Elle est idéale dans bien des cas, par exemple : pour un conducteur occasionnel, pour un week-end, lors d'un séjour à l'étranger, pendant la durée d'immobilisation d'un véhicule par les forces de l'ordre, pour un véhicule immatriculé en France en transit entre l'Hexagone et un pays étranger...</div><div><br></div><div>L'assurance auto de courte durée s'adresse aux conducteurs qui n'utilisent pas leur voiture de façon régulière.</div><div><br></div><div>Sa durée peut être de 1 à 90 jours. Pour être valable à l'étranger, la durée de cette assurance provisoire doit être supérieure à 3 jours.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504077120,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_q7hbjrbe\"><div>Oui, en vigueur au Code des assurances - Article R211-17 : \"<b>La carte internationale d'assurance, dite \"carte verte</b>\", vaut comme document justificatif pendant sa période de validité.</div><div><br></div><div>Cette attestation doit mentionner :</div><div><br></div><div><ul><li><span class=\"fs11\">la dénomination et l'adresse de l'entreprise d'assurance,</span><br></li><li><span class=\"fs11\">les noms, prénoms et adresse du soucripteur du contrat,</span><br></li><li><span class=\"fs11\">la nature et le type du véhicule,</span><br></li><li><span class=\"fs11\">la période pendant laquelle elle est valable.</span><br></li></ul></div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '30 Août 2017',
	'timestampExt' => 'Mercredi 30 Août 2017',
	'utc_time' => 1504075860,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_kvz1jy7n\"><div>Rien de plus simple ! Roulez assuré en moins de 5 minutes ! </div><div><br></div><div><ol><li><span class=\"fs11\">Sur www.tempo-assurance.com cliquez sur l'onglet \"TARIFS ET SOUSCRIPTION\", </span><span class=\"fs11\">laissez vous guider en suivant les différentes étapes.</span><br></li><li><span class=\"fs11\">Téléchargez permis de conduire + carte grise, payez et imprimez </span><span class=\"fs11\">votre attestation d' assurance auto tempo immédiatement.</span><br></li></ol></div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '24 Août 2017',
	'timestampExt' => 'Jeudi 24 Août 2017',
	'utc_time' => 1503588840,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_5uli40tu\"><div>L’assurance auto temporaire est comme son nom l’indique une assurance de courte durée. Destinée aux conducteurs qui ne souhaitent pas être assurés sur une année entière, l’assurance temporaire s’adresse tout particulièrement aux conducteurs qui n’utilisent que très rarement un véhicule.</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '23 Août 2017',
	'timestampExt' => 'Mercredi 23 Août 2017',
	'utc_time' => 1503472620,
	'month' => '201708',
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
	'body' => "<div id=\"imBlogPost_foadc224\"><div>En moins de 5 minutes, notre conseillère vérifie que :</div><div><ul><li><span class=\"fs11\">vous avez signé en ligne électroniquement les conditions particulières,</span><br></li><li><span class=\"fs11\">vous avez payez,</span><br></li><li><span class=\"fs11\">les pièces (permis de conduire recto verso + carte grise) que vous avez téléchargées </span><span class=\"fs11\">sont conformes à vos déclarations.</span><br></li></ul></div><div><br></div><div>Une fois la vérifiation faite, vous recevez votre attestation d'assurance auto tempo, à télécharger, dans votre boîte mail (pensez à regarder dans vos \"indésirables\")</div><div style=\"clear: both;\"><!-- clear floated images --></div></div>",
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
	'timestamp' => '23 Août 2017',
	'timestampExt' => 'Mercredi 23 Août 2017',
	'utc_time' => 1503472560,
	'month' => '201708',
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