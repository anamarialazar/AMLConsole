<?php

require_once './src/libs/Extract.class.php';

class ExtractTest extends \PHPUnit_Framework_TestCase
{

    public function testResultsExist(){
       $link = "http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html";
       $selector_product = '.productInner .productInfo h3 a';
       $wanted_data = array(
            'title' => '.productTitleDescriptionContainer h1',
            'description' => '#information .productText',
            'unit_price' => '.pricePerUnit'
       
       );
       
       // extract the dta
       $data = new Commands\Extract($link, $selector_product, $wanted_data);
       $this->assertObjectHasAttribute("result",$data);
    }

}
