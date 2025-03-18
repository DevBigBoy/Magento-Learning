<?php

namespace Learning\CloudwaysApi\Service;

use Learning\CloudwaysApi\Model\Config;
use Learning\CloudwaysApi\Model\Http\Curl;
use Magento\Framework\Exception\LocalizedException;
use Magento\Tests\NamingConvention\true\string;

class CloudwaysApi
{

    private Config $config;
    private Curl $curl;

    public function __construct(
        Config $config,
        Curl $curl
    )
    {
        $this->config = $config;
        $this->curl = $curl;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getAuthorizationToken(): string
    {
        $url = $this->config->getApiKey() . '/v1/oauth/access_token';
        $data = [
            'email' => $this->config->getEmail(),
            'api_key' => $this->config->getApiKey(),
        ];

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $response = $this->curl->execute($url, 'POST', $headers, $data);

        if (!empty($response['access_token'])) {
            return $response['access_token'];
        }

        throw new LocalizedException(__('Failed to get an Authorization token from Cloudways.'));
    }

    /**
     * @param string $endpoint
     * @param string $method
     * @param array $data
     * @return array
     * @throws LocalizedException
     */
    public function makeApiRequest(string $endpoint, string $method = 'GET', array $data = [] ): array
    {
        $url = $this->config->getApiEndpoint() . $endpoint;

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . $this->getAuthorizationToken(),
        ];
        return $this->curl->execute($url, $method, $headers, $data);
    }

}
