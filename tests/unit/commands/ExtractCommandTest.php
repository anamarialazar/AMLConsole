<?php

require_once './src/Commands/ExtractCommand.class.php';

class ExtractCommandTest extends \PHPUnit_Framework_TestCase
{
    // test sum products
    public function testFormatAssert(){
        $data = new \stdClass;
        $data->result =  array(
            array(
              "size"=>39485,
              "title"=>"Sainsbury's Golden Kiwi x4",
              "description"=>"Gold Kiwi",
              "unit_price"=>"£1.80/unit",
            ),
            array(
              "size"=>39485,
              "title"=>"Sainsbury's Golden Kiwi x4",
              "description"=>"Gold Kiwi",
              "unit_price"=>"£2.00/unit",
            )
        );
       $command = new Commands\ExtractCommand();
       $result = $command->format($data);
       $this->assertEquals($result->total, 3.8);
    }
    
    // test structure
    public function testFormatHasTotalField(){
        $data = new \stdClass;
        $data->result =  array(
            array(
              "size"=>39485,
              "title"=>"Sainsbury's Golden Kiwi x4",
              "description"=>"Gold Kiwi",
              "unit_price"=>"£1.80/unit",
            )
        );
       $command = new Commands\ExtractCommand();
       $result = $command->format($data);
       $this->assertObjectHasAttribute("total",$result);
    }
}
