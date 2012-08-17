<?php
/**
 * @version   $Id: AbstractModel.php 53534 2012-06-06 18:21:34Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - ${copyright_year} RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('ROKCOMMON') or die;

class RokCommon_Ajax_AbstractModel implements RokCommon_Ajax_Model
{
	/**
	 * @param  $action
	 * @param  $params
	 *
	 * @throws Exception
	 * @throws RokCommon_Ajax_Exception
	 * @return RokCommon_Ajax_Result
	 */
	public function run($action, $params)
	{

		try {
			$action = (empty($action)) ? 'default' : $action;
			if (!method_exists($this, $action)) {
				throw new RokCommon_Ajax_Exception('The ' . $action . ' action does not exist for this model');
			}
			return $this->$action($params);
		} catch (Exception $e) {
			throw $e;
		}

	}

	/**
	 * @param RokCommon_Ajax_Result $result
	 */
	protected function sendDisconnectingReturn(RokCommon_Ajax_Result $result)
	{
		// clean outside buffers;
		while (@ob_end_clean()) ;
		header("Connection: close\r\n");
		header('Content-type: text/plain');
		session_write_close();
		ignore_user_abort(true);
		ob_start();
		echo json_encode($result);
		$size = ob_get_length();
		header("Content-Length: $size");
		ob_end_flush(); // Strange behaviour, will not work
		flush(); // Unless both are called !
		while (@ob_end_clean()) ;
		if (!ini_get('safe_mode') && strpos(ini_get('disable_functions'), 'set_time_limit') === false) {
			@set_time_limit(0);
		} else {
			error_log('RokGallery: PHP safe_mode is on or the set_time_limit function is disabled.  This can cause timeouts while processing a job if your max_execution_time is not set high enough');
		}
	}
}
