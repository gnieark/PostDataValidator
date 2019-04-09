<?php

class Post_Rule_Rangelenght extends Post_Rule
{
    protected $method="rangelength";

    public static $type_of_param = 'arrayofint';
    
    public function check()
    {
        if((!$this->check_if_empty) && empty($_POST[ $this->field_name ])){
            return true;
        }

        $minlenghtRule = new Post_Rule_Minlength($this->field_name, $this->params[0]);
        $maxlenghtRule = new Post_Rule_Maxlength($this->field_name, $this->params[1]);
        return ($minlenghtRule->check() && $maxlenghtRule->check());
    }
    
    public function __construct($field_name, $params = null , $message = null){
        $this->field_name = $field_name;
        if(
            (isset($params[0]))
            && (isset($params[1]))
            && (is_int($params[0]))
            && (is_int($params[1]))
        ){
            $this->params = $params;
        }else{
            throw new \UnexpectedValueException("param must be an array containing two integers, min and max" );
        }
        $this->set_message($message);
    }
}