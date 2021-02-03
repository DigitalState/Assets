@api @asset @edit
Feature: Edit assets

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit an asset
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/assets/03012aa6-e87d-45df-8715-c2f49dbca460" with body:
    """
    {
      "createdAt": "2000-01-01 12:00:00",
      "title": {
        "en": "Animal License - edit",
        "fr": "Permis animalier - edit"
      },
      "data": {
        "id": 2,
        "type": "dog - edit"
      },
      "version": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "createdAt" should be equal to the string "2000-01-01T12:00:00+00:00"
    And the JSON node "title.en" should be equal to "Animal License - edit"
    And the JSON node "title.fr" should be equal to "Permis animalier - edit"
    And the JSON node "data.id" should be equal to "2"
    And the JSON node "data.type" should be equal to "dog - edit"
    And the JSON node "version" should be equal to the number 2

  Scenario: Confirm the edited asset
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/assets/03012aa6-e87d-45df-8715-c2f49dbca460"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "createdAt" should be equal to the string "2000-01-01T12:00:00+00:00"
    And the JSON node "title.en" should be equal to "Animal License - edit"
    And the JSON node "title.fr" should be equal to "Permis animalier - edit"
    And the JSON node "data.id" should be equal to "2"
    And the JSON node "data.type" should be equal to "dog - edit"
    And the JSON node "version" should be equal to the number 2

  Scenario: Edit an asset's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/assets/03012aa6-e87d-45df-8715-c2f49dbca460" with body:
    """
    {
      "id": 9999,
      "uuid": "023ef9b1-64e5-48cb-b367-6a4d09ad3161",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00",
      "tenant": "40048804-8d66-4d48-b553-3833a5a06749"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "03012aa6-e87d-45df-8715-c2f49dbca460"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited asset
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/assets/03012aa6-e87d-45df-8715-c2f49dbca460"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "03012aa6-e87d-45df-8715-c2f49dbca460"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit an asset with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/assets/03012aa6-e87d-45df-8715-c2f49dbca460" with body:
    """
    {
      "identityUuid": "d83ec028-0805-454f-b1bc-d0f658d1c41f",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
