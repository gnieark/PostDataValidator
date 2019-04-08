<?php

class Post_Rule_Url extends Post_Rule
{
    protected $method="url";
    public function check()
    {
        if(
            ((!$this->check_if_empty) && empty($_POST[ $this->field_name ]))
            || ((!$this->check_if_empty) && !isset($_POST[ $this->field_name ]))
        ){
            return true;
        }
        
        if(
              (!isset($_POST[ $this->field_name ])
            ||(!is_string($_POST[ $this->field_name ])))
        ){
            return false;
        }

        if (filter_var($_POST[ $this->field_name ], FILTER_VALIDATE_URL)) {
            return true;
        }
        return false;
    }
    public function __construct($field_name, $params = null){
        $this->field_name = $field_name;
    }
}