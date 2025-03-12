<?php

namespace Learning\Popup\Controller\Adminhtml\Popup;

use Learning\Popup\Api\Data\PopupInterfaceFactory;
use Learning\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;
use Psr\Log\LoggerInterface;

class Edit extends Action
{

    private LoggerInterface $logger;
    private PopupRepositoryInterface $popupRepository;
    private DataPersistorInterface $dataPersistor;
    private PopupInterfaceFactory $popupFactory;

    public function __construct
    (
        PopupRepositoryInterface $popupRepository,
        PopupInterfaceFactory $popupFactory,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger,
        Context $context
    )
    {
        $this->logger = $logger;
        parent::__construct($context);
        $this->popupRepository = $popupRepository;
        $this->dataPersistor = $dataPersistor;
        $this->popupFactory = $popupFactory;
    }

    public function execute(): ResultInterface
    {
        /** @var Page $resultPage  */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $popupId = (int) $this->getRequest()->getParam('popup_id');

        if ($popupId) {
            try {
                $popup = $this->popupRepository->getById($popupId);
                $this->dataPersistor->set('manage_popup_popup', $popup->getData());
            }catch (NoSuchEntityException $exception){
                $this->messageManager->addErrorMessage(__('This popup no longer exists.'));
            }
        }else {
            $popup = $this->popupFactory->create();
        }

        $resultPage->setActiveMenu('Learning_Popup::popup');
        $resultPage->addBreadcrumb(__('Popups'), __('Popups'));
        $resultPage->addBreadcrumb(
            $popup->getPopupId() ? $popup->getName() : __('New Popup'),
            $popup->getPopupId() ? $popup->getName() : __('New Popup')
        );
        $resultPage->getConfig()->getTitle()->prepend(
            $popup->getPopupId() ? $popup->getName() : __('New Popups')
        );
        return $resultPage;
    }

}
