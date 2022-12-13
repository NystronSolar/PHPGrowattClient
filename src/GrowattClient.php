<?php

namespace NystronSolar\PHPGrowattClient;

use SensitiveParameter;

/**
 * A Growatt Api Client
 */
class GrowattClient
{
    #[SensitiveParameter] private string $apiKey;

    private string $apiUrl;

    public function __construct(
        #[SensitiveParameter] string $_apiKey,
        string $_apiUrl = "https://openapi.growatt.com/"
    )
    {
        $this->apiKey = $_apiKey;
        $this->apiUrl = $_apiUrl;
    }

    /**
     * Create an URL based in the route.
     * 
     * @param string $route
     * @return string
     */
    public function createURL(string $route): string
    {
        return $this->apiUrl . $route;
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
        return $this->apiUrl;
    }

    /**
     * Set the API Key
     * 
     * @param string $_apiKey
     * @return GrowattClient
     */
    public function setApiKey(#[SensitiveParameter] string $_apiKey): GrowattClient
    {
        $this->apiKey = $_apiKey;

        return $this;
    }

    /**
     * Set the API URL
     * 
     * @param string $_apiUrl
     * @return GrowattClient
     */
    public function setApiURL(string $_apiUrl): GrowattClient
    {
        $this->apiUrl = $_apiUrl;

        return $this;
    }
}