<?php

namespace Learning\Popup\Controller\Adminhtml\Popup;

use Learning\Popup\Api\Data\PopupInterface;
use Learning\Popup\Model\ResourceModel\Popup\CollectionFactory;
use Learning\Popup\Service\PopupRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;

class MassEnable extends Action
{
    private Filter $filter;
    private CollectionFactory $collectionFactory;
    private PopupRepository $popupRepository;

    public function __construct(
        Filter $filter,
        CollectionFactory $collectionFactory,
        PopupRepository $popupRepository,
        Context $context
    )
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->popupRepository = $popupRepository;
    }


    public function execute(): ResultInterface
    {

        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize  = $collection->getSize();

            foreach ($collection as $popup) {
                $popup->setIsActive(PopupInterface::ENABLED);
                $this->popupRepository->save($popup);
            }

            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been enabled.', $collectionSize));

        }catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(
                __('Something went wrong while trying to enable the popup.')
            );
        }

       $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('manage_popup/popup/index');
    }
}
