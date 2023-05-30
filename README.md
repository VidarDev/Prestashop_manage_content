# Prestashop recruitment test

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

L'objectif de ce test de recrutement est de créer un module Prestashop en version 1.7.8 pour différentes fonctions sur la page d'accueil, les produits et si l'utilisateur est connecté.

## Installation

Cloner le projet

```bash
  git clone git@github.com:VidarDev/Prestashop_manage_content.git
```

Importer la Base de données (Non fourni)

```bash
  (Non fourni)
```

Aller dans le dossier du projet

```bash
  cd Prestashop_manage_content
```

## Module

Aller dans le dossier du module

```bash
   cd Prestashop_manage_content/modules/itrmanagecontent/
```

### Arborescence

```bash
  override/
      class/
            Customer.php
  sql/
      install.php
      uninstall.php
  translations/
      fr.php
  views/
      css/
          back.css
          front.css
      img/
          avatar/
      js/
          back.js
          front.js
      templates/
          admin/
              config.tpl
          hook/
              connecte.tpl
              header.tpl
              modal.tpl
              non_connecte.tpl
  ajax.php
  itrmanagecontent.php
```

### Particularités

Pour créer le nouveau "champ" dans le formulaire "Vos informations personnelles" de prestashop, vous devez écrire dans le fichier "CustormerFormatter.php" (Impossible à surcharger) :

Chemin :

```bash
  override/classes/Customer.php
```

Code :

```php
    if (\Module::isInstalled('itrmanagecontent') && \Module::isEnabled('itrmanagecontent')) {
        $avatarField = (new FormField())
            ->setName('avatar')
            ->setType('select')
            ->setLabel($this->translator->trans('Avatar', [], 'Shop.Forms.Labels'))
            ->setRequired(false);

        // Récupérer les images PNG du répertoire avatars
        $avatarsPath = _PS_MODULE_DIR_ . 'itrmanagecontent/views/img/avatars/';
        $avatars = scandir($avatarsPath);
        foreach ($avatars as $avatar) {
            if ($avatar !== '.' && $avatar !== '..' && pathinfo($avatar, PATHINFO_EXTENSION) === 'png') {
                $avatarField->addAvailableValue($avatar, $avatar);
            }
        }

        $format['avatar'] = $avatarField;
    }
```

Pour afficher l'avatar de l'utilisateur dans le header de prestashop, vous devez écrire dans le fichier "ps_customersignin.tpl" (Impossible à surcharger) :

Chemin :

```bash
  themes/{theme.name}/modules/ps_customersignin/ps_customersignin.tpl
```

Code :

```php
  {if isset($customer.avatar)}<img id="avatar" src="{$urls.base_url}modules/itrmanagecontent/views/img/avatars/{$customer.avatar}" alt="" />{/if}
  {l s='Sign out' d='Shop.Theme.Actions'}
```

## Test de recrutement

### Point non traité :

- Un mail sera envoyé à la soumission du formulaire à l’administrateur du site
