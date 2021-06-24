<?php

namespace Biswajit\Order\Controller\Adminhtml\Sales;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class OrderList extends Action
{
	const MENU_ID = 'Biswajit_Order::salesorder_list';

	protected $_resultPageFactory = false;

	public function __construct(Context $context, PageFactory $resultPageFactory)
	{
		parent::__construct($context);

		$this->_resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->_resultPageFactory->create();

		$resultPage->setActiveMenu(static::MENU_ID);

		$resultPage->getConfig()->getTitle()->prepend((__('List')));

		return $resultPage;
	}
}
