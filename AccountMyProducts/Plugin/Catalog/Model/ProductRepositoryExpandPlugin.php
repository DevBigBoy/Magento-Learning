<?php

namespace Learning\AccountMyProducts\Plugin\Catalog\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Url\EncoderInterface;
use Magento\Framework\UrlInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Checkout\Helper\Cart;
use Magento\ConfigurableProduct\Helper\Data as ConfigurableAttributeData;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable\Price as VariationPrices;
use Magento\Catalog\Helper\Data;

class ProductRepositoryExpandPlugin extends \Magento\Framework\DataObject
{

    const MY_PRODUCTS_REQUEST = '/rest/V1/my_products/products';


    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @var EncoderInterface
     */
    private $urlEncoder;

    /**
     * @var Cart
     */
    private $cartHelper;

    /**
     * @var ConfigurableAttributeData
     */
    private $configurableAttributeData;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var PriceCurrencyInterface
     */
    private $format;

    /**
     * @var VariationPrices
     */
    private $variationPrices;

    /**
     * @var Data
     */
    private $helper;

    /**
     * Constructor
     *
     * @param UrlInterface $urlBuilder
     * @param EncoderInterface $urlEncoder
     * @param Cart $cartHelper
     * @param ConfigurableAttributeData $configurableAttributeData
     * @param RequestInterface $request
     * @param SerializerInterface $serializer
     * @param StoreManagerInterface $storeManager
     * @param PriceCurrencyInterface $format
     * @param VariationPrices $variationPrices
     * @param Data $helper
     */
    public function __construct(
        UrlInterface $urlBuilder,
        EncoderInterface $urlEncoder,
        Cart $cartHelper,
        ConfigurableAttributeData $configurableAttributeData,
        RequestInterface $request,
        SerializerInterface $serializer,
        StoreManagerInterface $storeManager,
        PriceCurrencyInterface $format,
        VariationPrices $variationPrices,
        Data $helper
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->urlEncoder = $urlEncoder;
        $this->cartHelper = $cartHelper;
        $this->configurableAttributeData = $configurableAttributeData;
        $this->request = $request;
        $this->serializer = $serializer;
        $this->storeManager = $storeManager;
        $this->format = $format;
        $this->variationPrices = $variationPrices;
        $this->helper = $helper;
    }

    public function afterGetList(
        ProductRepositoryInterface $productRepository,
        $result,
        SearchCriteriaInterface $searchCriteria
    )
    {

        if ($this->request->isAjax() && $this->request->getPathInfo() == self::MY_PRODUCTS_REQUEST) {
            foreach ($result->getItems() as $entity) {
                $extensionAttribute = $entity->getExtensionAttributes();
                $extensionAttribute->setAttributeData($this->configurableAttributeData($entity));
                $entity->setExtensionAttributes($extensionAttribute);
            }
        }

        return $result;
    }


    public function getConfigurableAttributesData(ProductInterface $entity): string
    {
        if ($entity->getTypeId() === Configurable::TYPE_CODE) {
            $store = $this->getCurrentStore();

            $options = $this->helper->getOptions($entity, $this->getAllowProducts($entity));
            $attributesData = $this->configurableAttributeData->getAttributesData($entity, $options);

            $config = [
                'attributes' => $attributesData['attributes'],
                'template' => str_replace('%s', '<%- data.price %>',
                    $this->storeManager->getStore()->getCurrentCurrency()->getOutputFormat()),
                'currencyFormat' => $store->getCurrentCurrency()->getOutputFormat(),
                'optionPrices' => $this->getOptionPrices($entity),
                'priceFormat' => $this->localeFormat->getPriceFormat(),
                'prices' => $this->variationPrices->getFormattedPrice(),
                'productId' => $entity->getId(),
                'chooseText' => __('Choose an Option...'),
                'images' => $this->getOptionImages($entity),
                'index' => isset($options['index']) ? $options['index'] : []
            ];

            return $this->serializer->serialize($config);
        }

        return '';
    }



    public function getCurrentStore(): StoreInterface
    {
        return $this->storeManager->getStore();
    }

    private function getOptionPrices(ProductInterface $entity): array
    {
        $prices = [];

        foreach ($this->getAllowProducts($entity) as $product) {
            $tierPrices = [];
            $priceInfo = $product->getPriceInfo();
            $tierPriceModel = $priceInfo->getPrice('tier_price');
            $tierPricesList = $tierPriceModel->getTierPriceList();

            foreach ($tierPricesList as $tierPrice) {
                $tierPrices[] = [
                    'qty' => $this->localeFormat->getNumber($tierPrice['price_qty']),
                    'price' => $this->localeFormat->getNumber($tierPrice['price']->getValue()),
                    'percentage' => $this->localeFormat->getNumber(
                        $tierPriceModel->getSavePercent($tierPrice['price'])
                    ),
                ];
            }

            $prices[$product->getId()] = [
                'oldPrice' => [
                    'amount' => $this->localeFormat->getNumber(
                        $priceInfo->getPrice('regular_price')->getValue()
                    ),
                ],
            ];
        }

    }


    private function getAllowProducts(ProductInterface $entity)
    {
    }


}
