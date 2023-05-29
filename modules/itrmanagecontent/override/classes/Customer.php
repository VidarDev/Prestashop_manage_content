<?php
class Customer extends CustomerCore
{
    public $avatar;

    public function __construct($id = null)
    {
        self::$definition['fields']['avatar'] = array('type' => self::TYPE_STRING, 'validate' => 'isGenericName');

        parent::__construct($id);
    }
}
