<?php
/**
 * @package    Clarion Template - RocketTheme
 * @version    1.3 July 20, 2012
 * @author     RocketTheme http://www.rockettheme.com
 * @copyright  Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
if (!isset($this->error)) {
	$this->error = JError::raiseWarning( 403, JText::_('ALERTNOTAUTH') );
	$this->debug = false; 
}

// load and inititialize gantry class
require_once('lib/gantry/gantry.php');
$gantry->init();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>

	<title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/libraries/gantry/css/gantry.css" type="text/css" />
  	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/libraries/gantry/css/grid-12.css" type="text/css" />
  	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/libraries/gantry/css/joomla.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/joomla.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/main-<?php $mainstyle = $gantry->get('main-body'); echo $mainstyle; ?>.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/body-<?php $colorstyle = $gantry->get('main-color'); echo $colorstyle; ?>.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/backgrounds.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/fusionmenu.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/splitmenu.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/error.css" type="text/css" />
	<style type="text/css">
		<?php 
			$css = '.readon, #rt-main-container .module-content ul.menu > li:hover > a, #rt-main-container .module-content ul.menu > li:hover > .separator, #rt-main-container .module-content ul.menu > li.active > a, .logo-block #logo-color, #rt-accessibility #rt-buttons a, .rt-article-icons ul li a, .title1 .arrow-box, .box3 .rt-block, body .rg-ss-controls .next:hover, body .rg-ss-controls .prev:hover, .roknewspager-li.active h3, .featuretable .featuretable-col.highlight, .featuretable .featuretable-col.highlight .featuretable-head, .featuretable-col.highlight .featuretable-cell.bg, .roktabs-wrapper .arrow-next, .roktabs-wrapper .arrow-prev,.rokminievents-wrapper .timeline .progress .knob, #gantry-totop:hover, .rokgallery-wrapper .rg-gm-slice:before, body .rg-ss-progress {background-color:'.$gantry->get('main-accent').';}'."\n";
			$css .= '.roknewspager-li.active h3, .readon {border: 1px solid '.$gantry->get('main-accent').';}'."\n";
		        $css .= 'a, .menutop a:hover, .menu a:hover, .menutop li.active a, .menu li.active a, .menutop ul li > .item:hover, .menutop li.f-menuparent-itemfocus > .item, .menutop ul li.active > .item, .menutop li.active.f-menuparent-itemfocus > .item, .menu li:hover .nolink, .module-content ul.menu li.parent li a:hover span, .module-content ul.menu li.parent li .item:hover span, .module-content ul.menu li.parent li .separator:hover span, .module-content ul.menu li.parent li.active > a > span, .module-content ul.menu li.parent li.active > .item > span, .module-content ul.menu li.parent li.active > .separator > span, .module-title .title span, .article-header .title span, .roktabs ul li.active, .featuretable .featuretable-head, #roktwittie .status .header .name, .rokminievents-badge .day, .rokminievents-title, .rokminievents-title-nolink, .timeline-dates.date-inline .active, .rg-grid-view .item-title, .rg-list-view .item-title,.rg-detail-item-title, .error-title span {color:'.$gantry->get('main-accent').';}'."\n";
		        $css .= 'body .rg-ss-slice-container {border-top: 5px solid '.$gantry->get('main-accent').';}'."\n";
		        $css .= 'p.dropcap6:first-letter, p.dropcap7:first-letter, em.highlight {background:'.$gantry->get('main-accent').';}'."\n";
		    $css .= 'body ul.checkmark li:after, body ul.circle-checkmark li:before, body ul.square-checkmark li:before, body ul.circle-small li:after, body ul.circle li:after, body ul.circle-large li:after {border-color:'.$gantry->get('main-accent').';}'."\n";
		    $css .= 'body ul.triangle-small li:after, body ul.triangle li:after, body ul.triangle-large li:after {border-color: transparent transparent transparent '.$gantry->get('main-accent').';}'."\n";
		    echo $css;
		?>
	</style>

</head>
<body <?php echo $gantry->displayBodyTag(); ?>>
	<div class="rt-container">
			<div id="rt-container-bg">
				<div id="rt-container-bg2">
	<div id="rt-top-surround"><div id="rt-top-surround2">
		<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
		<div id="rt-header">
			<div class="rt-container">
				<?php echo $gantry->displayModules('header','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Header **/ endif; ?>
	</div></div>
	<div id="rt-navigation">
		<div class="rt-container">
			<div class="rt-block menu-block">
				<div class="rt-block logo-block">
			<?php if ($gantry->get('logo-centered') == '1'): ?>
			<div class="centered">
			<?php endif; ?>
    	    	<a href="<?php echo $gantry->baseUrl; ?>" id="rt-logo"><span id="logo-color"></span><span id="logo-inner"></span></a>
			<?php if ($gantry->get('logo-centered') == '1'): ?>
			</div>
			<?php endif; ?>
		</div>
				<div class="rt-fusionmenu">
					<div class="nopill">
						<div class="rt-menubar">
	    					<ul class="menutop level1">
	                        	<li class="item1 active root">
	            				    <a class="orphan item bullet active-to-top" href="<?php echo $gantry->baseUrl; ?>"  >
	                    				<span>
	                                        &larr; Home
	                                    </span>
	                    				<span class="item-border"></span>
	                				</a>
	                    		</li>
	                    	</ul>
	                    </div>
	                </div>
	            </div>
        	</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="rt-error-body">
		<div id="rt-main-container">
			<div id="rt-body-surround" class="component-block component-content">
				<div class="rt-error-box">
					<h2>Error:</h2>
					<h1 class="error-title title"><span><?php echo $this->error->getCode(); ?></span> - <?php echo $this->error->getMessage(); ?></h1>
					<p><strong>You may not be able to visit this page because of:</strong></p>
					<ol>
						<li>an out-of-date bookmark/favourite</li>
						<li>a search engine that has an out-of-date listing for this site</li>
						<li>a mistyped address</li>
						<li>you have no access to this page</li>
						<li>The requested resource was not found.</li>
						<li>An error has occurred while processing your request.</li>
					</ol>
					<p></p>
					<p><a href="<?php echo $gantry->baseUrl; ?>" class="readon"><span>Home</span></a></p>
				</div>
			</div>
		</div>
	</div>
</div></div></div>
<?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
<div id="rt-copyright">
	<div class="rt-container">
		<?php echo $gantry->displayModules('copyright','standard','standard'); ?>
		<div class="clear"></div>
	</div>
</div>
<?php /** End Copyright **/ endif; ?>
</body>
</html>
<?php
$gantry->finalize();
?>