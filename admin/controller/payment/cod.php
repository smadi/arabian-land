<?php 
class ControllerPaymentCod extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->load->language('payment/cod');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			// Reset all the COD linit configuration
			$this->request->post['cod_last_date'] = $today = date("Y-n-j");
			if(isset($this->request->post['cod_reset_current_value']) && $this->request->post['cod_reset_current_value'] == TRUE) {
				$this->request->post['cod_current_value'] = 0;
			}	
			$this->model_setting_setting->editSetting('cod', $this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
				
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_total'] = $this->language->get('entry_total');	
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		/**
		 * COD Limit by Mohammad Abuelezz: aboel3zz at gmail dot com
		 */
        $this->data['entry_cod_limit'] = $this->language->get('entry_cod_limit');
        $this->data['entry_cod_limit_period'] = $this->language->get('entry_cod_limit_period');
		$this->data['entry_cod_current_value'] = $this->language->get('entry_cod_current_value');
		$this->data['entry_cod_limit_daily'] = $this->language->get('entry_cod_limit_daily');
		$this->data['entry_cod_limit_weekly'] = $this->language->get('entry_cod_limit_weekly');
		$this->data['entry_cod_limit_monthly'] = $this->language->get('entry_cod_limit_monthly');		
		$this->data['entry_cod_last_date'] = $this->language->get('entry_cod_last_date');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/cod', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('payment/cod', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');	
		
		if (isset($this->request->post['cod_total'])) {
			$this->data['cod_total'] = $this->request->post['cod_total'];
		} else {
			$this->data['cod_total'] = $this->config->get('cod_total'); 
		}
				
		if (isset($this->request->post['cod_order_status_id'])) {
			$this->data['cod_order_status_id'] = $this->request->post['cod_order_status_id'];
		} else {
			$this->data['cod_order_status_id'] = $this->config->get('cod_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['cod_geo_zone_id'])) {
			$this->data['cod_geo_zone_id'] = $this->request->post['cod_geo_zone_id'];
		} else {
			$this->data['cod_geo_zone_id'] = $this->config->get('cod_geo_zone_id'); 
		} 
		
		
/**
 * COD Limit 
 */		
 		if (isset($this->request->post['cod_limit'])) {
			$this->data['cod_limit'] = $this->request->post['cod_limit'];
		} else {
			$this->data['cod_limit'] = $this->config->get('cod_limit'); 
		} 

 		if (isset($this->request->post['cod_limit_period'])) {
			$this->data['cod_limit_period'] = $this->request->post['cod_limit_period'];
		} else {
			$this->data['cod_limit_period'] = $this->config->get('cod_limit_period'); 
		} 
		
 		if (isset($this->request->post['cod_current_value'])) {
			$this->data['cod_current_value'] = $this->request->post['cod_current_value'];
		} else {
			$this->data['cod_current_value'] = $this->config->get('cod_current_value'); 
		} 
		
		if (isset($this->request->post['cod_last_date'])) {
			$this->data['cod_last_date'] = $this->request->post['cod_last_date'];
		} else {
			$this->data['cod_last_date'] = $this->config->get('cod_last_date'); 
		} 		
		

		$this->load->model('localisation/geo_zone');						
		
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['cod_status'])) {
			$this->data['cod_status'] = $this->request->post['cod_status'];
		} else {
			$this->data['cod_status'] = $this->config->get('cod_status');
		}
		
		if (isset($this->request->post['cod_sort_order'])) {
			$this->data['cod_sort_order'] = $this->request->post['cod_sort_order'];
		} else {
			$this->data['cod_sort_order'] = $this->config->get('cod_sort_order');
		}

		$this->template = 'payment/cod.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/cod')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>