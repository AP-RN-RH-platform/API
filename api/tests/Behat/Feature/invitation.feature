Feature: _Invitation_
  Background:
    Given the following fixtures files are loaded:
      | parameters     |
      | invitations    |
      | users          |
      | offers         |

  Scenario: test get all invitations
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I request "GET /invitations"
    Then the response status code should be 200
    Then print last response

  Scenario: test create invitation
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I have the payload
    """
    {
      "email": "test@test.com",
      "offer": "/offers/{{offer_1.id}}"
    }
    """ 
    Given I request "POST /invitations"
    Then the response status code should be 201
    Then print last response

  Scenario: test get an invitations
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I request "GET /invitations/{{invitation_1.id}}"
    Then the response status code should be 200
    Then print last response

  Scenario: test update invitation
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I have the payload
    """
    {
      "email": "test@test.com",
      "offer": "/offers/{{offer_1.id}}"
    }
    """ 
    Given I request "PUT /invitations/{{invitation_1.id}}"
    Then the response status code should be 200
    Then print last response

  Scenario: test delete invitation
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I request "DELETE /invitations/{{invitation_1.id}}"
    Then the response status code should be 204
    Then print last response

  Scenario: get offer from token
    Given I authenticate with user "test@test.com" and password "toto"
    Given I request "GET /send_invitation/{{invitation_1.token}}"
    Then the response status code should be 200
    Then print last error