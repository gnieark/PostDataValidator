<?php

class Post_Rule_Min extends Post_Rule
{
    protected $method="min";
    public function check()
    {
        if(
            ((!$this->check_if_empty) && empty($_POST[ $this->field_name ]))
            || ((!$this->check_if_empty) && !isset($_POST[ $this->field_name ]))
        )
        {
            return true;
        }
        
        if(
              (!isset($_POST[ $this->field_name ])
            ||(!is_numeric($_POST[ $this->field_name ])))
        ){
            return false;
        }
        if((int)$_POST[ $this->field_name ] >= $this->params){
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