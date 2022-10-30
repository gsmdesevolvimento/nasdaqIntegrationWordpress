<?php

/**
*
* @author Guilherme Sousa
* @link https://github.com/gsmdados/nasdaq-integration-wordpress
* @version 1.0
*/

if (!defined('ABSPATH')) {
	exit('Access denied');
}

class Application {

	private $plugin_path;
	private $prefixAssets;

	public function __construct ($plugin_path) {

		$this->plugin_path = $plugin_path;

		$this->prefixAssets = md5($plugin_path);

	}

	/*
	* Registra no menu do painel administrativo do Wordpress a opção com link para a página de gestão do plugin
	*/
	public function adminInterface () {

		if (!empty($_GET['nasdaq_company_selected'])) {

			Nasdaq::savePluginOption('nasdaq_company_selected', $_GET['nasdaq_company_selected']);

		}

		add_menu_page(
			'Teste Nasdaq',
			'Teste Nasdaq',
			'manage_options',
			'nasdaqIntegration',
			array($this, 'getAdminTemplate'),
			''
		);

	}

	/*
	* Importa a página para gestão do plugin
	*/
	public function getAdminTemplate () {

		require_once($this->plugin_path . 'views/admin.php');

	}

	public function viewMainContent () {

		$this->importCss('application.css');

		require_once($this->plugin_path . 'views/public.php');

	}

	private function importCss ($filename) {

		wp_register_style(
		    $this->prefixAssets . '-' . $filename,
		    plugins_url('../views/assets/css/' . $filename, __FILE__)
		);

		wp_enqueue_style($this->prefixAssets . '-' . $filename);

	}

	private function importJs ($filename) {

		wp_register_script(
		    $this->prefixAssets . '-' . $filename,
		    plugins_url('../views/assets/js/' . $filename, __FILE__)
		);

		wp_enqueue_script($this->prefixAssets . '-' . $filename);

	}

}