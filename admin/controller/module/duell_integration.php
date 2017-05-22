<?php

class ControllerModuleDuellIntegration extends Controller {

  private $error = array();

  public function index() {
    /* Load language file. */
    $this->load->language('module/duell_integration');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('setting/setting');

    /* Check if data has been posted back. */
    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
      $this->model_setting_setting->editSetting('duell_integration', $this->request->post);

      $this->session->data['success'] = $this->language->get('text_success');

      $this->cache->delete('duell_integration');

      setcookie('duell_integration', '', time() - (86400 * 30), "/");

      $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
    }

    /* Load language strings. */
    $this->data['text_edit'] = $this->language->get('text_edit');

    $this->data['text_about'] = $this->language->get('text_about');
    $this->data['text_module'] = $this->language->get('text_module');
    $this->data['text_enabled'] = $this->language->get('text_enabled');
    $this->data['text_disabled'] = $this->language->get('text_disabled');

    $this->data['heading_title'] = $this->language->get('heading_title');

    $this->data['entry_title'] = $this->language->get('entry_title');
    $this->data['entry_text'] = $this->language->get('entry_text');
    $this->data['entry_status'] = $this->language->get('entry_status');

    $this->data['button_save'] = $this->language->get('button_save');
    $this->data['button_cancel'] = $this->language->get('button_cancel');


    $this->data['text_duell_integration_client_number'] = $this->language->get('text_duell_integration_client_number');
    $this->data['text_duell_integration_client_token'] = $this->language->get('text_duell_integration_client_token');
    $this->data['text_duell_integration_department_token'] = $this->language->get('text_duell_integration_department_token');


    $this->data['help_text_duell_integration_client_number'] = $this->language->get('help_text_duell_integration_client_number');
    $this->data['help_text_duell_integration_client_token'] = $this->language->get('help_text_duell_integration_client_token');
    $this->data['help_text_duell_integration_department_token'] = $this->language->get('help_text_duell_integration_department_token');

    $this->data['text_duell_integration_manual_sync'] = $this->language->get('text_duell_integration_manual_sync');


    $this->data['text_user_guide'] = $this->language->get('text_user_guide');
    $this->data['text_cron_steup_title_curl'] = $this->language->get('text_cron_steup_title_curl');
    $this->data['text_every_hours'] = $this->language->get('text_every_hours');
    $this->data['text_every_night'] = $this->language->get('text_every_night');



    /* Present error messages to users. */
    if (isset($this->error['warning'])) {
      $this->data['error_warning'] = $this->error['warning'];
    } else {
      $this->data['error_warning'] = '';
    }

    if (isset($this->error['duell_integration_client_number'])) {
      $this->data['error_duell_integration_client_number'] = $this->error['duell_integration_client_number'];
    } else {
      $this->data['error_duell_integration_client_number'] = '';
    }


    if (isset($this->error['duell_integration_client_token'])) {
      $this->data['error_duell_integration_client_token'] = $this->error['duell_integration_client_token'];
    } else {
      $this->data['error_duell_integration_client_token'] = '';
    }

    if (isset($this->error['duell_integration_department_token'])) {
      $this->data['error_duell_integration_department_token'] = $this->error['duell_integration_department_token'];
    } else {
      $this->data['error_duell_integration_department_token'] = '';
    }

    /* Breadcrumb. */
    $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => false
    );

    $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_module'),
        'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => ' :: '
    );

    $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('module/duell_integration', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => ' :: '
    );

    $this->data['action'] = $this->url->link('module/duell_integration', 'token=' . $this->session->data['token'], 'SSL');

    $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

    $this->data['cron_link'] = HTTP_CATALOG . 'system/duellcron.php';

    $this->data['token'] = $this->session->data['token'];


    /* Initial values for form. */
    if (isset($this->request->post['duell_integration_client_number'])) {
      $this->data['duell_integration_client_number'] = $this->request->post['duell_integration_client_number'];
    } else {
      $this->data['duell_integration_client_number'] = $this->config->get('duell_integration_client_number');
    }


    if (isset($this->request->post['duell_integration_client_token'])) {
      $this->data['duell_integration_client_token'] = $this->request->post['duell_integration_client_token'];
    } else {
      $this->data['duell_integration_client_token'] = $this->config->get('duell_integration_client_token');
    }

    if (isset($this->request->post['duell_integration_department_token'])) {
      $this->data['duell_integration_department_token'] = $this->request->post['duell_integration_department_token'];
    } else {
      $this->data['duell_integration_department_token'] = $this->config->get('duell_integration_department_token');
    }





    if (isset($this->request->post['duell_integration_status'])) {
      $this->data['duell_integration_status'] = $this->request->post['duell_integration_status'];
    } else {
      $this->data['duell_integration_status'] = $this->config->get('duell_integration_status');
    }

    /* Render some output. */
    $this->load->model('design/layout');

    $this->data['layouts'] = $this->model_design_layout->getLayouts();

    $this->template = 'module/duell_integration.tpl';
    $this->children = array(
        'common/header',
        'common/footer'
    );

    $this->response->setOutput($this->render());
  }

  /* Check user input. */

  protected function validate() {
    if (!$this->user->hasPermission('modify', 'module/duell_integration')) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    if (!$this->request->post['duell_integration_client_number'] || strlen($this->request->post['duell_integration_client_number']) <= 5) {
      $this->error['duell_integration_client_number'] = $this->language->get('error_duell_integration_client_number');
    }

    if (!$this->request->post['duell_integration_client_token'] || strlen($this->request->post['duell_integration_client_token']) <= 0) {
      $this->error['duell_integration_client_token'] = $this->language->get('error_duell_integration_client_token');
    }

    if (!$this->request->post['duell_integration_department_token'] || strlen($this->request->post['duell_integration_department_token']) <= 0) {
      $this->error['duell_integration_department_token'] = $this->language->get('error_duell_integration_department_token');
    }

    return !$this->error;
  }

  public function manualsync() {
    $json = array();

    $json['status'] = false;
    $json['message'] = '';

    $this->load->language('module/duell_integration');

    $this->load->library('duell/duell');

    $this->duell = Duell::get_instance($this->registry);



    $result = $this->duell->callDuellStockSync();


    if ($result['status'] == true) {
      $status = true;
      $json['message'] = $this->language->get('sync_success');
    } else {
      $json['message'] = $result['message'];
    }


    $this->response->setOutput(json_encode($json));
  }

}
