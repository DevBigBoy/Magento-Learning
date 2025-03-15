<?php

namespace Learning\CloudwaysApi\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private const XML_PATH_API_KEY = 'learning_cloudways_api_key/settings/api_key';
    private const XML_PATH_EMAIL = 'learning_cloudways_api_key/settings/email';
    private const  XML_PATH_SERVER_ID = 'learning_cloudways_api_key/settings/server_id';
    private const  XML_PATH_APP_ID = 'learning_cloudways_api_key/settings/app_id';
    private const XML_PATH_API_ENDPOINT =  'learning_cloudways_api_key/settings/api_endpoint';

    private ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getApiKey(): string
    {
        $apiKey = (string) $this->scopeConfig->getValue(self::XML_PATH_API_KEY, ScopeInterface::SCOPE_STORE);
        if (!$apiKey) {
            throw new LocalizedException(__('Cloudways Api Key is not configured.'));
        }
        return $apiKey;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getEmail(): string
    {
        $email = (string) $this->scopeConfig->getValue(self::XML_PATH_EMAIL, ScopeInterface::SCOPE_STORE);
        if (!$email) {
            throw new LocalizedException(__('Cloudways Platform Email is not configured.'));
        }
        return $email;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getServerId(): string
    {
        $serverId  = (string) $this->scopeConfig->getValue(self::XML_PATH_SERVER_ID, ScopeInterface::SCOPE_STORE);
        if (!$serverId) {
            throw new LocalizedException(__('Cloudways Server ID is not configured.'));
        }
        return $serverId;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getAppId(): string
    {
        $appId = (string) $this->scopeConfig->getValue(self::XML_PATH_APP_ID, ScopeInterface::SCOPE_STORE);
        if (!$appId) {
            throw new LocalizedException(__('Cloudways App ID is not configured.'));
        }
        return $appId;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getApiEndpoint(): string
    {
        $apiEndpoint = (string) $this->scopeConfig->getValue(self::XML_PATH_API_ENDPOINT, ScopeInterface::SCOPE_STORE);
        if (!$apiEndpoint) {
            throw new LocalizedException(__('Cloudways API Endpoint is not configured.'));
        }
        return $apiEndpoint;
    }
}
