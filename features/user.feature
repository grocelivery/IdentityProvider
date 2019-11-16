@user

Feature: Retrieving user accounts information

    Background: Application is initialized
        Given initialized application
        And user with "test@example.com" email and "secret" password exists
        And "test@example.com" email is verified

    Scenario: As logged in user, I want to retrieve my account information
        Given user with "test@example.com" email is authenticated
        And "GET" request to "/api/me" route
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

    Scenario: As unauthenticated user, I can try to retrieve my account information so I should receive unauthenticated error
        Given "GET" request to "/api/me" route
        When request is sent
        Then response should exist
        And response should have "401" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message          |
            | Unauthenticated. |

    Scenario: As unverified user, I can try to retrieve my account information so I should receive unverified error
        Given user with "not-verified-one@example.com" email and "secret" password exists
        And user with "not-verified-one@example.com" email is authenticated
        And "GET" request to "/api/me" route
        When request is sent
        Then response should exist
        And response should have "403" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message          |
            | Email address is not verified. |
