Feature: _Offer_
  Background:
    Given the following fixtures files are loaded:
      | parameters     |
      | users     |
      | offers     |

  Scenario: Create new Offer 200
    Given I authenticate with user "recruiter@gmail.com" and password "toto"
    Given I have the payload
    """
    {
      "name": "Google - 200k",
      "companyDescription": "The best company !",
      "offerDescription": "Dev Fullstack NY",
      "beginAt": "2020-06-03T17:36:44.660Z",
      "contractType": "CDI",
      "place": "New York"
    }
    """
    Given I request "POST /offers"
    When the response status code should be 201

  Scenario: Create new Offer unauthorized role 403
    Given I authenticate with user "applicant@gmail.com" and password "toto"
    Given I have the payload
    """
    {
      "name": "Google - 200k",
      "companyDescription": "The best company !",
      "offerDescription": "Dev Fullstack NY",
      "beginAt": "2020-06-03T17:36:44.660Z",
      "contractType": "CDI",
      "place": "New York"
    }
    """
    Given I request "POST /offers"
    When the response status code should be 403

  Scenario: Create new Offer not authenticated
    Given I authenticate with user "test@gmail.com" and password "toto"
    Given I have the payload
    """
    {
      "name": "Google - 200k",
      "companyDescription": "The best company !",
      "offerDescription": "Dev Fullstack NY",
      "beginAt": "2020-06-03T17:36:44.660Z",
      "contractType": "CDI",
      "place": "New York"
    }
    """
    Given I request "POST /offers"
    When the response status code should be 401
