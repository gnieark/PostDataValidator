<?php

class Post_Rule_Number extends Post_Rule
{
    /*
    * EG is float
    */

    protected $method="number";

    public static $type_of_param = 'null';
    
    public function check()
    {
       
        if(
            ((!$this->check_if_empty) && empty($_POST[ $this->field_name ]))
            || ((!$this->check_if_empty) && !isset($_POST[ $this->field_name ]))
        )
        {
            return true;
        }
        
        if(!isset($_POST[ $this->field_name ])){
            return false;
        }
        
        if (is_float($_POST[ $this->field_name ])) {
            return true;
        }
        if(preg_match(("/^\d*\.?\d*$/"), $_POST[ $this->field_name ])){
            return true;
        }
        return false;
       
    }
    public function __construct($field_name, $params = null , $message = null){
        $this->field_name = $field_name;
        $this->set_message($message);
    }
}