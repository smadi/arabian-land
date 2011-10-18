<?php
class ModelPaymentCOD extends Model {
	public function getMethod($address, $total) {
		$this -> load -> language('payment/cod');

		$query = $this -> db -> query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this -> config -> get('cod_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this -> config -> get('cod_total') > $total) {
			$status = false;
		} elseif (!$this -> config -> get('cod_geo_zone_id')) {
			$status = true;
		} elseif ($query -> num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		/**
		 * COD limit logic
		 * @name Mohammad Abuelezz <aboel3zz at maktoob dot com>
		 *
		 * 1- if there is no problem with the default COD module
		 * 2- if the COD limit is not unlimited
		 * 3- get the COD limit period (daily, weekly or monthly) from the admin setting
		 * 4- check the last check date
		 * 4.1 if the last check date not found, then make it the today date
		 * 5- get the days between last check date and today
		 * 6- check if we should reste the current COD total value
		 * 7- if the order total value + current COD value bigger than the COD limit, then hide the COD from the payment list
		 */

		if ($status == true && $this -> config -> get('cod_limit') != 0) {

			 $cod_current_value;
			//get the COD limit period
			$cod_period = $this->config->get('cod_limit_period');
			$last_cod_date = $this->config->get('cod_last_date');
			
			// get the date of today
			$today = date("Y-n-j");

			// set the date for the first time if it's not set
			if (date("Y", strtotime($last_cod_date)) == '1970') {
				$last_cod_date = $today;
			}
			//var_dump($last_cod_date);die;
			$date_diff = $this -> date_diff_in_days($last_cod_date, $today);
			
			$reset_check_date = FALSE;			
			switch ($cod_period) {
				case 'daily' :
					if ($date_diff >= 1) {
						$reset_check_date = TRUE;
					}
					break;
				case 'weekly' :
					if ($date_diff >= 7) {
						$reset_check_date = TRUE;
					}
					break;
				case 'monthly' :
					if ($date_diff >= 30) {
						$reset_check_date = TRUE;
					}
					break;
				default :
					$reset_check_date = FALSE;
					break;
			}
			// implement the date reset
			if ($reset_check_date == TRUE) {
				$query = $this -> db -> query("UPDATE " . DB_PREFIX . "setting SET `value` = '0' WHERE `key` = 'cod_current_value'");
				$query = $this -> db -> query("UPDATE " . DB_PREFIX . "setting SET `value` = '{$today}' WHERE `key` = 'cod_last_date'");
				$cod_current_value = 0;

			} else {
				$cod_query = $this -> db -> query("SELECT `value` FROM " . DB_PREFIX . "setting WHERE `key` = 'cod_current_value'");
				$cod_current_value = (int)$cod_query -> row['value'];
			}
			if (($total + $cod_current_value) > $this -> config -> get('cod_limit')) {
				$status = false;
			} else {
				$status = true;
			}
		}

		$method_data = array();

		if ($status) {
			$method_data = array('code' => 'cod', 'title' => $this -> language -> get('text_title'), 'sort_order' => $this -> config -> get('cod_sort_order'));
		}

		return $method_data;
	}

	// return the diff between two dates (days, month and years)
	private function date_diff_in_days($date1, $date2) {

		$diff = abs(strtotime($date2) - strtotime($date1));

		$years = floor($diff / (365 * 60 * 60 * 24));
		$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

		//printf("%d years, %d months, %d days\n", $years, $months, $days);
		return $days;

	}

}
?>