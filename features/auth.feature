@auth

Feature: User login and registration

  Background: Application is initialized
    Given initialized application

  Scenario: As unregistered user, I want to register so I can login and retrieve access token
    When "POST" request is sent to "/api/register" route with body:
      | key                  | value            |
      | email                | test@example.com |
      | password             | secret           |
      | passwordConfirmation | secret           |
    And response should exist
    And response should have "200" status
    And response should have "0" errors
    And response should contain:
      | key                 |
      | body                |
      | body.user           |
      | body.user.name      |
      | body.user.email     |
      | body.user.active    |
      | body.user.createdAt |
      | errors              |

  Scenario: As registered user, I want to login so I can retrieve access token
    Given user with "test@example.com" email and "secret" password is registered
    When "POST" request is sent to "/api/login" route with body:
      | key      | value            |
      | email    | test@example.com |
      | password | secret           |
    And response should exist
    And response should have "200" status
    And response should have "0" errors
    And response should contain:
      | key              |
      | body             |
      | body.accessToken |
      | errors           |

  Scenario: As registered user, I want to activate my account to be able to login
    Given user with "test@example.com" email and "secret" password is registered
    And user "test@example.com" has activation token "testActivationToken"
    When "POST" request is sent to "/api/activate/testActivationToken" route with body:
      | key           | value            |
      | user.email    | test@example.com |
      | user.password | secret           |
    And response should exist
    And response should have "200" status
    And response should have "0" errors
    And response should contain:
      | key           |
      | body          |
      | body.messages |
      | errors        |

  Scenario: As unregistered user, I can try to login so I should receive error of invalid credentials
    When "POST" request is sent to "/api/login" route with body:
      | key           | value                        |
      | user.email    | non-existing-one@example.com |
      | user.password | secret                       |
    And response should exist
    And response should have "400" status
    And response should have "1" errors
    And response should contain:
      | key    |
      | errors |
    And response should have error messages:
      | message                    |
      | Invalid login credentials. |

  Scenario: As registered user, I can try to register again so I should receive user already existing error
    Given user with "test@example.com" email and "secret" password is registered
    When "POST" request is sent to "/api/login" route with body:
      | key           | value            |
      | user.email    | test@example.com |
      | user.password | secret           |
    And response should exist
    And response should have "400" status
    And response should have "1" errors
    And response should contain:
      | key    |
      | errors |
    And response should have error messages:
      | message                                       |
      | User with given email address already exists. |