<?php

namespace Learning\Popup\Service;


use Learning\Popup\Api\Data\PopupInterface;
use Learning\Popup\Api\PopupManagementInterface;
use Learning\Popup\Model\ResourceModel\Popup\Collection;
use Learning\Popup\Model\ResourceModel\Popup\CollectionFactory;

class PopupManagement implements PopupManagementInterface
{
    private CollectionFactory $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return PopupInterface
     */
    public function getApplicablePopup(): PopupInterface
    {
        /** @var PopupInterface $popup */
        $popup =  $this->getCollection()
            ->addFieldToFilter(PopupInterface::IS_ACTIVE, PopupInterface::ENABLED)
            ->addOrder(PopupInterface::POPUP_ID)
            ->getFirstItem();
        return $popup;
    }

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collectionFactory->create();
    }
}
