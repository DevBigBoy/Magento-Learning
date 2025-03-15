<?php

namespace Learning\AccountMyProducts\Api;

use Magento\Framework\Api\ExtensionAttributesInterface;

interface ProductExtensionInterface extends ExtensionAttributesInterface
{

    public function getAttributeData();
    public function setAttributeData(array $data);

}
