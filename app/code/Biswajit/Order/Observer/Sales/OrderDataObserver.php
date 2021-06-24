<?php

namespace Biswajit\Order\Observer\Sales;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
// use Magento\Framework\App\Action\Context;

// use Psr\Log\LoggerInterface;

use Biswajit\Order\Model\OrderData;

class OrderDataObserver implements ObserverInterface
{
	protected $_orderData;

	public function __construct(OrderData $orderData)
	{
		$this->_orderData = $orderData;        
	}

	public function execute(Observer $observer)
	{
    	$orderDetails = $observer->getEvent()->getOrder();

    	$this->_orderData->addData([
            "order_id" 	=> $orderDetails->getId(),
            "taxvat" 	=> $orderDetails->getData('customer_taxvat')
        ]);

        $savedOrder = $this->_orderData->save();
	} 
}
	