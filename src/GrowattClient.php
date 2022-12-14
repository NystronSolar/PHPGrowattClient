<?php

namespace NystronSolar\PHPGrowattClient;

use GuzzleHttp\Client as GuzzleClient;
use SensitiveParameter;

/**
 * A Growatt Api Client
 */
class GrowattClient
{
    private string $apiToken;

    private string $apiURL;

    private GuzzleClient $guzzleClient;

    public function __construct(
        #[SensitiveParameter] string $_apiToken,
        string $_apiURL = "https://openapi.growatt.com/"
    )
    {
        $this->setApiToken($_apiToken);
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
     * Get the API Token
     * 
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
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
     * Set the API Token
     * 
     * @param string $_apiToken
     * @param bool $changeGuzzleClient If true, the next requests to the Growatt API will be with the new Api Token.
     * 
     * @return GrowattClient
     */
    public function setApiToken(#[SensitiveParameter] string $_apiToken, bool $changeGuzzleClient = true): GrowattClient
    {
        $this->apiToken = $_apiToken;

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
        $apiToken = $this->getApiToken();

        $client = new GuzzleClient(["headers" => ["token" => $apiToken]]);

        $this->guzzleClient = $client;

        return $this;
    }
}
