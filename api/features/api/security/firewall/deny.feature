@api @security @firewall @deny
Feature: Deny access to non-authenticated users to protected endpoints

  @upMigrations @loadFixtures @downMigrations
  Scenario: Browse accesses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And the JSON node "code" should exist
    And the JSON node "code" should be equal to the number 401
    And the JSON node "message" should exist
    And the JSON node "message" should be equal to "JWT Token not found"
