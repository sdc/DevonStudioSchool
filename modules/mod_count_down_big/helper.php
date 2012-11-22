<?php
/**
 * @Copyright
 *
 * @package	CountDown-Up Big Module for Joomla 2.5
 * @author	Viktor Vogel {@link http://joomla-extensions.kubik-rubik.de/}
 * @version	Version: 2.5-3 - 24-Aug-2012
 * @link	Project Site {@link http://joomla-extensions.kubik-rubik.de/cdub-countdown-up-big}
 *
 * @license GNU/GPL
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');

class mod_count_down_bigHelper
{
    // Calculate countdown or countup
    function countdown($eventup)
    {
        $now = time();
        $difference = $eventup - $now;
        $up = 0;

        // Countup
        if($difference < 0)
        {
            $up = 1;
            $difference = $difference * -1;
        }

        $days_left = floor($difference / 60 / 60 / 24);
        $hours_left = floor(($difference - $days_left * 60 * 60 * 24) / 60 / 60);
        $minutes_left = floor(($difference - $days_left * 60 * 60 * 24 - $hours_left * 60 * 60) / 60);
        $seconds_left = floor(($difference - $days_left * 60 * 60 * 24 - $hours_left * 60 * 60 - $minutes_left * 60));

        $ret = array($days_left, $hours_left, $minutes_left, $seconds_left, $up);

        return ($ret);
    }

    // Load JS script
    function countdowndyn($eventup)
    {
        $now = time();
        ?>
        <script type="text/javascript">// <![CDATA[
            var bigcountdown_now = <?php echo $now; ?>;
            var bigcountdown_to = <?php echo $eventup; ?>;

            bigcountdown_timebetween = bigcountdown_to - bigcountdown_now;

            var up = 0;
            if (bigcountdown_timebetween < 0) {
                bigcountdown_timebetween = bigcountdown_timebetween * -1;
                var up = 1;
            }

            var bigcountdown_daysremain = 0;
            var bigcountdown_hoursremain = 0;
            var bigcountdown_minutesremain = 0;
            var bigcountdown_secondsremain = bigcountdown_timebetween;

            if (bigcountdown_timebetween >= 60) {
                bigcountdown_secondsremain = bigcountdown_timebetween % 60;
                bigcountdown_minutesremain = (bigcountdown_timebetween - bigcountdown_secondsremain) / 60;
            }

            if (bigcountdown_minutesremain >= 60) {
                bigcountdown_timebetween = bigcountdown_minutesremain;
                bigcountdown_minutesremain = bigcountdown_timebetween % 60;
                bigcountdown_hoursremain = (bigcountdown_timebetween - bigcountdown_minutesremain) / 60;
            }

            if (bigcountdown_hoursremain >= 24) {
                bigcountdown_timebetween = bigcountdown_hoursremain;
                bigcountdown_hoursremain = bigcountdown_timebetween % 24;
                bigcountdown_daysremain = (bigcountdown_timebetween - bigcountdown_hoursremain) / 24;
            }

            var bigtime = document.getElementById("bigtime");
            var bigtimetext = "";

            if (up == 0) {
                var bigcountdown_timer = setInterval(bigCountDownTimer, 1000);
                var bigtime = document.getElementById("bigtime");
                var bigtimetext = "";
            } else {
                var bigcountdown_timer = setInterval(bigCountUpTimer, 1000);
                document.getElementById("bigafter").style.display = "inline";
                var bigtime = document.getElementById("bigtime_up");
                var bigtimetext = "";
            }

            function bigRewriteCountDownSpan() {
                bigtimetext = "";
                if (up == 0) {
                    bigtimetext += (bigcountdown_daysremain) ? "<span class=\"cdub_font_dyn\">" + bigcountdown_daysremain + " " + (bigcountdown_daysremain<=1 ? '<?php echo JText::_('MOD_COUNT_DOWN_BIG_DAY'); ?></span>':'<?php echo JText::_('MOD_COUNT_DOWN_BIG_DAYS'); ?></span>') : '';
                } else {
                    bigtimetext += (bigcountdown_daysremain) ? "<span class=\"cdub_font_dyn\">" + bigcountdown_daysremain + " " + (bigcountdown_daysremain<=1 ? '<?php echo JText::_('MOD_COUNT_DOWN_BIG_DAY'); ?></span>':'<?php echo JText::_('MOD_COUNT_DOWN_BIG_DAYS2'); ?></span>') : '';
                }
                if (bigcountdown_daysremain > 0) {
                    bigtimetext += "<br /><br /><span class=\"cdub_font2\">"
                } else {
                    bigtimetext += "<span class=\"cdub_font3\">"
                }
                bigtimetext += (bigcountdown_hoursremain || bigcountdown_daysremain) ? bigcountdown_hoursremain + (bigcountdown_hoursremain<=1 ? ' <?php echo JText::_('MOD_COUNT_DOWN_BIG_HOURSHORT'); ?> : ' : ' <?php echo JText::_('MOD_COUNT_DOWN_BIG_HOURSHORT'); ?> : ') : '';
                bigtimetext += (bigcountdown_minutesremain || bigcountdown_hoursremain || bigcountdown_daysremain) ? bigcountdown_minutesremain + (bigcountdown_minutesremain<=1 ? ' <?php echo JText::_('MOD_COUNT_DOWN_BIG_MINUTESHORT'); ?> : ' : ' <?php echo JText::_('MOD_COUNT_DOWN_BIG_MINUTESHORT'); ?> : ') : '';
                bigtimetext += bigcountdown_secondsremain + (bigcountdown_secondsremain<=1 ? ' <?php echo JText::_('MOD_COUNT_DOWN_BIG_SECONDSHORT'); ?> ' : ' <?php echo JText::_('MOD_COUNT_DOWN_BIG_SECONDSHORT'); ?> ');
                bigtimetext += "</span>"
                bigtime.innerHTML = bigtimetext;
            }

            function bigCountDownTimer() {
                if (bigcountdown_secondsremain == 0 && bigcountdown_minutesremain == 0 && bigcountdown_hoursremain == 0 && bigcountdown_daysremain == 0) {
                    clearInterval(bigcountdown_timer);
                    document.getElementById("bigbefore").style.display = "none";
                    document.getElementById("bigafter").style.display = "inline";
                    return;
                }

                if (bigcountdown_secondsremain > 0) bigcountdown_secondsremain--;
                else {
                    bigcountdown_secondsremain = (bigcountdown_minutesremain || bigcountdown_hoursremain || bigcountdown_daysremain) ? 59 : 0;
                    if (bigcountdown_minutesremain > 0) bigcountdown_minutesremain--;
                    else {
                        bigcountdown_minutesremain = (bigcountdown_hoursremain || bigcountdown_daysremain) ? 59 : 0;
                        if (bigcountdown_hoursremain > 0) bigcountdown_hoursremain--;
                        else {
                            bigcountdown_hoursremain = (bigcountdown_daysremain) ? 23 : 0;
                            if (bigcountdown_daysremain) bigcountdown_daysremain--;
                        }
                    }
                }

                bigRewriteCountDownSpan();
            }

            function bigCountUpTimer() {

                if (bigcountdown_secondsremain < 59) bigcountdown_secondsremain++;
                else {
                    bigcountdown_secondsremain = 0;
                    if (bigcountdown_minutesremain < 59) bigcountdown_minutesremain++;
                    else {
                        bigcountdown_minutesremain = 0;
                        if (bigcountdown_hoursremain < 23) bigcountdown_hoursremain++;
                        else {
                            bigcountdown_hoursremain = 0;
                            bigcountdown_daysremain++;
                        }
                    }
                }
                bigRewriteCountDownSpan();
            }
            // ]]></script>
    <?php
    }

    // Calculate the next or last event
    function dateArray(&$params)
    {
        $ev_dates = $params->get('ev_dates');
        $ev_year = $params->get('ev_year');
        $ev_month = $params->get('ev_month');
        $ev_day = $params->get('ev_day');
        $ev_hour = $params->get('ev_hour');
        $ev_minute = $params->get('ev_minute');
        $ev_title = $params->get('$ev_title');
        $ev_text = $params->get('ev_text');

        $dates = array();

        if(!empty($ev_dates))
        {
            $dates = explode('|', $ev_dates);
        }

        $dates[] = $ev_year.'@'.$ev_month.'@'.$ev_day.'@'.$ev_hour.'@'.$ev_minute.'@'.$ev_title.'@'.$ev_text;
        sort($dates);

        foreach($dates as $value)
        {
            $dates_array[] = explode('@', $value);
        }

        $dates_timestamp = array();

        foreach($dates_array as $value)
        {
            $timestamp = mod_count_down_bigHelper::timestamp($value);
            array_unshift($value, $timestamp);
            $dates_timestamp[] = $value;
        }

        $now = time();
        $noevent = 1;

        foreach($dates_timestamp as $value)
        {
            if($now < $value[0])
            {
                $noevent = 0;
                break;
            }
        }

        if($noevent == 1)
        {
            $value = array_pop($dates_timestamp);
        }

        return $value;
    }

    // Calculate Dateformat
    function dateformat(&$params, $ev_year, $ev_month, $ev_day, &$ev_hour)
    {
        $dateformat = $params->get('datef');

        switch($dateformat)
        {
            case 'dmy':
                $eventdate = $ev_day.'.'.$ev_month.'.'.$ev_year;
                $oclock = JText::_('MOD_COUNT_DOWN_BIG_OCLOCK');
                break;
            case 'mdy':
                $eventdate = $ev_month.'.'.$ev_day.'.'.$ev_year;
                $oclock = JText::_('MOD_COUNT_DOWN_BIG_OCLOCK');
                break;
            case 'mdy_eng':
                $eventdate = $ev_month.'/'.$ev_day.'/'.$ev_year;
                $oclock = mod_count_down_bigHelper::timeformat_eng($ev_hour);
                break;
            case 'dmy_eng':
                $eventdate = $ev_day.'/'.$ev_month.'/'.$ev_year;
                $oclock = mod_count_down_bigHelper::timeformat_eng($ev_hour);
                break;
        }

        $ret = array($eventdate, $oclock);

        return $ret;
    }

    // Transformation into the english format
    function timeformat_eng(&$ev_hour)
    {
        if($ev_hour > 12 AND $ev_hour < 25)
        {
            $ev_hour = $ev_hour - 12;
            $oclock = 'pm';
        }
        else
        {
            $oclock = 'am';
        }

        return $oclock;
    }

    // Get name of day - singular or plural
    function daysname($days_left, $up)
    {
        if($days_left == "1")
        {
            $days_switch = JText::_('MOD_COUNT_DOWN_BIG_DAY');
        }
        else
        {
            if($up == 0)
            {
                $days_switch = JText::_('MOD_COUNT_DOWN_BIG_DAYS');
            }
            else
            {
                $days_switch = JText::_('MOD_COUNT_DOWN_BIG_DAYS2');
            }
        }

        return $days_switch;
    }

    // Calculate timestamp of an event
    function timestamp($date)
    {
        $siteOffset = JFactory::getApplication()->getCfg('offset');
        date_default_timezone_set($siteOffset);

        $timestamp = mktime((int) $date[3], (int) $date[4], 0, (int) $date[1], (int) $date[2], (int) $date[0]);

        return $timestamp;
    }
}
