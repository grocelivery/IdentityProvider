@app

Feature: Basic application behaviour

    Background: Application is initialized
        Given initialized application

    Scenario: As IDP API consumer, I want to retrieve basic app information to see if IDP API is working properly
        Given "GET" request to "/api/status" route
        When request is sent
        Then response should exist
        And response should have "200" status
        And response should have "0" errors
        And response should contain:
            | key            |
            | body           |
            | body.app       |
            | body.version   |
            | body.framework |
            | body.status    |
            | errors         |

    Scenario: As IDP API consumer, I can try to send request to non-existing route so I should receive proper 404 error
        Given "GET" request to "/api/non-existing-route" route
        When request is sent
        Then response should exist
        And response should have "404" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message          |
            | Route not found. |

    Scenario: As IDP API consumer, I can try to send request with wrong HTTP method so I should receive proper 405 error
        Given "POST" request to "/api/status" route
        When request is sent
        Then response should exist
        And response should have "405" status
        And response should have "1" errors
        And response should contain:
            | key    |
            | errors |
        And response should have error messages:
            | message             |
            | Method not allowed. |
