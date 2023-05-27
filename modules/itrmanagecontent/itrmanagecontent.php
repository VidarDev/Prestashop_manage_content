<?php

// Checked that the prestashop version is defined
if (!defined('_PS_VERSION_')) {
    exit;
}

class ItrManageContent extends Module
{
    public function __construct()
    {
        $this->name = 'itrmanagecontent';
        $this->tab = 'manage_content';
        $this->version = '1.0.0';
        $this->author = 'VidarDev';
        $this->need_instance = 0;
        // Indicates which versions this module is compatible with
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Manage Content');
        $this->description = $this->l('Add custom HTML content to various pages.');

        $this->confirmUninstall = $this->l('Are you sure? Deleting this module may cause issues in front office :(');
    }

    public function install()
    {
        return parent::install();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }
}
