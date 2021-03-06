<?php

use PHPUnit\Framework\TestCase;

class Post_Rule_Test extends TestCase
{


    public function testRuleRequiredMissing(){
        $p = new Post_Rule_Required("plop");
        $this->assertFalse($p->check());
    }

    public function testRuleRequiredPresent(){
        unset($_POST['plop']);
        $_POST["plop"] = "";
        $p = new Post_Rule_Required("plop");
        $this->assertTrue($p->check());
    }
    public function testMinlenght(){
        unset($_POST['plop']);
        $p=new Post_Rule_Minlength('plop', 2);
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());
        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "ab";
        $this->assertTrue($p->check());
    }
    public function testMaxLenght(){
        unset($_POST['plop']);
        $p=new Post_Rule_Maxlength('plop', 4);
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertTrue($p->check());
        $_POST['plop'] = "abcd";
        $this->assertTrue($p->check()); 
        $_POST['plop'] = "abcde";
        $this->assertFalse($p->check()); 
    }
    public function testRangeLength(){
        unset($_POST['plop']);

        $p = new Post_Rule_Rangelenght('plop', array(5,8));

        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());


        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "abcde";
        $this->assertTrue($p->check());
        $_POST['plop'] = "abcdef";
        $this->assertTrue($p->check());
        $_POST['plop'] = "abcdefghijklmnop";
        $this->assertFalse($p->check());

    }
    public function testMin()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Min('plop', 2);

        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "1";
        $this->assertFalse($p->check());
        $_POST['plop'] = 1;
        $this->assertFalse($p->check());

        $_POST['plop'] = "2";
        $this->assertTrue($p->check());
        $_POST['plop'] = 2;
        $this->assertTrue($p->check());
    }

    public function testMax()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Max('plop', 2);
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "3";
        $this->assertFalse($p->check());
        $_POST['plop'] = 3;
        $this->assertFalse($p->check());

        $_POST['plop'] = "1";
        $this->assertTrue($p->check());
        $_POST['plop'] = 1;
        $this->assertTrue($p->check());
    }

    public function testRange()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Range('plop', array(5, 10));
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "3";
        $this->assertFalse($p->check());
        $_POST['plop'] = 3;
        $this->assertFalse($p->check());

        $_POST['plop'] = "6";
        $this->assertTrue($p->check());
        $_POST['plop'] = 6;
        $this->assertTrue($p->check());

        $_POST['plop'] = "13";
        $this->assertFalse($p->check());
        $_POST['plop'] = 13;
        $this->assertFalse($p->check());
    }
    public function testRule_Step()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Step('plop', 8);
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "3";
        $this->assertFalse($p->check());
        $_POST['plop'] = 3;
        $this->assertFalse($p->check());

        $_POST['plop'] = "16";
        $this->assertTrue($p->check());
        $_POST['plop'] = 16;
        $this->assertTrue($p->check());

        $_POST['plop'] = "4";
        $this->assertFalse($p->check());
        $_POST['plop'] = 4;
        $this->assertFalse($p->check());
    }


    public function testRule_Email()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Email('plop');
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "tinad.fr";
        $this->assertFalse($p->check());
        $_POST['plop'] = 3;
        $this->assertFalse($p->check());

        $_POST['plop'] = "user@local.host";
        $this->assertTrue($p->check());
        $_POST['plop'] = "john.doe@example.com";
        $this->assertTrue($p->check());

    }
    public function testRule_Url()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Url('plop');
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "tinad.fr";
        $this->assertFalse($p->check());
        $_POST['plop'] = 3;
        $this->assertFalse($p->check());

        $_POST['plop'] = "https://local.host";
        $this->assertTrue($p->check());
        $_POST['plop'] = "file://plop.txt";
        $this->assertTrue($p->check());

    }
    

    public function testRule_DateIso()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_DateIso('plop');
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "01/01/1990";
        $this->assertFalse($p->check());
        $_POST['plop'] = "2020/20/31";
        $this->assertFalse($p->check());

        $_POST['plop'] = "2020-12-12";
        $this->assertTrue($p->check());
        $_POST['plop'] = "1845-01-01";
        $this->assertTrue($p->check());

    }

    public function testRule_Number()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Number('plop');
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "1,6";
        $this->assertFalse($p->check());
        $_POST['plop'] = "2020/20/31";
        $this->assertFalse($p->check());

        $_POST['plop'] = "1. 6";
        $this->assertFalse($p->check());

        $_POST['plop'] = "1.6";
        $this->assertTrue($p->check());
        $_POST['plop'] = "1";
        $this->assertTrue($p->check());
        $_POST['plop'] = 1.6;
        $this->assertTrue($p->check());
        $_POST['plop'] = 5;
        $this->assertTrue($p->check());
        $_POST['plop'] = ".5";
        $this->assertTrue($p->check());

    }
    public function testRule_Digits()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Digits('plop');
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plop'] = "1,6";
        $this->assertFalse($p->check());
        $_POST['plop'] = "2020/20/31";
        $this->assertFalse($p->check());

        $_POST['plop'] = "a1. 6";
        $this->assertFalse($p->check());

        $_POST['plop'] = "16";
        $this->assertTrue($p->check());
        $_POST['plop'] = "1";
        $this->assertTrue($p->check());
        $_POST['plop'] = 16;
        $this->assertTrue($p->check());
        $_POST['plop'] = 5;
        $this->assertTrue($p->check());
        $_POST['plop'] = "5";
        $this->assertTrue($p->check());

    }

    public function testRule_EqualTo()
    {
        unset($_POST['plop']);
        unset($_POST['plip']);
        $p = new Post_Rule_EqualTo('plop', 'plip');
        
        $this->assertTrue($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertTrue($p->check());

        $_POST['plop'] = "a";
        $this->assertFalse($p->check());
        $_POST['plip'] = "1,6";
        $this->assertFalse($p->check());
        unset($_POST['plop']);
        $this->assertFalse($p->check());

        unset($_POST['plip']);
        $this->assertTrue($p->check());
        $_POST['plip'] = "";
        $_POST['plop'] = "";
        $this->assertTrue($p->check());
        $_POST['plip'] = "hey\nhey";
        $_POST['plop'] = "hey\nhey";
        $this->assertTrue($p->check());


    }

    public function testIn(){
     
        unset($_POST['plop']);
        
        $p = new Post_Rule_In('plop', array('banana', 'apple', 'kiwis'));
        
        $this->assertFalse($p->check());
        $p->dont_check_if_empty();
        $this->assertTrue($p->check());
        $p->check_if_empty();
        $this->assertFalse($p->check());

        $_POST['plop'] = "coins";
        $this->assertFalse($p->check());
 
        $_POST['plop'] = "apple";
        $this->assertTrue($p->check());

        $p = new Post_Rule_In('plop', array(5,9,8));

        $_POST['plop'] = "coins";
        $this->assertFalse($p->check());

        $_POST['plop'] = 3;
        $this->assertFalse($p->check());

        $_POST['plop'] = 9;
        $this->assertTrue($p->check());

    }

    function testMessages()
    {

        $availableRules = Post_Rule_Manager::$availableRules;
        foreach ($availableRules as $rule)
        {
           
            switch ($rule::$type_of_param){
                case 'null':
                    $param = null;
                    break;
                case 'string':
                    $param ="kjhkjlhgjhgf";
                    break;
                case 'arrayofstring':
                    $param = array('kjhkhy','kglgssqs','54:l');
                    break;
                case 'arrayofint':
                    $param = array(54,98,3);
                    break;
                case 'int':
                    $param = rand(1,6666);
                    break;
                default:
                    return false;
                    break;
            }

            $message = uniqid();
            $obj = new $rule('plop',$param,$message);
            $backMessage = $obj->get_error_message_on_assoc_array();     
            $this->assertEquals( $message , $backMessage[ $obj->get_method() ]);
            
        }

    }


    public function testManager()
    {
        unset($_POST['plop']);

        $p = new Post_Rule_Manager();
        $p  ->add_constraint('plop' , 'required', null)
            ->add_constraint('plop','min',2)
            ->add_constraint('user','minlength',4)
            ->add_constraint('old','range',array(7,77));
        
        $this->assertFalse($p->check());
        $_POST['plop'] = "1";
        $this->assertFalse($p->check());
        $_POST['plop'] = "2";
        $this->assertFalse($p->check());
        
        $out = $p->get_jquery_validator_rules();
        $this->assertEquals($out["plop"]["min"],2);

        $_POST["user"] = "HeyHey";
        $_POST["old"] = 15;
        $this->assertTrue($p->check());
        $_POST["old"] = 6;
        $this->assertFalse($p->check());
    }

}