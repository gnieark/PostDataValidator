<?php

class Post_Rule_Required extends Post_Rule
{
    protected $method="required";
    
    public static $type_of_param = 'null';
    
    public function check()
    {
        if(isset($_POST[ $this->field_name ])){
            return true;
        }
        return false;
    }
    public function __construct($field_name, $params = null , $message = null){
        $this->field_name = $field_name;
        $this->set_message($message);
    }
}