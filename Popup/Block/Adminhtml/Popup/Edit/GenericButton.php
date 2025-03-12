<?php

namespace Learning\Popup\Block\Adminhtml\Popup\Edit;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

class GenericButton
{
    private UrlInterface $url;
    private RequestInterface $request;

    /**
     * @param UrlInterface $url
     * @param RequestInterface $request
     */
    public function __construct(
          UrlInterface $url,
          RequestInterface $request,
    ) {
        $this->url = $url;
        $this->request = $request;
    }

    /**
     * @return int
     */
    public function getPopupId(): int
    {
        return (int) $this->request->getParam('popup_id', 0);
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->url->getUrl($route, $params);
    }
}
