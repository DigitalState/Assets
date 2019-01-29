@api @asset @delete
Feature: Delete assets

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete an asset
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/assets/03012aa6-e87d-45df-8715-c2f49dbca460"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted asset
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/assets/03012aa6-e87d-45df-8715-c2f49dbca460"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted asset
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/assets/03012aa6-e87d-45df-8715-c2f49dbca460"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
