<?php

namespace Learning\CloudwaysApi\Service;

use Learning\CloudwaysApi\Model\Config;
use Learning\CloudwaysApi\Model\Http\Curl;
use Magento\Framework\Exception\LocalizedException;

class ClearCacheService
{
    private CloudwaysApi $api;
    private Config $config;

    public function __construct(
        CloudwaysApi $api,
        Config $config
    )
    {
        $this->api = $api;
        $this->config = $config;
    }

    /**
     * @return bool
     * @throws LocalizedException
     */
    public function execute(): bool
    {
        $data = [
            'server_id' => $this->config->getServerId(),
            'app_id' => $this->config->getAppId(),
        ];

        $response = $this->api->makeApiRequest(
            '/v1/app/cache/purge',
            'POST',
            $data
        );

        return  !empty($response['status']) && $response['status'] === true;
    }

}
