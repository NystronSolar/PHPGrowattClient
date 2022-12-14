<?php

use GuzzleHttp\Exception\ClientException;
use NystronSolar\PHPGrowattClient\GrowattClient;
use PHPUnit\Framework\TestCase;

class GrowattClientTest extends TestCase
{
    private string $apiToken = "6eb6f069523055a339d71e5b1f6c88cc"; // API Token used for tests

    private string $apiURL = "https://test.growatt.com/v1/"; // API URL used for tests

    /**
     * Create a Growatt Client object
     * @return GrowattClient
     */
    private function createGrowattClient(): GrowattClient
    {
        $growattClient = new GrowattClient($this->apiToken, $this->apiURL);

        return $growattClient;
    }

    public function test_create_url()
    {
        // Arrange
        $client = $this->createGrowattClient();

        // Act
        $url = $client->createURL("test/route");

        // Assert
        $this->assertSame("https://test.growatt.com/v1/test/route", $url);
    }

    public function test_updating_guzzle_client_on_set_api_token()
    {
        // Assert
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage("Client error: `GET https://test.growatt.com/v1/` resulted in a `404 Not Found` response:");

        // Arrange
        $client = new GrowattClient("Wrong Api Token", $this->apiURL);
        $client->setApiToken($this->apiToken);
        $url = $client->createURL(""); // If the API Token is valid, it will return 404 status code. Else, it will return 200 Status code and an JSON containing an API Token Error

        // Act
        $client->getGuzzleClient()->get($url);
    }
}