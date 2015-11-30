<?php


use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException,
    Behat\Behat\Context\Step;

use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext{


    /**
     * @Given /^I am on the link "([^"]*)"$/
     */
    public function iAmOnTheLink($link) {
        $this->getSession()->visit($this->locatePath($link));
    }

    /**
     * @Then /^I should see the selector "([^"]*)"$/
     */
    public function iShouldSeeTheSelector($selector) {
        $page = $this->getSession()->getPage();
        $element = $page->findAll('css', $selector);
        if (empty($element)) {
            throw new Exception("The selector does not exist:\n");
        }
    }
    // check that given a specific selector it exists on the specified link
    // check that the product page exists
    // check that the product title/price exists


}
