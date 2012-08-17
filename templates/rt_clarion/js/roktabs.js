/**
 * @version		1.3 July 20, 2012
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

RokTabs = function(){};
window.addEvent('load', function(){
	var wrappers = $$('.roktabs-wrapper'),
		containers = $$('.roktabs-container-wrapper');

	if (wrappers.length && containers.length){
		wrappers.each(function(wrapper, i){
			var container = containers[i],
				tabs = container.getChildren(),
				nav = wrapper.getElement('.roktabs-links'),
				ul = nav.getElement('ul'),
				children = ul.getChildren();

			wrapper.setStyle('width', 'auto');
			tabs.setStyle('display', 'none');
			tabs[0].setStyle('display', 'block');

			var width = 0;
			children.each(function(tab, i){
				width += tab.offsetWidth;
				tab.addEvent('click', function(){
					tabs.setStyle('display', 'none');
					tabs[i].setStyle('display', 'block');
					children.removeClass('active');
					this.addClass('active');
				});
			});
			ul.setStyle('width', width);
			new iScroll(ul);
		});
	}
});
