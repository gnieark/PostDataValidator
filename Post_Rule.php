<?php
class Post_Rule
{
    /*
    * This is the parent class. (will allways return false on check).
    * Childs class should really make rules tests
    */

    protected $field_name;
    protected $params;
    protected $method;

    protected $custom_message;

    public static $type_of_param = 'null';
    

    /*
    * check_if_empty
    * When true, var is checcked as an empty string. It may pass or not the rule test
    * When check_if_empty is false the check will return true if it's empty
    */
    protected $check_if_empty = true;

    public function get_field_name(){
        return $this->field_name;
    }

    public function get_method(){
        return $this->method;
    }
    public function dont_check_if_empty(){
        $this->check_if_empty = false;
        return $this; //for chaining
    }

    public function check_if_empty(){
        $this->check_if_empty = true;
        return $this; //for chaining
    }

    public function check(){
        return false;
    }

    public function __construct($field_name, $params = null , $message = null){
        $this->field_name = $field_name;
        $this->params = $params;
        $this->set_message($message);
    }

    public function set_message($message){
        if(!is_null($message)){
            $this->custom_message = $message;
        }
        return $this; //for chaining
    }
    
    public function get_error_message_on_assoc_array()
    {
        return array($this->method =>  $this->get_error_message());
    }

    public function get_error_message(){
        if(empty($this->custom_message)){
            return "Inconrect value for " . $this->field_name;
        }else{
            return $this->custom_message;
        }
    }
    /*
    * Generate the rule string on the JS JQUERY validation form
    * Will work most of times, erase it on childs class when specific
    */
    public function __toString()
    {
        if(is_null($this->params)){
            $parameter = "true";
        }elseif(is_array($this->params)){
            $parameter = json_encode($this->params);
        }else{
            $parameter = $this->params;
        }
        return $this->method . ": " . $parameter ;
    }
    public function to_associative_array()
    {
        if(is_null($this->params)){
            $parameter = "true";
        }else{
            $parameter = $this->params;
        }
        return array($this->method => $parameter) ;
    }
}