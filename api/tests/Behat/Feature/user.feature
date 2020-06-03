Feature: _User_
  Background:
    Given the following fixtures files are loaded:
      | parameters     |
      | users          |

  Scenario: test create user
    Given I have the payload
    """
    {
      "firstname": "test",
      "lastname": "test",
      "genre": "1",
      "photo": "",
      "address": " rue test",
      "city": "test",
      "email": "test@test.fr",
      "roles": [
        "ROLE_APPLICANT"
      ],
      "password": "test"
    }
    """
    Given I request "POST /users"
    When the response status code should be 201
    Then print last response

  Scenario: test login 200
    Given I have the payload
    """
    {
      "email": "recruiter@gmail.com",
      "password": "toto"
    }
    """
    Given I request "POST /authentication_token"
    When the response status code should be 200
    Then print last response

  Scenario: test login 401
    Given I have the payload
    """
    {
      "email": "api",
      "password": "api"
    }
    """
    Given I request "POST /authentication_token"
    When the response status code should be 401
