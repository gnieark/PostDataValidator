<?php

class Post_Rule_Manager
{
    /*
    *   Somme tools to check a Form awnser with post values
    */


    private $constraints = array();

    public static $availableRules = array( 

        'required'  => 'Post_Rule_Required',
        'minlength' => 'Post_Rule_Minlength',
        'maxlength' => 'Post_Rule_Maxlength',
        'rangelength' => 'Post_Rule_Rangelenght',
        'min'       => 'Post_Rule_Min',
        'max'       => 'Post_Rule_Max',
        'range'     => 'Post_Rule_Range',
        'step'      => 'Post_Rule_Step',
        'email'     => 'Post_Rule_Email',
        'url'       => 'Post_Rule_Url',
        'dateIso'   => 'Post_Rule_DateIso',
        'number'    => 'Post_Rule_Number',
        'digit'     => 'Post_Rule_Digits',
        'equalTo'    => 'Post_Rule_EqualTo',
        'in'        => 'Post_Rule_In'
    );

    public function check()
    {
        foreach($this->constraints as $constrainst)
        {
            if($constrainst->check() === false){
                return false;
            }
            
        }
        return true;
    }

    public function get_jquery_validate_code($formId){
        return
        '$("#' . $formId . '")validate({
            rules: ' . json_encode($this -> get_jquery_validator_rules(), true) . ',
            messages: ' .json_encode($this-> get_jquery_validator_messages(), true) . '
        });';

    }

    public function get_jquery_validator_messages(){

        return array();
    }
    public function get_jquery_validator_rules()
    {

        $rules = array();
        foreach($this->constraints as $constrainst)
        {
            if(!isset( $rules[ $constrainst->get_field_name() ] )){
                $rules[ $constrainst->get_field_name() ] = array();
            }
            $rules[ $constrainst->get_field_name() ] = 
                array_merge( 
                    $rules[ $constrainst->get_field_name() ],
                    $constrainst->to_associative_array()
                );
        }

        return $rules;

    }

    public function add_constraint($field_name , $validatonMethod, $params = null, $message = null)
    {
        if(!isset(self::$availableRules[$validatonMethod]))
        {
            throw new \UnexpectedValueException("Unknowed validation method given " . $validatonMethod);
        }
        $ruleClass = self::$availableRules[ $validatonMethod ];
        $this->constraints[] = new $ruleClass($field_name,$params);

        return $this;
    }

}