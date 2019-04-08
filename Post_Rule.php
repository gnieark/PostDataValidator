<?php
class Post_Rule
{
    /*
    * This is the parent class. (will allways return false on check).
    * Childs class should really make rules tests
    */

    protected $field_name;
    protected $params;

    /*
    * check_if_empty
    * When true, var is checcked as an empty string. It may pass or not the rule test
    * When check_if_empty is false the check will return true if it's empty
    */
    protected $check_if_empty = true;

    public function dont_check_if_empty(){
        $this->check_if_empty = false;
        return $this; //for chaining
    }
    public function check_if_empty(){
        $this->check_if_empty = true;
        return $this; //for chaining
    }

    public function check(){
        return false;
    }

    public function __construct($field_name, $params = null){
        $this->field_name = $field_name;
        $this->params = $params;
    }


}