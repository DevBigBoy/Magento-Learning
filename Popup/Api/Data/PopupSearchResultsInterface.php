<?php

namespace  Learning\Popup\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PopupSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Popup list.
     *
     * @return \Learning\Popup\Api\Data\PopupInterface[]
     */
    public function getItems();

    /**
     * Set Popup list.
     *
     * @param \Learning\Popup\Api\Data\PopupInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
