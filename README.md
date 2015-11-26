Usage examples of Symfony components
Installation

Clone the repository
Install the dependencies with composer:
    To install composer:
        curl -s https://getcomposer.org/installer | php
        php composer.phar install

Run Tests

Run Command


@tasks
 consume a webpage, process some data and present it.
 console application 
 unit and / or behavioural tests.
 link:http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html
 README.md file in the root describing how to run the app, how to run tests and any dependencies needed from the system

- return a JSON array of all the products
        - get the size (in kb) of the linked HTML (no assets)
        - the description to display in the JSON
        - ‘title’, ‘unit_price’, ‘size’ and ‘description’ keys corresponding to items in the table.
        - a total field which is a sum of all unit prices on the page.
            Example JSON:
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