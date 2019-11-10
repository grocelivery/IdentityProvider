@auth

Feature: User login, verification and registration

    Background: Application is initialized
        Given initialized application

    Scenario: As unregistered user, I want to register so I can login and retrieve access token
        When "POST" request is sent to "/api/register" route with body:
            | key      | value            |
            | email    | test@example.com |
            | password | secret           |
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key                 |
            | body                |
            | body.user           |
            | body.user.id        |
            | body.user.name      |
            | body.user.email     |
            | body.user.verified  |
            | body.user.createdAt |
            | errors              |

    Scenario: As registered user, I want to login so I can retrieve access token
        Given user with "test@example.com" email and "secret" password is registered
        And "test@example.com" email is verified
        When "POST" request is sent to "/api/login" route with body:
            | key      | value            |
            | email    | test@example.com |
            | password | secret           |
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key              |
            | body             |
            | body.accessToken |
            | errors           |

    Scenario: As registered user, I want to activate my account to be able to login
        Given user with "test@example.com" email and "secret" password is registered
        And "testActivationToken" verification token exists for "test@example.com" email
        When "POST" request is sent to "/api/verify/testActivationToken" route
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key          |
            | body         |
            | body.message |
            | errors       |

    Scenario: As registered but not verified user, I can try to login so I should receive verification error
        Given user with "test@example.com" email and "secret" password is registered
        When "POST" request is sent to "/api/login" route with body:
            | key      | value            |
            | email    | test@example.com |
            | password | secret           |
        Then response should exist
        And response should have "403" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message                        |
            | Email address is not verified. |

    Scenario: As unregistered user, I can try to login so I should receive error of invalid credentials
        When "POST" request is sent to "/api/login" route with body:
            | key      | value                        |
            | email    | non-existing-one@example.com |
            | password | secret                       |
        Then response should exist
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
        When "POST" request is sent to "/api/register" route with body:
            | key      | value            |
            | email    | test@example.com |
            | password | secret           |
        Then response should exist
        And response should have "400" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message                           |
            | The email has already been taken. |

    Scenario: As literally anybody, I could try to verify by using not existing token so I should receive not found error
        When "POST" request is sent to "/api/verify/non-existing-token" route
        Then response should exist
        And response should have "404" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message    |
            | Not found. |
