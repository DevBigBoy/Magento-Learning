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

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Learning_Popup::popup';

    private PopupRepository $popupRepository;

    public function __construct(
        PopupRepository $popupRepository,
        Context $context
    )
    {
        parent::__construct($context);
        $this->popupRepository = $popupRepository;
    }

    public function execute(): ResultInterface
    {
        $popupId =  (int) $this->getRequest()->getParam('popup_id', 0);
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if (!$popupId)
        {
            $this->messageManager->addErrorMessage(__('This popup no longer exists.'));
            return $result->setPath('manage_popup/popup/index');
        }

        try {

            $popup = $this->popupRepository->getById($popupId);
            if (!$popup->getPopupId()) {
                $this->messageManager->addWarningMessage(__('The Popup With the Provided Id was not found.'));
            } else{
                $this->popupRepository->delete($popup);
                $this->messageManager->addSuccessMessage(__('The Popup has been deleted.'));
            }

        }catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(
                __('Something went wrong while trying to deleted the popup.')
            );
        }
        return $result->setPath('manage_popup/popup/index');
    }
}
