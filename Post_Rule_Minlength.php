<?php

class Post_Rule_Minlength extends Post_Rule
{
    protected $method="minlength";

    public function check()
    {
        if((!$this->check_if_empty) && empty($_POST[ $this->field_name ])){
            return true;
        }

        if( (isset($_POST[ $this->field_name ]))
            && (strlen($_POST[ $this->field_name ]) >= $this->params)
        ){
            return true;
        }

        return false;
    }
    public function __construct($field_name, $params = null){
        $this->field_name = $field_name;
        if(!is_int($params)){
            throw new \UnexpectedValueException("param must be an integer. Given: " .$params);
        }
        $this->params = $params;
    }
}