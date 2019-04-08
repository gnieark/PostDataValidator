<?php

class Post_Rule_Required extends Post_Rule
{
    public function check()
    {
        if(isset($_POST[ $this->field_name ])){
            return true;
        }
        return false;
    }
    public function __construct($field_name, $params = null){
        $this->field_name = $field_name;
    }
}