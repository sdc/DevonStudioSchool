<?php
/**
 * @version   $Id: date.php 2381 2012-08-15 04:14:26Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');
/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureDate extends GantryFeature
{
	var $_feature_name = 'date';

	function render($position)
	{
		/** @var $gantry Gantry */
		global $gantry;
		ob_start();

		$now    = JFactory::getDate();
		$format = $this->get('formats');

		?>
	<div class="date-block">
		<span class="date"><?php echo $now->toFormat($format); ?></span>
	</div>
	<?php
		return ob_get_clean();
	}

}