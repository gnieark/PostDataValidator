<?php

class Post_Rule_EqualTo extends Post_Rule
{
    protected $method="equalTo";

    public static $type_of_param = 'string';

    public function check()
    {
        if(
            ((!$this->check_if_empty)    && empty($_POST[ $this->field_name ]))
            || ((!$this->check_if_empty) && !isset($_POST[ $this->field_name ]))
        )
        {
            return true;
        }
        

        if(empty($_POST[ $this->field_name ]) && empty($_POST[ $this->params]) )
        {
            return true;
        }
        
        if((!isset($_POST[ $this->params]))  || (!isset($_POST[ $this->field_name]))){
            return false;
        }

        if($_POST[ $this->field_name ] == $_POST[ $this->params] )
        {
            return true;
        }

        return false;
    }

    public function to_associative_array()
    {
        return array($this->method => "#" . $this->params) ;
    }


    public function __construct($field_name, $params = null , $message = null){

        $this->field_name = $field_name;
        if(!is_string($params)){
            throw new \UnexpectedValueException("param must be a string" );
        }
        $this->params = $params;
        $this->set_message($message);
    }
}