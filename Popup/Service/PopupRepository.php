<?php

namespace Learning\Popup\Service;

use Learning\Popup\Api\Data\PopupInterface;
use Learning\Popup\Api\PopupRepositoryInterface;
use Learning\Popup\Model\PopupFactory;
use Learning\Popup\Model\ResourceModel\Popup as PopupResource;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class PopupRepository implements PopupRepositoryInterface
{

    private PopupResource $popupResource;
    private PopupFactory $popupFactory;

    public function __construct(
        PopupResource $popupResource,
        PopupFactory $popupFactory
    )
    {
        $this->popupResource = $popupResource;
        $this->popupFactory = $popupFactory;
    }

    public function getList()
    {
        // TODO: Implement getList() method.
    }

    /**
     * @param PopupInterface $popup
     * @return void
     * @throws AlreadyExistsException
     */
    public function save(PopupInterface $popup): void
    {
        $this->popupResource->save($popup);
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

    public function deleteById(PopupInterface $popupId): bool
    {
        // TODO: Implement deleteById() method.
    }
}
