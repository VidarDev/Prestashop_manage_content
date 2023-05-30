<?php
class Customer extends CustomerCore
{
    /*
    * module: itrmanagecontent
    * date: 2023-05-29 21:46:06
    * version: 1.0.0
    */
    public $avatar;
    /*
    * module: itrmanagecontent
    * date: 2023-05-29 21:46:06
    * version: 1.0.0
    */
    public function __construct($id = null)
    {
        self::$definition['fields']['avatar'] = array('type' => self::TYPE_STRING, 'validate' => 'isGenericName');
        parent::__construct($id);
    }
}
