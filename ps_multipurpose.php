<?php
/**
 * 2007-2019 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class Ps_Multipurpose extends Module{

	public function __construct()
	{
	    $this->name = 'ps_multipurpose';
	    $this->version = '1.0.0';
	    $this->author = 'Vijay Kanaujia';
	    $this->need_instance = 0;
	    $this->ps_versions_compliancy = [
	        'min' => '1.7.0',
	        'max' => _PS_VERSION_
	    ];
	    $this->bootstrap = true;
	    $this->tab = 'Administrator';
	    $this->secure_key = Tools::encrypt($this->name);

	    parent::__construct();

	    $this->displayName = $this->l('Prestashop Multipurpose');
	    $this->description = $this->l('Learn how to develope prestashop module.');

	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

	    if (!Configuration::get('PS_MULTIPURPOSE')) {
	        $this->warning = $this->l('No name provided');
	    }
	}

	public function install()
	{
		include_once($this->local_path . 'sql/install.php');
	    if (!parent::install() &&
	        !$this->registerHook('header') &&
	        !$this->registerHook('displayHome') &&
	        !$this->installTabLink() &&
	        !Configuration::updateValue('PS_MULTIPURPOSE', 'product carousel')
	    ) {
	        return false;
	    }
	    return true;
	}

	public function uninstall()
	{
		include_once($this->local_path . 'sql/uninstall.php');
	    if (!parent::uninstall() &&
	        !$this->unregisterHook('header') &&
	        !$this->unregisterHook('displayHome') &&
	        !$this->uninstallTabLink() &&
	        !Configuration::deleteByName('PS_MULTIPURPOSE')
	    ) {
	        return false;
	    }

	    return true;
	}

	public function hookHeader()
	{
	    $this->context->controller->addCss([
	        $this->_path . 'views/css/ps_multipurpose.css',
	    ]);
	    $this->context->controller->addJs([
	        $this->_path . 'views/js/ps_multipurpose.js',
	    ]);
	}

	public function hookDisplayHome(){
		return $this->display($this->local_path, 'views/templates/front/hook_display_home_message.tpl');
	}

	public function getContent(){
		if(Tools::isSubmit('ps_multipurpose_setting_save')){
			$ps_multipurpose_title = Tools::getValue('ps_multipurpose_title');
			Configuration::updateValue('PS_MULTIPURPOSE', $ps_multipurpose_title);
		}
		$this->context->smarty->assign([
			'ps_multipurpose_title'=> Configuration::get('PS_MULTIPURPOSE')
		]);
		return $this->display($this->local_path,'/views/templates/admin/index.tpl');
	}	

	private function installTabLink(){
		// $tab = new Tab;
		// foreach(Language::getLanguages() as $lang){
		// 	$tab->name[$lang['id_lang']] = $this->l('Demo');
		// }
		// $tab->class_name = 'AdminDemo';
		// $tab->module = $this->name;
		// $tab->id_parent = 0;
		// $tab->add();
		// return true;

		$tabId = (int) Tab::getIdFromClassName('AdminDemo');
        if (!$tabId) {
            $tabId = null;
        }

        $tab = new Tab($tabId);
        $tab->class_name = 'AdminDemo';
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = 'Demo';
        }
        $tab->id_parent = 1;
        $tab->module = $this->name;

        return $tab->save();
	}

	private function uninstallTabLink(){
		$tabId = (int) Tab::getIdFromClassName('AdminDemo');
        if (!$tabId) {
            return true;
        }

        $tab = new Tab($tabId);

        return $tab->delete();
	}
}