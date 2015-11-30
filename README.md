AMLConsole, a simple Console Application that scraps a webpage, process some data and present it.


## Installation

 1. Clone or download the zip of AMLConsole repository.
 2. Install AMLConsole 'dependencies: `php composer.phar install` using Composer
    Note: 
    To install composer go on their website and follow the instructions to download or type in the console `curl -s https://getcomposer.org/installer | php`

## Usage

`php run.php extract`

## Run tests
The tests can be found in the "tests" folder. The directory is split in 2 folders: unit (phpunit) and functional (behat).

Run all unit tests:
'vendor/bin/phpunit' 
To test a specific section:
'vendor/bin/phpunit --testsuite commands' 

Run functional tests
'cd tests/functional'
'../../vendor/bin/behat'

## Tasks
 - consume a webpage, process some data and present it.
 - unit and / or behavioural tests.
 - link: http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html
 - README.md file in the root describing how to run the app, how to run tests and any dependencies needed from the system

- return a JSON array of all the products
        - get the size (in kb) of the linked HTML (no assets)
        - the description to display in the JSON
        - ‘title’, ‘unit_price’, ‘size’ and ‘description’ keys corresponding to items in the table.
        - a total field which is a sum of all unit prices on the page.
            Example JSON:
                ```json
                {
                 "results":[ 
                    { 
                       "title":"Sainsbury's Avocado, Ripe & Ready x2",
                       "size": "90.6kb",
                       "unit_price": 1.80,
                       "description": "Great to eat now - refrigerate at home 1 of 5 a day 1..."
                    },
                    {
                       "title":"Sainsbury's Avocado, Ripe & Ready x4",
                       "size": "87kb",
                       "unit_price": 2.00,
                       "description": "Great to eat now - refrigerate at home 1 of 5 a day 1 "
                    }
                 ],
                 "total": 3.80
                }
                ```