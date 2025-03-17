<?php

declare(strict_types=1);

namespace Learning\Popup\Model;

use Learning\Popup\Api\Data\PopupSearchResultsInterface;
use Magento\Framework\Api\SearchResults;


class PopupSearchResults extends SearchResults implements PopupSearchResultsInterface
{
}
