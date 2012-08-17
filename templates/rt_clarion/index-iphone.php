<?php
/**
 * @package    Clarion Template - RocketTheme
 * @version    1.3 July 20, 2012
 * @author	   RocketTheme http://www.rockettheme.com
 * @copyright  Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license	   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined( 'GANTRY_VERSION' ) or die( 'Restricted index access' );
global $gantry;
$gantry->set('fixedheader', 0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
    <head>
        <?php
            $gantry->displayHead();
            $gantry->addStyles(array('template.css','joomla.css','iphone-gantry.css'));
			$gantry->addScript('iscroll.js');

            $gantry->addScript('roktabs.js');
			$hidden = '';
        ?>
			<?php
				$scalable = $gantry->get('iphone-scalable', 0) == "0" ? "0" : "1";
			?>
			<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=<?php echo $scalable; ?>;">

			<script type="text/javascript">
				var orient = function() {
					var dir = "rt-normal";
					switch(window.orientation) {
						case 0: dir = "rt-normal";break;
						case -90: dir = "rt-right";break;
						case 90: dir = "rt-left";break;
						case 180: dir = "rt-flipped";break;
					}
					$$(document.body, '#rt-wrapper')
						.removeClass('rt-normal')
						.removeClass('rt-left')
						.removeClass('rt-right')
						.removeClass('rt-flipped')
						.addClass(dir);
				}

				window.addEvent('domready', function() {
					orient();
					window.scrollTo(0, 1);
					new iScroll($$('#rt-menu ul.menu')[0]);
				});

			</script>
    </head>
    <body <?php echo $gantry->displayBodyTag(); ?> onorientationchange="orient()">
		<?php /** Begin Drawer **/ if ($gantry->countModules('mobile-drawer')) : ?>
		<div id="rt-drawer">
			<div class="rt-container">
				<?php echo $gantry->displayModules('mobile-drawer','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Drawer **/ endif; ?>
		<div id="rt-top">
			<div class="rt-container">
				<div id="rt-top2">
					<?php echo $gantry->displayModules('mobile-top','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div id="rt-transition"<?php echo $hidden; ?>>
			<div id="rt-container">
				<div id="rt-container-bg">
					<div id="rt-container-bg2">
						<?php /** Begin Header **/ if ($gantry->countModules('mobile-header')) : ?>
						<div id="rt-header">
							<div class="rt-container">
								<?php echo $gantry->displayModules('mobile-header','standard','standard'); ?>
								<div class="clear"></div>
							</div>
						</div>
						<?php /** End Header **/ endif; ?>
						<?php /** Begin Menu **/ if ($gantry->countModules('mobile-navigation')) : ?>
						<div id="rt-menu">
							<div id="rt-left-menu"></div>
							<div id="rt-right-menu"></div>
							<?php echo $gantry->displayModules('mobile-navigation','basic','basic'); ?>
							<div class="clear"></div>
						</div>
						<?php /** End Menu **/ endif; ?>
						<?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
						<div id="rt-showcase">
							<div class="rt-container">
								<?php echo $gantry->displayModules('mobile-showcase','standard','standard'); ?>
								<div class="clear"></div>
							</div>
						</div>
						<?php /** End Showcase **/ endif; ?>
						<?php /** Begin Feature **/ if ($gantry->countModules('mobile-feature')) : ?>
						<div id="rt-feature">
							<div class="rt-container">
								<?php echo $gantry->displayModules('mobile-feature','standard','standard'); ?>
								<div class="clear"></div>
							</div>
						</div>
						<?php /** End Feature **/ endif; ?>
						<div id="rt-body-surround">
							<div class="rt-container">
								<?php /** Begin Utility **/ if ($gantry->countModules('mobile-utility')) : ?>
								<div id="rt-utility">
									<?php echo $gantry->displayModules('mobile-utility','standard','standard'); ?>
									<div class="clear"></div>
								</div>
								<?php /** End Utility **/ endif; ?>
								<?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
								<div id="rt-breadcrumbs">
									<?php echo $gantry->displayModules('breadcrumb','basic','breadcrumbs'); ?>
									<div class="clear"></div>
								</div>
								<?php /** End Breadcrumbs **/ endif; ?>
								<?php /** Begin Main Body **/
									$display_mainbody = !($gantry->get("mainbody-enabled",true)==false && JRequest::getVar('view') == 'frontpage');
								?>

								<?php if ($display_mainbody): ?>
								<div class="component-content"><div class="rt-block component-block">
								<?php echo $gantry->displayMainbody('iphonemainbody','sidebar','standard','standard','standard','standard','standard'); ?>
								</div></div>
								<?php endif; ?>
								<?php /** End Main Body **/ ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php /** Begin Footer Section **/ if ($gantry->countModules('mobile-bottom') or $gantry->countModules('mobile-footer') or $gantry->countModules('mobile-copyright')) : ?>
		<div id="rt-footer-surround">
			<div class="rt-container">
				<?php /** Begin Bottom **/ if ($gantry->countModules('mobile-bottom')) : ?>
				<div id="rt-bottom">
					<?php echo $gantry->displayModules('mobile-bottom','standard','standard'); ?>
					<div class="clear"></div>
				</div>
				<?php /** End Bottom **/ endif; ?>
				<?php /** Begin Footer **/ if ($gantry->countModules('mobile-footer')) : ?>
				<div id="rt-footer">
					<?php echo $gantry->displayModules('mobile-footer','standard','standard'); ?>
					<div class="clear"></div>
				</div>
				<?php /** End Footer **/ endif; ?>
			</div>
		</div>
		<?php /** Begin Copyright **/ if ($gantry->countModules('mobile-copyright')) : ?>
		<div id="rt-copyright">
			<div class="rt-container">
				<?php echo $gantry->displayModules('mobile-copyright','standard','limited'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Copyright **/ endif; ?>
		<?php /** End Footer Section **/ endif; ?>
		<?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
		<div id="rt-debug">
			<div class="rt-container">
				<?php echo $gantry->displayModules('debug','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Debug **/ endif; ?>
		<?php /** Begin Analytics **/ if ($gantry->countModules('analytics')) : ?>
		<?php echo $gantry->displayModules('analytics','basic','basic'); ?>
		<?php /** End Analytics **/ endif; ?>
	</body>
</html>
