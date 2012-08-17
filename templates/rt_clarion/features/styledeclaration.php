<?php
/**
 * @package    Clarion Template - RocketTheme
 * @version    1.3 July 20, 2012
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright  Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureStyleDeclaration extends GantryFeature {
    var $_feature_name = 'styledeclaration';

    function isEnabled() {
        global $gantry;
        $menu_enabled = $this->get('enabled');

        if (1 == (int)$menu_enabled) return true;
        return false;
    }
    
function init() {
        global $gantry;
		$browser = $gantry->browser;

		// COLORCHOOSER

        // Color Accent
    $css = '.readon, #rt-main-container .module-content ul.menu > li:hover > a, #rt-main-container .module-content ul.menu > li:hover > .separator, #rt-main-container .module-content ul.menu > li.active > a, .logo-block #logo-color, #rt-accessibility #rt-buttons a, .rt-article-icons ul li a, .title1 .arrow-box, .box3 .rt-block, body .rg-ss-controls .next:hover, body .rg-ss-controls .prev:hover, .roknewspager-li.active h3, .featuretable .featuretable-col.highlight, .featuretable .featuretable-col.highlight .featuretable-head, .featuretable-col.highlight .featuretable-cell.bg, .roktabs-wrapper .arrow-next, .roktabs-wrapper .arrow-prev,.rokminievents-wrapper .timeline .progress .knob, #gantry-totop:hover, .rokgallery-wrapper .rg-gm-slice:before, body .rg-ss-progress {background-color:'.$gantry->get('main-accent').';}'."\n";
	$css .= '.roknewspager-li.active h3, .readon {border: 1px solid '.$gantry->get('main-accent').';}'."\n";
        $css .= 'a, .menutop a:hover, .menu a:hover, .menutop li.active a, .menu li.active a, .menutop ul li > .item:hover, .menutop li.f-menuparent-itemfocus > .item, .menutop ul li.active > .item, .menutop li.active.f-menuparent-itemfocus > .item, .menu li:hover .nolink, .module-content ul.menu li.parent li a:hover span, .module-content ul.menu li.parent li .item:hover span, .module-content ul.menu li.parent li .separator:hover span, .module-content ul.menu li.parent li.active.current > a > span, .module-content ul.menu li.parent li.active.current > .item > span, .module-content ul.menu li.parent li.active.current > .separator > span, .module-content ul.menu li.parent li#current.active > a > span, .module-content ul.menu li.parent li#current.active > .item > span, .module-content ul.menu li.parent li#current.active > .separator > span, .module-title .title span, .article-header .title span, .roktabs ul li.active, .featuretable .featuretable-head, #roktwittie .status .header .name, .rokminievents-badge .day, .rokminievents-title, .rokminievents-title-nolink, .timeline-dates.date-inline .active, .rg-grid-view .item-title, .rg-list-view .item-title,.rg-detail-item-title  {color:'.$gantry->get('main-accent').';}'."\n";
        $css .= 'body .rg-ss-slice-container {border-top: 5px solid '.$gantry->get('main-accent').';}'."\n";
    $css .= 'body .rg-ss-caption {background-color:'.$this->_RGBA($gantry->get('main-accent'), '0.5').';}'."\n";
        $css .= 'p.dropcap6:first-letter, p.dropcap7:first-letter, em.highlight {background:'.$gantry->get('main-accent').';}'."\n";
    $css .= 'body ul.checkmark li:after, body ul.circle-checkmark li:before, body ul.square-checkmark li:before, body ul.circle-small li:after, body ul.circle li:after, body ul.circle-large li:after {border-color:'.$gantry->get('main-accent').';}'."\n";
    $css .= 'body ul.triangle-small li:after, body ul.triangle li:after, body ul.triangle-large li:after {border-color: transparent transparent transparent '.$gantry->get('main-accent').';}'."\n";
	
	// K2
    $css .= '#k2Container .catItemReadMore, #k2Container .moduleItemReadMore, #k2Container .userItemReadMore, #k2Container .tagItemReadMore,#k2Container .genericItemReadMore, #k2Container .latestItemReadMore,#k2Container .k2TagCloudBlock a:hover, div.k2ItemsBlock ul li div.moduleItemTags a:hover, div.itemTagsBlock ul.itemTags li:hover, div.userItemTagsBlock ul.userItemTags li:hover, div.latestItemTagsBlock ul.latestItemTags li:hover, .k2UserBlock .button, .k2CalendarBlock table.calendar tr td.calendarToday, div.itemToolbar ul li a#fontDecrease img, div.itemToolbar ul li a#fontIncrease img  {background-color:'.$gantry->get('main-accent').';}'."\n";
    $css .= '#k2Container span.itemHits {color:'.$gantry->get('main-accent').';}'."\n";
    $css .= 'div.k2TagCloudBlock a:hover,div.catItemTagsBlock ul.catItemTags li:hover, #k2Container .button, span.catItemAddLink, span.userItemAddLink {background-color:'.$gantry->get('main-accent').' !important;}'."\n";

		// Static file
        if ($gantry->get('static-enabled')) {
            // do file stuff
            jimport('joomla.filesystem.file');
            $filename = $gantry->templatePath.DS.'css'.DS.'static-styles.css';

            if (file_exists($filename)) {
                if ($gantry->get('static-check')) {
                    //check to see if it's outdated

                    $md5_static = md5_file($filename);
                    $md5_inline = md5($css);

                    if ($md5_static != $md5_inline) {
                        JFile::write($filename, $css);
                    }
                }
            } else {
                // file missing, save it
                JFile::write($filename, $css);
            }
            // add reference to static file
            $gantry->addStyle('static-styles.css',99);

        } else {
            // add inline style
            $gantry->addInlineStyle($css);
        }

		$this->_disableRokBoxForiPhone();

		// Style Inclusion
		$mainstyle = $gantry->get('main-body');
        $gantry->addStyle('main-'.$mainstyle.".css");
        $gantry->addStyle('backgrounds.css');
		$colorstyle = $gantry->get('main-color');
        $gantry->addStyle($colorstyle.".css");
		if ($gantry->get('typography-enabled')) $gantry->addStyle('typography.css');
		if ($gantry->get('extensions')) $gantry->addStyle('extensions.css');
		if ($gantry->get('extensions')) $gantry->addStyle('extensions-overlays.css');
		if ($gantry->get('extensions')) $gantry->addStyle('extensions-'.$mainstyle.'.css');
		
	//third party
        if ($gantry->get('k2')) $gantry->addStyle('thirdparty-k2.css');
        if ($gantry->get('k2')) $gantry->addStyle('thirdparty-k2-'.$mainstyle.'.css');

	}

    function _HEX2RGB($hexStr, $returnAsString = false, $seperator = ','){
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
        $rgbArray = array();
    
        if (strlen($hexStr) == 6){
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
        } elseif (strlen($hexStr) == 3){
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            return false;
        }
    
        return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
    }
    
    function _RGBA($hex, $opacity){
        return 'rgba(' . $this->_HEX2RGB($hex, true) . ','.$opacity.')';
    }

	function _disableRokBoxForiPhone() {
		global $gantry;

		if ($gantry->browser->platform == 'iphone' || $gantry->browser->platform == 'android') {
			$gantry->addInlineScript("window.addEvent('domready', function() {\$\$('a[rel^=rokbox]').removeEvents('click');});");
		}
	}

}