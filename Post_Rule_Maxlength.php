<?php

class Post_Rule_Maxlength extends Post_Rule
{
    protected $method="maxlength";

    public static $type_of_param = 'int';

    public function check()
    {
        if((!$this->check_if_empty) && empty($_POST[ $this->field_name ])){
            return true;
        }
      

        if( (isset($_POST[ $this->field_name ]))
            && (strlen($_POST[ $this->field_name ]) <= $this->params)
        ){
            return true;
        }
        return false;
    }
    public function __construct($field_name, $params = null, $message = null){
        $this->field_name = $field_name;

        if (!is_int($params))
        {
            throw new \UnexpectedValueException("param must be an integer. Given: " .$params);
        }
        $this->params = $params;
        $this->set_message($message);
    }
}