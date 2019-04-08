<?php

class Post_Rule_DateIso extends Post_Rule
{
    protected $method="dateIso";

    public function check()
    {
        // NOTE: jquery validator dateISO , it's not ISO, just AAAA-MM-DD
        // for compatibility, we do the same
        if(
            ((!$this->check_if_empty) && empty($_POST[ $this->field_name ]))
            || ((!$this->check_if_empty) && !isset($_POST[ $this->field_name ]))
        )
        {
            return true;
        }
        
        if(
              (!isset($_POST[ $this->field_name ])
            ||(!is_string($_POST[ $this->field_name ])))
        ){
            return false;
        }

        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$_POST[ $this->field_name ])) {
            return true;
        } 
        return false;
    }
    public function __construct($field_name, $params = null){
        $this->field_name = $field_name;
    }
}