<?php

class Post_Rule_Manager
{
    /*
    *   Somme tools to check a Form awnser with post values
    */


    private $constraints = array();



    public function add_field_constraint($field_name , $validatonMethod, $params = null)
    {
        switch ($validatonMethod)
        {
            case "rangelenght":
                $this->constrainsts[] = new Post_Rule_Rangelenght($field_name,$params);
                break;
            case "maxlenght":
                $this->constrainsts[] = new Post_Rule_Minlenght($field_name,$params);
                break;
            case "minlenght":
                $this->constrainsts[] = new Post_Rule_Minlenght($field_name,$params);
                break;
            case "required":
                $this->constraints[] = new Post_Rule_Required($field_name,null);
                break;
            default:
                throw new \UnexpectedValueException("Unknowed validation method given " . $validatonMethod);
                break;
        }

    }

}