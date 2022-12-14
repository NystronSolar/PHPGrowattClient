<?php

namespace NystronSolar\PHPGrowattClient;

use GuzzleHttp\Client as GuzzleClient;
use SensitiveParameter;

/**
 * A Growatt Api Client
 */
class GrowattClient
{
    private string $apiKey;

    private string $apiURL;

    private GuzzleClient $guzzleClient;

    public function __construct(
        #[SensitiveParameter] string $_apiKey,
        string $_apiURL = "https://openapi.growatt.com/"
    )
    {
        $this->setApiKey($_apiKey);
        $this->setApiURL($_apiURL);
    }

    /**
     * Create an URL based in the route.
     * 
     * @param string $route
     * @return string
     */
    public function createURL(string $route): string
    {
        return $this->apiURL . $route;
    }

    /**
     * Get the API Key
     * 
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Get the API URL
     * 
     * @return string
     */
    public function getApiURL(): string
    {
        return $this->apiURL;
    }

    /**
     * Get the Guzzle Client
     * 
     * @return GuzzleClient
     */
    public function getGuzzleClient(): GuzzleClient
    {
        return $this->guzzleClient;
    }

    /**
     * Set the API Key
     * 
     * @param string $_apiKey
     * @param bool $changeGuzzleClient If true, the next requests to the Growatt API will be with the new Api Key.
     * 
     * @return GrowattClient
     */
    public function setApiKey(#[SensitiveParameter] string $_apiKey, bool $changeGuzzleClient = true): GrowattClient
    {
        $this->apiKey = $_apiKey;

        if($changeGuzzleClient) {
            $this->setGuzzleClient();
        }

        return $this;
    }

    /**
     * Set the API URL
     * 
     * @param string $_apiURL
     * @return GrowattClient
     */
    public function setApiURL(string $_apiURL): GrowattClient
    {
        $this->apiURL = $_apiURL;

        return $this;
    }

    private function setGuzzleClient(): GrowattClient
    {
        $apiKey = $this->getApiKey();

        $client = new GuzzleClient(["headers" => ["token" => $apiKey]]);

        $this->guzzleClient = $client;

        return $this;
    }
}
