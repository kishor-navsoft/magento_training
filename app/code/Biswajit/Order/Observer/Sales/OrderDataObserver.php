<?php

namespace Biswajit\Order\Observer\Sales;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Action\Context;

use Psr\Log\LoggerInterface;

use Biswajit\Order\Model\OrderDataFactory;

class OrderDataObserver implements ObserverInterface
{
	// protected $_logger;

	protected $_orderDataFactory;

	// public function __construct(Context $context, LoggerInterface $logger)
	// {
	// 	$this->_logger = $logger;
	// }

	public function __construct(Context $context, OrderDataFactory $orderDataFactory)
	{
		$this->_orderDataFactory = $orderDataFactory;
	}

	public function execute(Observer $observer)
	{
		// $this->_logger->info('Logging while order is saved');

    	$orderDetails = $observer->getEvent()->getOrder();

    	$orderData = $this->_orderDataFactory->create();

    	$orderData->addData([
            "order_id" 	=> $orderDetails->getId(),
            "taxvat" 	=> $orderDetails->getData('customer_taxvat')
        ]);

        $savedOrder = $orderData->save();
	} 
}	