Feature: _User_
  Background:
    Given the following fixtures files are loaded:
      | parameters     |
      | users          |

  Scenario: POST USER
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

  Scenario: GET USERS
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I request "GET /users"
    When the response status code should be 200
    Then print last response

  Scenario: GET CURRENT USER
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I request "GET /current_user"
    When the response status code should be 200
    Then print last response


  Scenario: GET USER BY ID
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I request "GET /users/{{recruiter_1.id}}"
    When the response status code should be 200
    Then print last response


  Scenario: DELETE USER BY ID
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I request "DELETE /users/{{recruiter_1.id}}"
    When the response status code should be 204
    Then print last response


  Scenario: PUT USER BY ID
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I have the payload
    """
    {
       "firstname": "Omar",
       "lastname": "ABDALLA",
       "genre": "F",
       "photo": "string",
       "address": "string",
       "city": "string",
       "email": "string",
       "roles": [
          "ROLE_RECRUITER"
        ],
       "password": "toto"
    }
    """
    Given I request "PUT /users/{{recruiter_1.id}}"
    When the response status code should be 200
    Then print last response

  Scenario: PUT USER BY ID INVALID 403
    Given I authenticate with user "applicant@gmail.com" and password "toto"
    Given I have the payload
    """
    {
       "firstname": "Omar",
       "lastname": "ABDALLA",
       "genre": "F",
       "photo": "string",
       "address": "string",
       "city": "string",
       "email": "string",
       "roles": [
          "ROLE_RECRUITER"
        ],
       "password": "toto"
    }
    """
    Given I request "PUT /users/{{recruiter_1.id}}"
    When the response status code should be 403

  Scenario: LOGIN 200
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

  Scenario: LOGIN 401 Invalid credentials.
    Given I have the payload
    """
    {
      "email": "api",
      "password": "api"
    }
    """
    Given I request "POST /authentication_token"
    When the response status code should be 401
