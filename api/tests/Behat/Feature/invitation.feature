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

#  Scenario: test create invitation
#    Given I authenticate with user "recruiter@gmail.com" and password "toto"
#    Given I have the payload
#    """
#      {
#        "email": "applicant@gmail.com",
#        "offer": "/offers/1"
#      }
#    """ 
#    Given I request "POST /invitations"
#    Then the response status code should be 201
#    Then print last response
