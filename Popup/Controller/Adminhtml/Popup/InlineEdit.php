<?php

namespace Learning\Popup\Controller\Adminhtml\Popup;

use Learning\Popup\Model\Popup;
use Learning\Popup\Service\PopupRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Psr\Log\LoggerInterface;

class InlineEdit extends Action
{

    const ADMIN_RESOURCE = 'Learning_Popup::popup';

    private PopupRepository $popupRepository;
    private LoggerInterface $logger;

    public function __construct(
        PopupRepository $popupRepository,
        LoggerInterface $logger,
        Context $context
    )
    {
        parent::__construct($context);
        $this->popupRepository = $popupRepository;
        $this->logger = $logger;
    }

    public function execute(): ResultInterface
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $items =  $this->getRequest()->getParam('items');

        $this->logger->debug('Items received:', $items);

        $messages = [];
        $error = false;

        if(!count($items))
        {
            $messages[] = ['message' => __('No items found.')];
            $error = true;
        } else {
                    $this->logger->debug('Items received:',array_keys($items));
                foreach (array_keys($items) as $popupId) {
                    try {
                        /** @var Popup $popup */
                       $popup =  $this->popupRepository->getById((int)$popupId);
                       $popup->setData(array_merge($popup->getData(), $items[$popupId]));
                       $this->popupRepository->save($popup);
                        $this->logger->info("Popup ID {$popupId} updated successfully.");

                    } catch (\Throwable $exception) {
                        $messages[] = '[Popup ID: '. $popupId .'] ' . $exception->getMessage();
                        $error = true;

                        $this->logger->error("Error updating Popup ID {$popupId}: " . $exception->getMessage());

                    }
                }

        }

        return $result->setData(
            [
                'messages' => $messages,
                'errors' => $error
            ]
        );
    }
}
