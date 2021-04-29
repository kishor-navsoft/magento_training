<?php

namespace Biswajit\Order\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\ResponseInterface;


class Index extends Action
{
	protected $_pageFactory;

	public function __construct(Context $context, PageFactory $pageFactory)
	{
		parent::__construct($context);

		$this->_pageFactory = $pageFactory;
	}

	public function execute()
	{
		$page = $this->_pageFactory->create();
		
        return $page;
	}
}
