<?php
require_once(dirname(__FILE__) . '/../../config/config.inc.php');
require_once(dirname(__FILE__) . '/../../init.php');
require_once(dirname(__FILE__) . '/itrmanagecontent.php');

if (Tools::getValue('action') == 'report') {
    // Recupérer les informations du formulaire
    $id_product = Tools::getValue('id_product');
    $report_text = Tools::getValue('report_text');
    $product_name = Tools::getValue('product_name');

    $product = new Product((int)$id_product);

    // Enregistrer le signalement en base de données
    Db::getInstance()->insert('error_report', array(
        'id_product' => (int)$id_product,
        'product_name' => pSQL($product_name),
        'report_text' => pSQL($report_text),
        'date_add' => date('Y-m-d H:i:s'),
    ));

    // Créer les variables de mail
    $mailVars = array(
        '{product_name}' => $product_name,
        '{product_id}' => $id_product,
        '{report_text}' => $report_text
    );
}
