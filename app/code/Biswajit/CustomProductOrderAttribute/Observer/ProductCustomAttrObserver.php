<?php

namespace Biswajit\CustomProductOrderAttribute\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order\ItemFactory;
use Magento\Sales\Api\OrderItemRepositoryInterface;
use Magento\Catalog\Model\ProductFactory;

use Psr\Log\LoggerInterface;

class ProductCustomAttrObserver implements ObserverInterface
{
    const PRODUCT_ATTRIBUTE_CODE = 'product_custom_order';

    const SALES_ORDER_ITEM_COLUMN = 'item_custom_order';

    protected $_itemFactory;

    protected $_orderItemRepository;

    protected $_productFactory;

    protected $_logger;

    public function __construct(
        ItemFactory $itemFactory,
        OrderItemRepositoryInterface $orderItemRepository,
        ProductFactory $productFactory,
        LoggerInterface $logger
    ) 
    {
        $this->_itemFactory = $itemFactory;

        $this->_orderItemRepository = $orderItemRepository;

        $this->_productFactory = $productFactory;

        $this->_logger = $logger;
    }

    public function execute(EventObserver $observer)
    {
        try {
            $order = $observer->getEvent()->getOrder();

            $orderId = $order->getId();

            $this->_logger->info("Order Id : ".$orderId);
            
            $orderItems = $this->_itemFactory->create()->getCollection()->addFieldToFilter('order_id', $orderId);

            foreach ($orderItems as $item) {
                $itemId =  $item->getItemId();

                $this->_logger->info("Order Item Id : ".$itemId);

                $orderItem = $this->_orderItemRepository->get($itemId);

                $orderProductId = $orderItem->getData('product_id');

                $this->_logger->info("Order Item Product Id : ".$orderProductId);

                $productCustomAttributeValue = $this->getProductCustomAttributeValue($orderProductId, static::PRODUCT_ATTRIBUTE_CODE);

                $orderItem->setData(static::SALES_ORDER_ITEM_COLUMN, $productCustomAttributeValue);

                $orderItem->save();
            }
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
        }
    }

    private function getProductCustomAttributeValue($productId, $customAttributeName)
    {
        $customAttributeValue = null;

        try {
            $product = $this->_productFactory->create()->load($productId);

            $customAttributeValue = $product->getResource()->getAttribute($customAttributeName)->getFrontend()->getValue($product);
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
        }

        return $customAttributeValue;
    }
}
