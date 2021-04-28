<?php
namespace Shantanu\OrderTax\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_orderTaxFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Shantanu\OrderTax\Model\OrderTaxFactory $orderTaxFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_orderTaxFactory = $orderTaxFactory;
		// return parent::__construct($context);
	}

	public function execute()
	{
		$order_tax = $this->_orderTaxFactory->create();
		$collection = $order_tax->getCollection();
		foreach($collection as $item){
			echo "<pre>";
			print_r($item->getData());
			echo "</pre>";
		}
		exit();
		return $this->_orderTaxFactory->create();
	}
}