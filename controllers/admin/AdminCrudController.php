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
require_once _PS_MODULE_DIR_ . 'ps_multipurpose/classes/models/ModelCrud.php';
class AdminCrudController extends ModuleAdminController
{
	
	public function __construct()
	{
		$this->bootstrap  = true;
        $this->table      = 'multipurpose';
        $this->identifier = 'id';
        $this->className  = 'ModelCrud';
		parent::__construct();
		$id_lang = $this->context->language->id;

		//data to the grid of the "view" action
        $this->fields_list = [
            'id'       => [
                'title' => $this->l('ID'),
                'type'  => 'id',
                'align' => 'center',
                'class' => 'fixed-width-xs',
            ],
            'name'     => [
                'title' => $this->l('Name'),
                'type'  => 'text',
            ],
            'email'     => [
                'title' => $this->l('Description'),
                'type'  => 'text',
            ],
            'avatar_url'   => [
                'title'  => $this->l('Profile'),
				'type'   => 'text',
                'align'  => 'text-center',
                'class'  => 'fixed-width-sm'
            ]
        ];

        $this->actions = ['edit', 'delete'];

        $this->bulk_actions = array(
            'delete' => array(
                'text'    => $this->l('Delete selected'),
                'icon'    => 'icon-trash',
                'confirm' => $this->l('Delete selected items?'),
            ),
        );

		//fields to add/edit form
        $this->fields_form = [
            'legend' => [
                'title' => $this->l('General Information'),
            ],
            'input'  => [
                'name'   => [
                    'type'     => 'text',
                    'label'    => $this->l('Name'),
                    'name'     => 'name',
                    'required' => true,
                    'lang' => true
                ],
                'description'   => [
                    'type'     => 'text',
                    'label'    => $this->l('Description'),
                    'name'     => 'description',
                    'required' => true,
                    'lang' => true
                ],                
                'active' => [
                    'type'   => 'switch',
                    'label'  => $this->l('Active'),
                    'name'   => 'active',
                    'values' => [
                        [
                            'id'    => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ],
                        [
                            'id'    => 'active_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ],
                    ],
                ],
            ],
            'submit' => [
                'title' => $this->l('Save'),
            ],
        ];

	}

	public function init(){
		parent::init();
		$this->bootstrap = true;
	}

	public function initContent(){
		parent::initContent();
        $this->context->smarty->assign([]);
		$this->setTemplate('crud.tpl');
	}

	public function renderList()
	{
		parent::renderList();
	}

}