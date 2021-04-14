<?php
/**
 * 2007-2019 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0  Academic Free License (AFL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
/**
 * <ModuleName> => ps_multipurpose
 * <FileName> => Contact.php
 * Format expected: <ModuleName><FileName>ModuleFrontController
 */
class Ps_MultipurposeContactModuleFrontController extends ModuleFrontController {
	public $auth = false;
	public $guestAllowed = true;
	protected $maintenance = false;
	public function __construct(){
		parent::__construct();
	}

	public function init(){
		parent::init();
	}

	public function initHeader(){}

	public function initContent(){
		parent::initContent();

		$this->context->smarty->assign([
			'nb_product' => Db::getInstance()->getValue('SELECT COUNT(*) FROM `'._DB_PREFIX_.'product`'),
			'categories' => Db::getInstance()->executeS('SELECT `name` FROM `'._DB_PREFIX_.'category_lang` WHERE `id_lang` = '.(int)$this->context->language->id),
			'shop_name' => Configuration::get('PS_MULTIPURPOSE'),
			'manufacturer' => Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'manufacturer`')
		]);
	
		$this->setTemplate('module:ps_multipurpose/views/templates/front/contact.tpl');

	}

	public function initFooter(){}

	public function postProcess(){}
}