<?php

use NystronSolar\PHPGrowattClient\GrowattClient;
use PHPUnit\Framework\TestCase;

class GrowattClientTest extends TestCase
{
    private string $apiToken = "6eb6f069523055a339d71e5b1f6c88cc"; // API Token used for tests

    private string $apiUrl = "https://test.growatt.com/v1/"; // API URL used for tests

    /**
     * Create a Growatt Client object
     * @return GrowattClient
     */
    private function createGrowattClient(): GrowattClient
    {
        $growattClient = new GrowattClient($this->apiToken, $this->apiUrl);

        return $growattClient;
    }

    /**
     * @test
     */
    public function test_create_url()
    {
        $client = $this->createGrowattClient();

        $url = $client->createURL("test/route");

        $this->assertSame("https://test.growatt.com/v1/test/route", $url);
    }

}