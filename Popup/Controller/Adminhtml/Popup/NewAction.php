<?php

namespace Learning\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Psr\Log\LoggerInterface;

class NewAction extends Action
{

    const ADMIN_RESOURCE = 'Learning_Popup::popup';


    private LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger,
        Context $context
    )
    {
        parent::__construct($context);
        $this->logger = $logger;
    }

    public function execute():ResultInterface
    {
        return  $this->resultFactory->create(ResultFactory::TYPE_FORWARD)->forward('edit');
    }
}
