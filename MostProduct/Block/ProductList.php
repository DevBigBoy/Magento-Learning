<?php

namespace Learning\SellerProducts\Block;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Reports\Model\ResourceModel\Product\CollectionFactory as ReportsCollectionFactory;

class ProductList extends Template
{
    protected $productCollectionFactory;
    protected $reportsCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        ReportsCollectionFactory $reportsCollectionFactory,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->reportsCollectionFactory = $reportsCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get Most Viewed Products
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getMostViewedProducts()
    {
        $collection = $this->reportsCollectionFactory->create();
        $collection->setPageSize(5); // Limit to 5 products
        $collection->setOrder('views_count', 'DESC');
        $collection->addAttributeToSelect('*');

        return $collection;
    }

    /**
     * Get Seller Products
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getSellerProducts()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('is_seller_product', 1);
        $collection->setPageSize(5);

        return $collection;
    }
}
