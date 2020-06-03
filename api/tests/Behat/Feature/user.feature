Feature: _User_
  Background:
    Given the following fixtures files are loaded:
      | parameters     |
      | users          |

  Scenario: test create user
    Given I have the payload
    """
    {
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
    }
    """
    Given I request "POST /users"
    When the response status code should be 201
    Then print last response

