<?php

/** 
 * 2007-2023 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author    PrestaShop SA <contact@prestashop.com>
 *  @copyright 2007-2023 PrestaShop SA
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

// Checked that the prestashop version is defined
if (!defined('_PS_VERSION_')) {
    exit;
}

class Itrmanagecontent extends Module
{
    public function __construct()
    {
        $this->name = 'itrmanagecontent';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'VidarDev';
        $this->need_instance = 0;

        // Indicates which versions this module is compatible with
        $this->ps_versions_compliancy = [
            'min' => '1.7.6.0',
            'max' => _PS_VERSION_
        ];

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Itr Manage Content');
        $this->description = $this->l('Add custom HTML content to various pages.');

        $this->confirmUninstall = $this->l('Are you sure? Deleting this module may cause issues in front office :(');
    }


    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        include(dirname(__FILE__) . '/sql/install.php');

        if (
            !parent::install() ||
            !$this->registerHook('displayHome')
        ) {
            return false;
        }

        // Créez les configurations par défaut lors de l'installation
        Configuration::updateValue('MODE_NON_CONNECTE', 'Texte en mode non connecté');
        Configuration::updateValue('MODE_CONNECTE', 'Texte en mode connecté');

        return true;
    }

    public function uninstall()
    {
        include(dirname(__FILE__) . '/sql/uninstall.php');

        // Supprimez les configurations lors de la désinstallation
        Configuration::deleteByName('MODE_NON_CONNECTE');
        Configuration::deleteByName('MODE_CONNECTE');

        return parent::uninstall();
    }

    public function getContent()
    {
        $output = null;

        if (Tools::isSubmit('submit' . $this->name)) {
            $modeNonConnecte = Tools::getValue('MODE_NON_CONNECTE');
            $modeConnecte = Tools::getValue('MODE_CONNECTE');

            if (empty($modeNonConnecte) || empty($modeConnecte)) {
                $output .= $this->displayError($this->l('Please complete all fields.'));
            } else {
                Configuration::updateValue('MODE_NON_CONNECTE', $modeNonConnecte);
                Configuration::updateValue('MODE_CONNECTE', $modeConnecte);

                $output .= $this->displayConfirmation($this->l('Updated config.'));
            }
        }

        return $output . $this->renderForm();
    }

    public function renderForm()
    {
        $fieldsForm = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Mode non connecté'),
                        'name' => 'MODE_NON_CONNECTE',
                        'required' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Mode connecté'),
                        'name' => 'MODE_CONNECTE',
                        'required' => true,
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default pull-right',
                ),
            ),
        );

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;

        // Language
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = $this->context->language->id;

        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = $this->context->language->id;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit' . $this->name;
        $helper->toolbar_btn = array(
            'save' => array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name .
                    '&token=' . Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'desc' => $this->l('Back to list'),
                'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
            ),
        );

        $helper->fields_value['MODE_NON_CONNECTE'] = Configuration::get('MODE_NON_CONNECTE');
        $helper->fields_value['MODE_CONNECTE'] = Configuration::get('MODE_CONNECTE');

        return $helper->generateForm(array($fieldsForm));
    }

    public function hookDisplayHome($params)
    {
        if (!$this->isLogged()) {
            $texteNonConnecte = Configuration::get('MODE_NON_CONNECTE');
            if (!empty($texteNonConnecte)) {
                $this->context->smarty->assign(array(
                    'texteNonConnecte' => $texteNonConnecte,
                ));

                return $this->display(__FILE__, 'non_connecte.tpl');
            }
        } else {
            $texteConnecte = Configuration::get('MODE_CONNECTE');
            if (!empty($texteConnecte)) {
                $this->context->smarty->assign(array(
                    'texteConnecte' => $texteConnecte,
                ));

                return $this->display(__FILE__, 'connecte.tpl');
            }
        }

        return '';
    }

    private function isLogged()
    {
        return $this->context->customer->isLogged();
    }

    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJS($this->_path . 'views/js/back.js');
            $this->context->controller->addCSS($this->_path . 'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookDisplayHeader()
    {
        $this->context->controller->addJS($this->_path . '/views/js/front.js');
        $this->context->controller->addCSS($this->_path . '/views/css/front.css');
    }
}
