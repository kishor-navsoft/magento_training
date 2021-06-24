<?php 

namespace Shantanu\CustomerField\Controller\Customer;

class Index extends \Magento\Framework\App\Action\Action { 
	protected $resultPageFactory;
	protected $customerSession;

    public function __construct(        
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
        // \Magento\Customer\Model\Session $customerSession
    ) {  
        $this->resultPageFactory = $resultPageFactory;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        // $this->customerSession = $customerSession;
        parent::__construct($context);
    }

	public function execute() { 
		$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/templog1.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('Page Start');
		$this->_view->loadLayout(); 
		$this->_view->renderLayout(); 

		// $customer = $this->customerSession;
		// $logger->info("Customer data::". json_encode($customer));
	    // $customerId = $customer->getId();
	    // $logger->info("Customer id::". $customerId);

	 //    $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
		// $customerSession = $objectManager->get('Magento\Customer\Model\Session');
		// $logger->info("Customer id2::". $customerSession->getId()); 


	    //  // echo $customerId; exit;
	    // $customer = $this->customerRepositoryInterface->getById($customerId);
	    // $customerAttributeData = $customer->__toArray();
	    // $isVendor = $customerAttributeData['custom_attributes']['is_vendor']['value'];
	    // echo "<pre>";print_r($customerAttributeData['custom_attributes']);exit;
	} 

} 
?>