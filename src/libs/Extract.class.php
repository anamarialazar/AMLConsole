<?php
namespace Commands;
/**
 * Extract
 * @brief      Crawls the website and extracts the data provided in the DOM elements selectors.
 * @author     Ana-Maria Lazar <lazar.anamaria@gmail.com>
 * @date       26th Nov 2015
 */

// include the required libraried - @todo autoload
require 'vendor/autoload.php';

use Goutte\Client;

class Extract {

   
    protected $client;
    protected $crawler_main;

    /**
     * Entry point
     * @param string $link
     * @param string $selector
     * @param array  $list_elements
     */
    public function __construct($link = null, $selector, $list_elements = null) {
        $this->client = new Client();
        // @todo: check if link is valid
        try {
            // get the page
            $this->crawler = $this->client->request('GET', $link);
            // check if the page exists 
            $status_code = $this->client->getResponse()->getStatus();
            if ($status_code != 200) {
                return array(
                    'error' => "Status code: " . $status_code
                );
            }
        } catch (Exception $ex) {
            return array(
                'error' => "No data available at " . $link . " Error: " . json_encode($ex)
            );
        }
        $this->wanted_elements = $list_elements;
        return $this->parse($selector);
    }
    /**
     * Parser
     * 
     * @param string $selector
     * @return array
     */
    public function parse($selector) {
        // check that we are actually looking for some data
        if (empty($this->wanted_elements)){
            return array();
        }
        $this->result = array();
        //parse the dom elements that match the selector
        $elements = $this->crawler->filter($selector)->each(function ($node) {
            $temp = array();
            try {
                // check if the node exist
                if (empty($node) || empty($node->text())) {
                    return;
                }
                //get the content
                $text_selector = trim($node->text());
                //detect the link
                $link = $this->crawler->selectLink($text_selector)->link();
                // follow the link and get a new crawler
                $crawler_page = $this->client->click($link);
                $temp['size'] = $this->getDownloadSize($link->getUri());
                //get all the data from the new page
                foreach($this->wanted_elements as $key => $selector_elem){
                     $temp[$key] = trim($crawler_page->filter($selector_elem)->first()->text());
                }
                
            } catch (Exception $ex) {
                return;
            }

            return $this->result[] = $temp;
        });
    }
    
    /**
     * Get the download size
     * @param type $link
     * @return double
     */
    public function getDownloadSize($link = null){
        if (empty($link)){ // check link
            return 0;
        }
        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_exec($curl);
        return curl_getinfo($curl, CURLINFO_SIZE_DOWNLOAD);
    }

}
