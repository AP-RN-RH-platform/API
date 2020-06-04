Feature: _Application_
  Background:
    Given the following fixtures files are loaded:
      | parameters     |
      | application    |
      | users          |
      | offers         |
      | mediaobjects    |


  Scenario: create application
    Given I authenticate with user "applicant@gmail.com" and password "toto"
    Given I have the payload
      """
      {
          "firstname":"test",
          "lastname":"test",
          "email": "test@test.fr",
          "sex": true,
          "age": 18,
          "address": "Rue du jardin",
          "city": "Rue du jardin",
          "motives": "Rue du jardin",
          "expectedSalary": 45000,
          "status":"Waiting",
          "offer": "/offers/{{ offer_1.id }}"
      }
      """
    When I request "POST /applications"
    Then the response status code should be 201
    Then print last response

  Scenario: GET application
    Given I authenticate with user "applicant@gmail.com" and password "toto"
    Given I request "GET /applications"
    Then the response status code should be 200
    Then print last response

  Scenario: GET application By Id
    Given I authenticate with user "applicant@gmail.com" and password "toto"
    Given I request "GET /applications/{{application_1.id}}"
    Then the response status code should be 200
    Then print last response

  Scenario: PUT application By Id
    Given I authenticate with user "applicant@gmail.com" and password "toto"
    Given I have the payload
      """
     {
      "lastname": "test",
      "firstname": "test",
      "sex": true,
      "email": "test@test.fr",
      "age": 0,
      "address": "test",
      "city": "test",
      "motives": "test",
      "expectedSalary": 0,
      "status": "Waitting"
    }
      """
    When I request "PUT /applications/{{application_1.id}}"
    Then the response status code should be 200
    Then print last response


  Scenario: DELETE application By Id
    Given I authenticate with user "applicant@gmail.com" and password "toto"
    Given I request "DELETE /applications/{{application_1.id}}"
    Then the response status code should be 204
    Then print last response
