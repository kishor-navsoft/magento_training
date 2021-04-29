<?php

namespace Biswajit\Order\Observer\Sales;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Action\Context;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\UrlInterface;

use Psr\Log\LoggerInterface;

class CustomerOrderEligibilityObserver implements ObserverInterface
{
	protected $_logger;

	protected $_orderCollectionFactory;

	protected $_responseFactory;

	protected $_url;

	public function __construct(Context $context, LoggerInterface $logger, CollectionFactory $orderCollectionFactory, ResponseFactory $responseFactory, UrlInterface $url)
	{
		$this->_logger = $logger;

		$this->_orderCollectionFactory = $orderCollectionFactory;

		$this->_responseFactory = $responseFactory;

		$this->_url = $url;
	}

	public function execute(Observer $observer)
	{
		$orderDetails = $observer->getEvent()->getOrder();

		$customerId = $orderDetails->getCustomerId();

		$this->_logger->info("Customer $customerId is about to place order");

		$pendingOrderList = $this->_orderCollectionFactory->create();

		$pendingOrderList->addFieldToFilter('customer_id', $customerId);

		$pendingOrderList->addFieldToFilter('status', 'pending');
        
		$pendingOrderList->addAttributeToSelect('*');

		$noOfPendingOrders = count($pendingOrderList->getData());

		$noOfAllowedPendingOrders = 1;

		$this->_logger->info("No. of Pending Orders of customer is $noOfPendingOrders");

		if ($noOfPendingOrders > $noOfAllowedPendingOrders) {
			$this->_logger->info("noOfPendingOrders is greater than noOfAllowedPendingOrders");

			$redirectionUrl = $this->_url->getUrl('sales/order/history');

			$this->_logger->info("Redirect URL : $redirectionUrl");
    		
			$this->_responseFactory->create()->setRedirect($redirectionUrl)->sendResponse();
    		
			die();
		}
	}
}