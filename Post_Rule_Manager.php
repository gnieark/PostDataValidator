<?php

class Post_Rule_Manager
{
    /*
    *   Somme tools to check a Form awnser with post values
    */


    private $constraints = array();

    public static $availableRules = array( //validationMethos => callbackclass
        'required'  => 'Post_Rule_Required',
        'minlength' => 'Post_Rule_Minlength',
        'maxlength' => 'Post_Rule_Maxlength',
        'rangelength' => 'Post_Rule_Rangelengh',
        'min'       => 'Post_Rule_Min',
        'max'       => 'Post_Rule_Max',
        'range'     => 'Post_Rule_Range',
        'step'      => 'Post_Rule_Step',
        'email'     => 'Post_Rule_Email',
        'url'       => 'Post_Rule_Url',
        'dateIso'   => 'Post_Rule_DateIso',
        'number'    => 'Post_Rule_Rangelengh',
        'digit'     => 'Post_Rule_Digit',
        'equalTo'    => 'Post_Rule_EqualTo'
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

    public function  get_jquery_validator_rules(){
        /*
        *   field: {
        *   required: true,
        *   maxlength: 4
        *   }
        */

        $rules = array();
        foreach($this->constraints as $constrainst)
        {
            if(!isset( $rules[ $constrainst->get_field_name() ] )){
                $rules[ $constrainst->get_field_name() ] = array();
            }
            $rules[ $constrainst->get_field_name() ] = 
                array_merge( 
                    $rules[ $constrainst->get_field_name() ],
                    $constrainst->toAssociativeArray()
                );
        }

        return json_encode( $rules);

    }

    public function add_constraint($field_name , $validatonMethod, $params = null)
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