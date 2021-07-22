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
class AdminCrudController extends ModuleAdminController
{

    /**
     * @var int
     */
    //protected $position_identifier = 'id_dynamic_text_sort1';

    public function __construct()
    {
        $this->bootstrap  = true;
        $this->table      = 'multipurpose';
        $this->className  = 'ModelCrud';
        $this->list_id = 'multipurpose';
        $this->identifier = 'id';
        $this->_defaultOrderBy = 'id';
        $this->_orderWay = 'DESC';
        $this->lang = false;
        parent::__construct();

        if (!$this->module->active) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
        }
        $this->name = 'AdminCrud';

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
                'title' => $this->l('Email'),
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
                    'lang' => false
                ],
                'email'   => [
                    'type'     => 'text',
                    'label'    => $this->l('Email'),
                    'name'     => 'email',
                    'required' => true,
                    'lang' => false
                ],
                'avatar_url'   => [
                    'type'     => 'file',
                    'label'    => $this->l('Profile Picture'),
                    'name'     => 'avatar_url',
                    'required' => false,
                    'lang' => false,
                    'display_image' => true,
                    //'image' => 'multipurpose',
                ],
                // 'active' => [
                //     'type'   => 'switch',
                //     'label'  => $this->l('Active'),
                //     'name'   => 'active',
                //     'values' => [
                //         [
                //             'id'    => 'active_on',
                //             'value' => 1,
                //             'label' => $this->l('Yes'),
                //         ],
                //         [
                //             'id'    => 'active_off',
                //             'value' => 0,
                //             'label' => $this->l('No'),
                //         ],
                //     ],
                // ],
            ],
            'submit' => [
                'title' => $this->l('Save'),
            ]
        ];

        $this->fieldImageSettings = [
            'name' => 'avatar_url',
            'dir' => ModelCrud::$img_dir
        ];

        // $this->fields_options = array(
        //     'multipurpose' => array(
        //         'title' => $this->trans('Add Crud'),
        //         'fields' => array(
        //             'PS_DELETE_SHIPPING_LABEL' => array(
        //                 'title' => $this->trans('Allow admin to delete labels', array(), 'Admin.Catalog.Feature'),
        //                 'hint' => $this->trans('These labels are used to calculate handling price, please check properly before delete', array(), 'Admin.Catalog.Help'),
        //                 'type' => 'bool',
        //             ),
        //             'PS_SHOP_SHIPPING_LABELCOUNTRY' => array(
        //                 'title' => $this->trans('Shipping Estimation Country', array(), 'Admin.Shopparameters.Feature'),
        //                 'validation' => 'isInt',
        //                 'cast' => 'intval',
        //                 'type' => 'select',
        //                 'list' => $countries,
        //                 'identifier' => 'id_country',
        //             ),
        //             'PS_SHIPPING_MESSAGE_TIME' => array(
        //                 'title' => $this->trans('Shipping time message', array(), 'Admin.Catalog.Feature'),
        //                 'hint' => $this->trans('These labels are used to calculate handling price, please check properly before delete', array(), 'Admin.Catalog.Help'),
        //                 'type' => 'text',
        //             ),
        //             'PS_SHIPPING_DISABLECOUNTRIES' => array(
        //                 'title' => $this->trans('Shipping disable countries', array(), 'Admin.Catalog.Feature'),
        //                 'hint' => $this->trans('Country id\'s which need to be removed from front end (,) comma separated', array(), 'Admin.Catalog.Help'),
        //                 'type' => 'text',
        //             ),

        //         ),
        //         'submit' => array('title' => $this->trans('Save', array(), 'Admin.Actions')),
        //     ),
        // );
    }

    public function init()
    {
        //$m = new ModelCrud();
        //dump(ModelCrud::$definition);
        parent::init();
    }

    public function initContent()
    {
        parent::initContent();
        //$this->context->smarty->assign([]);
        //$this->setTemplate('crud.tpl');
    }

    /**
     *  Override AdminController initPageHeaderToolbar function
     */
    public function initPageHeaderToolbar()
    {
        if (empty($this->display)) {
            $this->page_header_toolbar_btn['new_crud_label'] = array(
                'href' => self::$currentIndex . '&addmultipurpose&token=' . $this->token,
                'desc' => $this->trans('Add new crud'),
                'icon' => 'process-icon-new',
            );
        }

        parent::initPageHeaderToolbar();
    }

    public function renderList()
    {
        // $this->addRowAction('edit');
        // $this->addRowAction('delete');
        // $this->fields_list;
        return parent::renderList();
    }

    /**
     * AdminController::renderForm() override
     *
     * @see AdminController::renderForm()
     */
    public function renderForm()
    {
        return parent::renderForm();
    }

    public function initToolBarTitle()
    {
        $this->toolbar_title[] = $this->l('Admin Crud');
        $this->toolbar_title[] = $this->l('List');
    }
}
