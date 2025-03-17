<?php

namespace Learning\Popup\Service;

use Learning\Popup\Api\Data\PopupInterface;
use Learning\Popup\Api\Data\PopupSearchResultsInterfaceFactory;
use Learning\Popup\Api\PopupRepositoryInterface;
use Learning\Popup\Model\PopupFactory;
use Learning\Popup\Model\PopupSearchResults;
use Learning\Popup\Model\ResourceModel\Popup as PopupResource;
use Learning\Popup\Model\ResourceModel\Popup\CollectionFactory as PopupCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class PopupRepository implements PopupRepositoryInterface
{

    private PopupResource $popupResource;
    private PopupFactory $popupFactory;
    private PopupCollectionFactory $popupCollectionFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private PopupSearchResultsInterfaceFactory $searchResultsFactory;


    public function __construct(
        PopupResource $popupResource,
        PopupFactory $popupFactory,
        PopupSearchResultsInterfaceFactory $searchResultsFactory,
        PopupCollectionFactory $popupCollectionFactory,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->popupResource = $popupResource;
        $this->popupFactory = $popupFactory;
        $this->popupCollectionFactory = $popupCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param PopupInterface $popup
     * @return int
     * @throws AlreadyExistsException
     */
    public function save(PopupInterface $popup): int
    {
        $this->popupResource->save($popup);
        return $popup->getPopupId();
    }

    /**
     * @param int $popupId
     * @return PopupInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $popupId): PopupInterface
    {
        $popup = $this->popupFactory->create();
        $this->popupResource->load($popup, $popupId);
        if (!$popup->getId()) {
            throw new NoSuchEntityException(__('Popup with id "%1" does not exist.', $popupId));
        }
        return $popup;
    }

    /**
     * @param PopupInterface $popup
     * @return void
     * @throws \Exception
     */
    public function delete(PopupInterface $popup): void
    {
        $this->popupResource->delete($popup);
    }

    /**
     * @param int $popupId
     * @return bool
     * @throws NoSuchEntityException]
     */
    public function deleteById(int $popupId): bool
    {
        $popup = $this->getById($popupId);
        $this->popupResource->delete($popup);
        return true;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Learning\Popup\Api\Data\PopupSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->popupCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /**
         * @var PopupSearchResults $searchResults
         */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
