<?php

namespace Biswajit\Order\Controller\Adminhtml\Sales;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class OrderList extends Action
{
	protected $_resultPageFactory = false;

	public function __construct(Context $context, PageFactory $resultPageFactory)
	{
		parent::__construct($context);

		$this->_resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->_resultPageFactory->create();

		$resultPage->getConfig()->getTitle()->prepend((__('List')));

		return $resultPage;
	}
}
