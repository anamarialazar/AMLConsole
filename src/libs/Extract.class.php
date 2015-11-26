<?php
/**
 * Extract
 * @brief      Crawls the website and extracts the data provided in the DOM elements selectors.
 * @author     Ana-Maria Lazar <lazar.anamaria@gmail.com>
 * @date       26th Nov 2015
 */

// include the required libraried
require 'vendor/autoload.php';
use Goutte\Client;


class Extract{
    protected $client;
    protected $crawler_main;
    
    /**
     * Entry point
     * @param string $link
     * @param array  $list_elements
     */
    public function __construct($link = null, $list_elements = null){
        $this->client = new Client();
        // check link
        
        try{
            // get the page
            $this->crawler = $this->client->request('GET', $link);
            // check if the page exists 
            $status_code = $this->client->getResponse()->getStatus();
            if($status_code!=200){
                return array(
                 'error' => "Status code: ".$status_code
                );
            }
        }catch(Exception $ex){
           return array(
            'error' => "No data available at ".$link." Error: ".json_encode($ex)
           );
        }
        return $this->parse($list_elements);
    }
    
    /*
     * 
     */
    public function parse($list_element){
        $result = array();
        //get products
        $elements = $this->crawler->filter($list_element)->each(function ($node) {
            $result = array();
            if (empty($node) || empty($node->text())){
                return $result;
            }
           
            try{
                $link = $this->crawler->selectLink($node->text())->link();
                // go the product page
                $crawler_page = $this->client->click($link);
                // get the data
                $product = $crawler_page->filter();
                $result['URL'] = "an url...";
            }catch(Exception $ex){
                $result['Error'] = "No data";
               return;
            }
            
            return $result;
        });
    }
}