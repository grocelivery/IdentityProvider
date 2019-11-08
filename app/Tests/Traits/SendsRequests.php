<?php

namespace Grocelivery\IdentityProvider\Tests\Traits;

use Behat\Gherkin\Node\TableNode;
use Exception;
use Grocelivery\IdentityProvider\Http\Responses\Response;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;

/**
 * Trait SendsRequests
 * @package Grocelivery\IdentityProvider\Tests\Traits
 * @property Application $app
 */
trait SendsRequests
{
    /** @var Response */
    protected $response;

    /**
     * @When :method request is sent to :route route
     * @When :method request is sent to :route route with body:
     * @param string $method
     * @param string $route
     * @param TableNode|mixed $body
     * @throws Exception
     */
    public function requestIsSentToRoute(string $method, string $route, ?TableNode $body = null): void
    {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $route;

        if (isset($body)) {
            foreach ($body as $field) {
                $_POST[$field['key']] = $field['value'];
            }
        }

        $request = Request::createFromGlobals();
        $this->response = $this->app->handle($request);
    }

    /**
     * @Then response should exist
     */
    public function responseShouldExist(): void
    {
        Assert::assertNotNull($this->response);
    }

    /**
     * @Then response should contain:
     * @param TableNode $keys
     */
    public function responseShouldContain(TableNode $keys): void
    {
        foreach ($keys as $key) {
            $value = data_get($this->response->all(), $key["key"], null);
            Assert::assertNotNull($value);
        }
    }

    /**
     * @Then response should have :status status
     * @param int $status
     */
    public function responseShouldHaveStatus(int $status): void
    {
        Assert::assertEquals($status, $this->response->getStatusCode());
    }

    /**
     * @Then response should have :errors errors
     * @param int $errors
     */
    public function responseShouldHaveErrors(int $errors): void
    {
        Assert::assertEquals($errors, $this->response->countErrors());
    }

    /**
     * @Then response should have error messages:
     * @param TableNode $errorMessages
     */
    public function responseShouldHaveErrorMessages(TableNode $errorMessages): void
    {
        foreach ($errorMessages as $error) {
            Assert::assertContains($error['message'], $this->response->getErrors());
        }
    }
}