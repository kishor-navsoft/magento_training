<?php

namespace Biswajit\Order\Observer\Sales;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Action\Context;

use Psr\Log\LoggerInterface;


class OrderDataObserver implements ObserverInterface
{
	protected $logger;

	public function __construct(Context $context, LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function execute(Observer $observer)
	{
		$this->logger->info('Logging while order is saved');
	} 
}	