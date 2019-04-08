<?php

class Post_Rule_Range extends Post_Rule
{
    protected $method="range";
    
    public function check()
    {
        if((!$this->check_if_empty) && empty($_POST[ $this->field_name ])){
            return true;
        }
        $minRule = new Post_Rule_Min($this->field_name, $this->params[0]);
        $maxRule = new Post_Rule_Max($this->field_name, $this->params[1]);

        return ( $minRule->check() && $maxRule->check() );

    }
    public function __construct($field_name, $params = null){
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
    }
}