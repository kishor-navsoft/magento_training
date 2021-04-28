<?php 

namespace Shantanu\OrderTax\Observer; 
    
use Magento\Framework\Event\ObserverInterface; 

class SaveOrderTaxDetails implements ObserverInterface { 

    protected $_orderTax;
    protected $_result;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Shantanu\OrderTax\Model\OrderTaxFactory  $orderTax,
        \Magento\Framework\Controller\ResultFactory $result
    ) { 
        // parent::__construct($context);
        $this->_orderTax = $orderTax;
        $this->_result = $result;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) { 
        $order = $observer->getEvent()->getOrder();
        $customerId = $order->getCustomerId();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/templog.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('Catched event succssfully');
        $logger->info($order->getId());

        $modelIns = $this->_orderTax->create();
        $modelIns->addData([
            "order_id" => $order->getId(),
            "tax_id" => $order->getData('customer_taxvat')
        ]);
        $saveData = $modelIns->save();

   }
}