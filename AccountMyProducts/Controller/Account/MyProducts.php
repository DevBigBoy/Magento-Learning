<?php

declare(strict_types=1);

namespace Learning\AccountMyProducts\Controller\Account;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Customer\Model\Session;
use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\HttpGetActionInterface;

class MyProducts extends AbstractAccount implements HttpGetActionInterface
{
    /**
     * @var Session
     */
    private $customer;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Session $customer
     * @param ResultFactory $resultFactory
     */
    public function __construct(
        Context $context,
        Session $customer,
        ResultFactory $resultFactory
    ) {
        $this->customer = $customer;
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function dispatch(RequestInterface $request): ResponseInterface
    {
        if (!$this->customer->isLoggedIn()) {
            $this->_actionFlag->set('', 'no-dispatch', true);
        }

        return parent::dispatch($request);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
