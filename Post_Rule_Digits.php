<?php

class Post_Rule_Digits extends Post_Rule
{

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
        
        if (is_int($_POST[ $this->field_name ])) {
            return true;
        }
        if(preg_match(("/^\d+$/"), $_POST[ $this->field_name ])){
            return true;
        }
        return false;
       
    }
    public function __construct($field_name, $params = null){
        $this->field_name = $field_name;
    }
}