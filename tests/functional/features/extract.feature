Feature: Extract
    Scenario: A user should see "Ripe & ready!" when they are on the fruit page link
        Given I am on the link "http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html"
        Then I should see the selector "#productLister"
        
   