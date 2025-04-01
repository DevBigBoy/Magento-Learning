<?php

namespace Learning\LayeredCategories\Block;


use Magento\Catalog\Helper\Category;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\View\Element\Template;

class Categories extends \Magento\Framework\View\Element\Template
{
    private Category $categoryHelper;
    private CategoryFactory $categoryFactory;

    public function __construct(
        Template\Context $context,
        Category $categoryHelper,
        CategoryFactory $categoryFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->categoryHelper = $categoryHelper;
        $this->categoryFactory = $categoryFactory;
    }

    public function getChildCategories($id){
        $category = $this->categoryFactory->create();
        $category = $category->load($id);
       $collection = $category->getCollection()
           ->addIsActiveFilter()
           ->addAttributeToFilter('include_in_menu', 1)
           ->addAttributeToSelect('*')
           ->setOrder('position', 'ASC')
           ->addIdFilter($category->getChildren());
       return $collection;
    }

}
