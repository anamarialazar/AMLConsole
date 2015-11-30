<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \stdClass;

require "src/libs/Extract.class.php"; // @todo - autoload 

class ExtractCommand extends Command {

    /**
     * Config
     */
    protected function configure() {
        $this->setName('extract')
                ->setDescription('Crawl and extract the required data')
        ;
    }
    /**
     * Execute
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        // init
        $link = "http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html";
        $selector_product = '.productInner .productInfo h3 a';
        $wanted_data = array(
            'title' => '.productTitleDescriptionContainer h1',
            'description' => '#information .productText',
            'unit_price' => '.pricePerUnit'
        );

        // extract the dta
        $data = new Extract($link, $selector_product, $wanted_data);
        if (empty($data->result)) {
            $output->writeln("The crawler has encountered an error");
        }
        $result = $this->format($data);

        // output
        $output->writeln(json_encode($result));
    }

    /**
     * Format 
     * 
     * @param stdclass $data
     * @return string
     */
    public function format($data = null) {
        if (empty($data)) {
            return "No data to format!";
        }

        $obj = new \stdClass;
        $obj->results = array();
        $obj->total = 0;
        foreach ($data->result as $key => $row) {
            $obj->results[$key] = $row;
            $obj->results[$key]['unit_price'] = (float) filter_var($row['unit_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $obj->total += $obj->results[$key]['unit_price'];
        }
        return $obj;
    }

}
