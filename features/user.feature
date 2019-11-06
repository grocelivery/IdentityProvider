@auth

Feature: User login and registration

  Background: Application is initialized
    Given initialized application

  Scenario: As logged in user, I want to retrieve my account information
    Given logged in user with "test@example.com" email and "secret" password
    When "GET" request is sent to "/api/me" route with body:
    And response should exist
    And response should have "200" status
    And response should have "0" errors
    And response should contain:
      | key                 |
      | body                |
      | body.user           |
      | body.user.name      |
      | body.user.email     |
      | body.user.createdAt |
      | errors              |

  Scenario: As unauthenticated user, I can try to retrieve my account information so I should receive unauthenticated error
    When "GET" request is sent to "/api/me" route with body:
    And response should exist
    And response should have "403" status
    And response should have "1" errors
    And response should contain:
      | key    |
      | errors |
    And response should have error messages:
      | message          |
      | Unauthenticated. |