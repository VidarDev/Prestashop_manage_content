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

$sql = array();

// Vérifier si "avatar" existe dans la table `customer`
$sql_verif = 'SELECT COLUMN_NAME 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = "' . _DB_NAME_ . '" 
            AND TABLE_NAME = "' . _DB_PREFIX_ . 'customer" 
            AND COLUMN_NAME = "avatar"';
$result = Db::getInstance()->executeS($sql_verif);

// Créer la table error_report
$sql[] =  'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'error_report` (
    `id_error_report` int(11) NOT NULL AUTO_INCREMENT,
    `id_product` int(11) NOT NULL,
    `product_name` varchar(255) NOT NULL,
    `report_text` text NOT NULL,
    `date_add` datetime NOT NULL,
    PRIMARY KEY (`id_error_report`)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

if (empty($result)) {
    // Créer la column "avatar" dans la table `customer`
    $sql[] =  'ALTER TABLE ' . _DB_PREFIX_ . 'customer ADD `avatar` VARCHAR(255) NULL';
}

// Executer les requetes SQL 
foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
