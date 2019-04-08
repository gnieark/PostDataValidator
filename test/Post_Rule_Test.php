<?php

use PHPUnit\Framework\TestCase;

class Post_Rule_Test extends TestCase
{

    public function testInitiatepostFormObject(){
        $p = new Post_Rule_Manager();
        $this->assertSame(true,true);
    }

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


}