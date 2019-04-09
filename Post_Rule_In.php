<?php

class Post_Rule_In extends Post_Rule
{
    protected $method="in";

    public static $type_of_param = 'arrayofstring';

    public function check()
    {
        if((!$this->check_if_empty) && empty($_POST[ $this->field_name ])){
            return true;
        }

        if( isset($_POST[ $this->field_name ])
            &&  in_array($_POST[ $this->field_name ], $this->params)
        ){
            return true;
        }

        return false;
    
    }
    public function __construct($field_name, $params = null , $message = null){

        $this->field_name = $field_name;
        if(!is_array($params)){
            throw new \UnexpectedValueException("param must be an array" );
        }
        $this->params = $params;
        $this->set_message($message);
    }
}