# Prestashop recruitment test

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

The aim of this recruitment test is to create a Prestashop module in version 1.7.8 to add customizable content (wysiwyg) to the home page, products and categories.

## Installation

Clone the project

```bash
  git clone git@github.com:VidarDev/Prestashop_manage_content.git
```

Import database (not listed)

```bash
  (not listed)
```

Go to the project directory

```bash
  cd Prestashop_manage_content
```

## Module

Go to the module directory

```bash
   cd Prestashop_manage_content/modules/itrmanagecontent/
```

CustormerFormatter.php

```bash
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
