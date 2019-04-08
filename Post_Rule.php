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

    public function __construct($field_name, $params = null){
        $this->field_name = $field_name;
        $this->params = $params;
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
    public function toAssociativeArray()
    {
        if(is_null($this->params)){
            $parameter = "true";
        }else{
            $parameter = $this->params;
        }
        return array($this->method => $parameter) ;
    }
}