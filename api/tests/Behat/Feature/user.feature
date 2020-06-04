Feature: _User_
  Background:
    Given the following fixtures files are loaded:
      | parameters     |
      | users          |

  Scenario: test create user
    Given I have the payload
    """
    {
<<<<<<< HEAD
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
=======
        email: "test@test.com",
        password: "$argon2id$v=19$m=65536,t=4,p=1$cMH2swfacaqZCwGA5JWOPA$J09JznitkqUp0uGDsslacn63HhhNEikbhjbZtuYm4ns",
        firstname: "PLIP",
        lastname: "PLIP",
        genre: 1,
        photo: "",
        address: "3 Rue de la Paix",
        city: "Paris",
        roles: [
          "ROLE_RECRUITER"
        ]
>>>>>>> ca45a174b8a4a89c7e7f8b3067a4968a914df513
    }
    """
    Given I request "POST /users"
    When the response status code should be 201
    Then print last response

<<<<<<< HEAD
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
=======
>>>>>>> ca45a174b8a4a89c7e7f8b3067a4968a914df513
