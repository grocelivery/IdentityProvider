@token

Feature: Validating and revoking access tokens

    Background: Application is initialized
        Given initialized application
        And user with "test@example.com" email and "secret" password is registered
        And "test@example.com" email is verified

    Scenario: As IDP API consumer, I want to validate identity of the user with correct access token provided
        Given user with "test@example.com" email is authenticated
        And "POST" request to "/api/token/validate" route
        When request is sent
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key          |
            | body         |
            | body.message |
            | errors       |

    Scenario: As IDP API consumer, I could try to validate identity of the user with no access token provided so I should receive Unauthenticated error then
        Given "POST" request to "/api/token/validate" route
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

    Scenario: As IDP API consumer, I could try to validate identity of the user with wrong access token provided so I should receive Unauthenticated error then
        Given "POST" request to "/api/token/validate" route
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

    Scenario: As IDP API consumer, I want to revoke current access token so nobody could use it anymore
        Given user with "test@example.com" email is authenticated
        And "POST" request to "/api/token/revoke" route
        When request is sent
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key          |
            | body         |
            | body.message |
            | errors       |

    Scenario: As IDP API consumer, I could try to revoke single invalid, not existing or already invalidated token so I should receive Unauthenticated error then
        Given "POST" request to "/api/token/revoke" route
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

    Scenario: As IDP API consumer, I want to revoke all access tokens of authenticated user so nobody could use these tokens anymore
        Given user with "test@example.com" email is authenticated
        And "POST" request to "/api/token/revoke/all" route
        When request is sent
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key          |
            | body         |
            | body.message |
            | errors       |

    Scenario: As IDP API consumer, I want to revoke all access tokens of unauthenticated user so I should receive Unauthenticated error then
        Given "POST" request to "/api/token/revoke/all" route
        And bearer token header is set to "wr0n6-aCce5S-t0ken"
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
