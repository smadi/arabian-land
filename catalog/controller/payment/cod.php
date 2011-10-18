<?php
class ControllerPaymentCod extends Controller {
	protected function index() {
		$this -> data['button_confirm'] = $this -> language -> get('button_confirm');

		$this -> data['continue'] = $this -> url -> link('checkout/success');

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/payment/cod.tpl')) {
			$this -> template = $this -> config -> get('config_template') . '/template/payment/cod.tpl';
		} else {
			$this -> template = 'default/template/payment/cod.tpl';
		}

		$this -> render();
	}

	/**
	 * This function modified to retirive the order inofrmation in order to get the total value for COD limit
	 * @name Mohammad Abuelezz < aboel3zz at maktoob dot com>
	 */
	public function confirm() {

		$json = array();
		$error = '';
		try {
			$this -> load -> model('checkout/order');

			$order_id = $this -> session -> data['order_id'];
			// get the order information by order ID
			$order_info = $this -> model_checkout_order -> getOrder($order_id);			

			// Here is the code to increase the limit value for COD
			$query = $this -> db -> query("SELECT `value` FROM " . DB_PREFIX . "setting WHERE `key` = 'cod_current_value'");
			$cod_current_value = (int)$query -> row['value'];
			$cod_new_value = $cod_current_value + $order_info['total'];

			// make double check for the COD limit, for hacking purpose
			if ($this -> config -> get('cod_limit') >= $cod_new_value) {
				$query = $this -> db -> query("UPDATE " . DB_PREFIX . "setting SET `value` = {$cod_new_value} WHERE `key` = 'cod_current_value'");
			} else {
				$json['error'] = 'Sorry your order limit is over the allowed COD limit';
			}
			// End of COD limit increase
			$this -> model_checkout_order -> confirm($order_id, $this -> config -> get('cod_order_status_id'));

		} catch (Exception $e) {
			$json['error'] = $e -> getMessage();
		}

		$this -> load -> library('json');
		$this -> response -> setOutput(Json::encode($json));
		return;
	}

}
?>