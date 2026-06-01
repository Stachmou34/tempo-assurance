<?php require_once("../res/x5engine.php"); ?>
<?php
$blog = new imBlog();
$data = $blog->parseUrlArray(@$_GET);
if (!$data['valid']) {
	header('Location: index.php', true, 302);
}
?>
<!DOCTYPE html><!-- HTML5 -->
<html prefix="og: http://ogp.me/ns#" lang="fr-FR" dir="ltr">
	<head>
		<title><?php echo $blog->pageTitle('Questions Assurance Temporaire - Tempo-assurance', ' - '); ?></title>
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv="ImageToolbar" content="False" /><![endif]-->
		<meta name="author" content="Australdev" />
		<meta name="description" content="<?php 
   $urlData = $blog->parseUrlArray(@$_GET); 
   if ( 
      ( array_key_exists('slug', $urlData) || array_key_exists('id', $urlData) ) && 
      strlen(trim($blog->pageDescription())) <= 0 
   ) { 
      echo 'Toutes les informations et questions posées sur l\'assurance tempo se trouvent dans cette rubrique. Ce blog , point  de réponse aux questions sur la temporaire .'; 
   } else { 
      echo $blog->pageDescription(); 
   } 
?>" />
		<meta name="keywords" content="<?php 
   $urlData = $blog->parseUrlArray(@$_GET); 
   if ( 
      ( array_key_exists('slug', $urlData) || array_key_exists('id', $urlData) ) && 
      strlen(trim($blog->pageKeywords())) <= 0 
   ) { 
      echo ''; 
   } else { 
      echo $blog->pageKeywords(); 
   } 
?>" />
		<meta property="og:locale" content="fr_FR" />
<?php if (isset($data['id'])) { echo $blog->getOpengraphTags($data['id'], "\t\t"); } ?>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="stylesheet" href="../style/reset.css?2026-1-9-0" media="screen,print" />
		<link rel="stylesheet" href="../style/print.css?2026-1-9-0" media="print" />
		<link rel="stylesheet" href="../style/style.css?2026-1-9-0" media="screen,print" />
		<link rel="stylesheet" href="../style/template.css?2026-1-9-0" media="screen" />
		<link rel="stylesheet" href="../pluginAppObj/imHeader_pluginAppObj_03/custom.css" media="screen, print" />
		<link rel="stylesheet" href="../pluginAppObj/imFooter_pluginAppObj_04/custom.css" media="screen, print" />
		<link rel="stylesheet" href="../blog/style.css?2026-1-9-0-639154049299430406" media="screen,print" />
		<script src="../res/jquery.js?2026-1-9-0"></script>
		<script src="../res/x5engine.js?2026-1-9-0" data-files-version="2026-1-9-0"></script>		<script src="../res/x5engine.elements.js?2026-1-9-0"></script>
		<script src="../res/swiper-bundle.min.js?2026-1-9-0"></script>
		<link rel="stylesheet" href="../res/swiper-bundle.min.css?2026-1-9-0" />
		<script src="../res/handlebars-min.js?2026-1-9-0"></script>
		<script src="../res/card-blog.js?2026-1-9-0"></script>
		<script src="../blog/x5blog.js?2026-1-9-0"></script>
		<script src="../pluginAppObj/imHeader_pluginAppObj_03/main.js"></script>
		<script src="../pluginAppObj/imFooter_pluginAppObj_04/main.js"></script>
		<script>
			window.onload = function(){ checkBrowserCompatibility('Le Navigateur que vous utilisez ne prend pas en charge les fonctions requises pour afficher ce site.','Le Navigateur que vous utilisez est susceptible de ne pas prendre en charge les fonctions requises pour afficher ce site.','[1]Mettez à jour votre navigateur[/1] ou bien [2]continuez[/2].','http://outdatedbrowser.com/'); };
			x5engine.settings.currentPath = '../';
			x5engine.utils.currentPagePath = 'blog/index.php';
			x5engine.boot.push(function () { x5engine.imPageToTop.initializeButton({}); });
		</script>
		<?php
$blogBaseUrl = $imSettings['general']['url'] . 'blog/';
$urlData = $blog->parseUrlArray(@$_GET);
$numPosts = $blog->getPostsCount();
$pagStart = array_key_exists("start", $urlData) ? $urlData['start'] : 0;
$pagLength = $imSettings['blog']['home_posts_number'];
$isPostPage = false;
if (array_key_exists('slug', $urlData)) {
	$isPostPage = true;
	$href = $blogBaseUrl . '?' . $urlData['slug'];
}
else if (array_key_exists('id', $urlData)) {
	$isPostPage = true;
	$href = $blogBaseUrl . $blog->getSlugUrl($urlData['id']);
}
else if (array_key_exists('category', $urlData)) {
	$category = $blog->getUnescapedCategory($urlData['category']);
	if ($category !== NULL) {
		$href = $blogBaseUrl . '?category=' . urlencode(str_replace(' ', '_', $category));
	}
}
else if (array_key_exists('author', $urlData)) {
	$author = $blog->getUnescapedAuthor($urlData['author']);
	if ($author !== NULL) {
		$href = $blogBaseUrl . '?author=' . urlencode(str_replace(' ', '_', $author));
	}
}
else if (array_key_exists('tag', $urlData)) {
	$href = $blogBaseUrl . '?tag=' . urlencode($urlData['tag']);
}
else if (array_key_exists('month', $urlData)) {
	$href = $blogBaseUrl . '?month=' . urlencode($urlData['month']);
}
else {
	$href = $blogBaseUrl;
}
if ($isPostPage || $pagStart == 0) {
	echo '<link rel="canonical" href="'. $href. '"/>' . PHP_EOL;
}
if (!$isPostPage && $numPosts > $pagLength) {
	if ($pagStart - $pagLength >= 0) {
		$prev = 'start=' . ($pagStart - $pagLength) . '&length=' . $pagLength;
		$prev = ($href == $blogBaseUrl) ? '?' . $prev : '&' . $prev;
		echo '<link rel="prev" href="' . $href . $prev . '"/>' . PHP_EOL;
	}
	if ($pagStart + $pagLength < $numPosts) {
		$next = 'start=' . ($pagStart + $pagLength) . '&length=' . $pagLength;
		$next = ($href == $blogBaseUrl) ? '?' . $next : '&' . $next;
		echo '<link rel="next" href="' . $href . $next . '"/>' . PHP_EOL;
	}
}
$rich_data_string = $blog->getRichDataType();
if (!is_null($rich_data_string)) {
	echo '		<script type="application/ld+json">
' . $rich_data_string . '
		</script>
';
}
?>
	</head>
	<body>
		<div id="imPageExtContainer">
			<div id="imPageIntContainer">
				<span data-nosnippet><a class="screen-reader-only-even-focused" href="#imGoToCont" title="Aller au menu de navigation">Aller au contenu</a></span>
				<div id="imHeaderBg"></div>
				<div id="imPage">
					<header id="imHeader">
						
						<div id="imHeaderObjects"><div id="imHeader_imTableObject_02_wrapper" class="template-object-wrapper"><div id="imHeader_imTableObject_02">
	<div data-index="0"  class="text-tab-content grid-prop current-tab "  id="imHeader_imTableObject_02_tab0" style="opacity: 1; " role="tabpanel" tabindex="0">
		<div class="text-inner">
			<table data-minrequestedwidth="981" data-computedwidth="981" style="width: 981px;"><tbody><tr><td colspan="5" rowspan="1" style="width: 973px; height: 38px; margin-top: 0px; margin-left: 0px; background-color: rgb(58, 92, 170);" class="imVt"><span class="cf1"> </span></td></tr></tbody></table>
		</div>
	</div>

</div>
</div><div id="imHeader_pluginAppObj_03_wrapper" class="template-object-wrapper"><!-- Social Icons v.24 --><div id="imHeader_pluginAppObj_03">
            <div id="soc_imHeader_pluginAppObj_03"  >
                <div class="wrapper horizontal flat shrink">
                	<div class='social-icon flat'><a href='https://www.facebook.com/JLAssure' target='_blank' aria-label='facebook'><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M57,93V54H70.14l2-15H57V29.09c0-4.39.94-7.39,7.24-7.39H72V8.14a98.29,98.29,0,0,0-11.6-.6C48.82,7.54,41,14.61,41,27.59V39H27V54H41V93H57Z"/></svg><span class='fallbacktext'>Fb</span></a></div><div class='social-icon flat'><a href='https://twitter.com/jlassure' target='_blank' aria-label='x'><svg width="100%" height="100%" viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g transform="matrix(0.233139,0,0,0.233139,15.0291,15)"><path d="M178.57,127.15L290.27,0L263.81,0L166.78,110.38L89.34,0L0,0L117.13,166.93L0,300.25L26.46,300.25L128.86,183.66L210.66,300.25L300,300.25M36.01,19.54L76.66,19.54L263.79,281.67L223.13,281.67" style="fill-rule:nonzero;"/></g></svg><span class='fallbacktext'>X</span></a></div>
                </div>

            </div>
                <script>
                    socialicons_imHeader_pluginAppObj_03();
                </script>
        </div></div><div id="imHeader_imMenuObject_04_wrapper" class="template-object-wrapper"><!-- UNSEARCHABLE --><span data-nosnippet><a id="imHeader_imMenuObject_04_skip_menu" href="#imHeader_imMenuObject_04_after_menu" class="screen-reader-only-even-focused">Sauter le menu</a></span><div id="imHeader_imMenuObject_04"><nav id="imHeader_imMenuObject_04_container"><button type="button" class="clear-button-style hamburger-button hamburger-component" aria-label="Afficher le menu"><span class="hamburger-bar"></span><span class="hamburger-bar"></span><span class="hamburger-bar"></span></button><div class="hamburger-menu-background-container hamburger-component">
	<div class="hamburger-menu-background menu-mobile menu-mobile-animated hidden">
		<button type="button" class="clear-button-style hamburger-menu-close-button" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
	</div>
</div>
<ul class="menu-mobile-animated hidden">
	<li class="imMnMnFirst imPage" data-link-paths=",/index.html,/">
<div class="label-wrapper">
<div class="label-inner-wrapper">
		<a class="label" href="../index.html">
Accueil		</a>
</div>
</div>
	</li><li class="imMnMnMiddle imPage" data-link-paths=",/devis-ou-souscription.html">
<div class="label-wrapper">
<div class="label-inner-wrapper">
		<a class="label" href="../devis-ou-souscription.html">
Devis et Souscription		</a>
</div>
</div>
	</li><li class="imMnMnMiddle imPage" data-link-paths=",/mentions-legales.html">
<div class="label-wrapper">
<div class="label-inner-wrapper">
		<a class="label" href="../mentions-legales.html">
Mentions Légales		</a>
</div>
</div>
	</li><li class="imMnMnMiddle imLevel" data-link-paths=",/blog/index.php,/blog/" data-link-hash="-1004219381"><div class="label-wrapper"><div class="label-inner-wrapper"><a href="../blog/index.php" class="label" onclick="return x5engine.utils.location('../blog/index.php', null, false)">FAQ</a></div></div></li><li class="imMnMnLast imPage" data-link-paths=",/contact.html">
<div class="label-wrapper">
<div class="label-inner-wrapper">
		<a class="label" href="../contact.html">
Contact		</a>
</div>
</div>
	</li></ul></nav></div><a id="imHeader_imMenuObject_04_after_menu" class="screen-reader-only-even-focused"></a><!-- UNSEARCHABLE END --><script>
var imHeader_imMenuObject_04_settings = {
	'menuId': 'imHeader_imMenuObject_04',
	'responsiveMenuEffect': 'slide',
	'responsiveMenuLevelOpenEvent': 'mouseover',
	'animationDuration': 1000,
}
x5engine.boot.push(function(){x5engine.initMenu(imHeader_imMenuObject_04_settings)});
$(function () {
    $('#imHeader_imMenuObject_04_container ul li').not('.imMnMnSeparator').each(function () {
        $(this).on('mouseenter', function (evt) {
            if (!evt.originalEvent) {
                evt.stopImmediatePropagation();
                evt.preventDefault();
                return;
            }
        });
    });
});
$(function () {$('#imHeader_imMenuObject_04_container ul li').not('.imMnMnSeparator').each(function () {    var $this = $(this), timeout = 0;    $this.on('mouseenter', function () {        if($(this).parents('#imHeader_imMenuObject_04_container-menu-opened').length > 0) return;         clearTimeout(timeout);        setTimeout(function () { $this.children('ul, .multiple-column').stop(false, false).fadeIn(); }, 250);    }).on('mouseleave', function () {        if($(this).parents('#imHeader_imMenuObject_04_container-menu-opened').length > 0) return;         timeout = setTimeout(function () { $this.children('ul, .multiple-column').stop(false, false).fadeOut(); }, 250);    });});});

</script>
</div><div id="imHeader_imObjectImage_01_wrapper" class="template-object-wrapper"><div id="imHeader_imObjectImage_01"><div id="imHeader_imObjectImage_01_container"><a href="../index.html" onclick="return x5engine.utils.location('../index.html', null, false)"><img src="../images/logo.png" alt="Logo Tempo-assurance.com" title="Logo Tempo-assurance.com" width="290" height="80" />
</a></div></div></div></div>
					</header>
					<div id="imStickyBarContainer">
						<div id="imStickyBarGraphics"></div>
						<div id="imStickyBar">
							<div id="imStickyBarObjects"></div>
						</div>
					</div>
					<div id="imSideBar">
						<div id="imSideBarObjects"></div>
					</div>
					<div id="imContentGraphics"></div>
					<main id="imContent">
						<a id="imGoToCont"></a>
						<div id="imBlogPage" class="<?php echo (isset($data['id']) ? 'imBlogArticle' : 'imBlogHome'); ?>"><<?php echo (isset($data['id']) ? 'article' : 'div'); ?> id="imBlogContent"><?php
						$blog->setCommentsPerPage(10);
						if(isset($data['id']))
							$blog->showPost($data['id'],1);
						else if(isset($data['category']))
							$blog->showCategory($data['category']);
						else if(isset($data['author']))
							$blog->showAuthor($data['author']);
						else if(isset($data['tag']))
							$blog->showTag($data['tag']);
						else if(isset($data['month']))
							$blog->showMonth($data['month']);
						else if(isset($data['search']))
							$blog->showSearch($data['search']);
						else
							$blog->showLast(50);
						?>
						</<?php echo (isset($data['id']) ? 'article' : 'div'); ?>>
						<aside id="imBlogSidebar">
							<span data-nosnippet><a id="imSkipBlock0" href="#imSkipBlock1" class="screen-reader-only-even-focused">Sauter le bloc Catégories</a></span>
							<div class="imBlogBlock" id="imBlogBlock0" >
								<div class="imBlogBlockTitle">Catégories</div>
								<div class="imBlogBlockContent">
						<?php $blog->showBlockCategories(5) ?>
								</div>
							</div>
						</aside>
						<a id="imSkipBlock1" class="screen-reader-only-even-focused"></a>
						<script>
							x5engine.boot.push(function () { 
								window.scrollTo(0, 0);
							});
						</script>
						<script>
							x5engine.boot.push(function () {
								x5engine.blogSidebarScroll({ enabledBreakpoints: ['71b14e2b2a5121661fb7ddae017bdbf6', 'd2f9bff7f63c0d6b7c7d55510409c19b'] });
								var postHeightAtDesktop = 300,
									postWidthAtDesktop = 668;
								if ($('#imBlogPage').hasClass('imBlogArticle')) {
									$('#imPageExtContainer').addClass('imBlogExtArticle');
									var coverResizeTo = null,
										coverWidth = 0;
									x5engine.utils.onElementResize($('.imBlogPostCover')[0], function (rect, target) {
										if (coverWidth == rect.width) {
											return;
										}
										coverWidth = rect.width;
										if (!!coverResizeTo) {
											clearTimeout(coverResizeTo);
										}
										coverResizeTo = setTimeout(function() {
											$('.imBlogPostCover').height(postHeightAtDesktop * coverWidth / postWidthAtDesktop + 'px');
										}, 50);
									});
								}
							});
						</script>
						</div>
						<script>
						   x5engine.boot.push(
						      function(){
						         if ($('#imBlogPage').hasClass('imBlogArticle')) {
						            if ($("meta[name='description']").length > 0) {
						               if ($("meta[name='description']").attr("content").trim().length <= 0) {
						                   $("meta[name='description']").attr("content", "Toutes les informations et questions posées sur l&#39;assurance tempo se trouvent dans cette rubrique. Ce blog , point  de réponse aux questions sur la temporaire ." );
						               }
						            } else {
						               $("meta[name='generator']").after("<meta name=\"description\" content=\"Toutes les informations et questions posées sur l&#39;assurance tempo se trouvent dans cette rubrique. Ce blog , point  de réponse aux questions sur la temporaire .\">");
						            }
						            if ($("meta[name='keywords']").length > 0) {
						               if ($("meta[name='keywords']").attr("content").trim().length <= 0) {
						                  $("meta[name='keywords']").attr("content", "" );
						               }
						            } else {
						               $("meta[name='description']").after("<meta name=\"keywords\" content=\"\">");
						            }
						            $("#imHeader .imHidden").html( $("#imHeader .imHidden").html().replace( "Questions Assurance Temporaire" , "Questions Assurance Temporaire" ) );
						         }
						      }
						   );
						</script>
						
					</main>
					<div id="imFooterBg"></div>
					<footer id="imFooter">
						<div id="imFooterObjects"><div id="imFooter_pluginAppObj_04_wrapper" class="template-object-wrapper"><!-- Social Icons v.24 --><div id="imFooter_pluginAppObj_04"></div></div><div id="imFooter_imTextObject_01_wrapper" class="template-object-wrapper"><div id="imFooter_imTextObject_01">
	<div data-index="0"  class="text-tab-content grid-prop current-tab "  id="imFooter_imTextObject_01_tab0" style="opacity: 1; " role="tabpanel" tabindex="0">
		<div class="text-inner">
			<span class="cf1">Réalisation</span> <span class="cf2"><a href="https://www.australdev.eu" target="_blank" class="imCssLink">AUSTRALDEV</a></span>
		</div>
	</div>

</div>
</div><div id="imFooter_imTextObject_02_wrapper" class="template-object-wrapper"><div id="imFooter_imTextObject_02">
	<div data-index="0"  class="text-tab-content grid-prop current-tab "  id="imFooter_imTextObject_02_tab0" style="opacity: 1; " role="tabpanel" tabindex="0">
		<div class="text-inner">
			<span class="cf1">Tous droits réservés <a href="http://www.jlassure.com" class="imCssLink">JL ASSURE</a></span>
		</div>
	</div>

</div>
</div></div>
					</footer>
				</div>
				<span data-nosnippet class="screen-reader-only-even-focused" style="bottom: 0;"><a href="#imGoToCont" title="Relire le contenu de la page">Retourner au contenu</a></span>
			</div>
		</div>
		
		<noscript class="imNoScript"><div class="alert alert-red">Pour utiliser ce site vous devez activer JavaScript.</div></noscript>
	</body>
</html>
