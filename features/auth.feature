@auth

Feature: User login, verification and registration

    Background: Application is initialized
        Given initialized application

    Scenario: As unregistered user, I want to register so I can login and retrieve access token
        Given "POST" request to "/api/register" route
        And request body is:
            | key      | value            |
            | email    | test@example.com |
            | password | secret           |
        When request is sent
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
        Given user with "test@example.com" email and "secret" password exists
        And "test@example.com" email is verified
        And "POST" request to "/api/login" route
        And request body is:
            | key      | value            |
            | email    | test@example.com |
            | password | secret           |
        When request is sent
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key              |
            | body             |
            | body.accessToken |
            | errors           |

    Scenario: As registered user, I want to activate my account to be able to login
        Given user with "test@example.com" email and "secret" password exists
        And "testActivationToken" verification token exists for "test@example.com" email
        And "POST" request to "/api/verify/testActivationToken" route
        When request is sent
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key          |
            | body         |
            | body.message |
            | errors       |

    Scenario: As registered but not verified user, I can try to login so I should receive verification error
        Given user with "test@example.com" email and "secret" password exists
        And "POST" request to "/api/login" route
        And request body is:
            | key      | value            |
            | email    | test@example.com |
            | password | secret           |
        When request is sent
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
        Given "POST" request to "/api/login" route
        And request body is:
            | key      | value                        |
            | email    | non-existing-one@example.com |
            | password | secret                       |
        When request is sent
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
        Given user with "test@example.com" email and "secret" password exists
        And "POST" request to "/api/register" route
        And request body is:
            | key      | value            |
            | email    | test@example.com |
            | password | secret           |
        When request is sent
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
        Given "POST" request to "/api/verify/non-existing-token" route
        When request is sent
        Then response should exist
        And response should have "404" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message    |
            | Not found. |
