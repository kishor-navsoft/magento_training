<?php

namespace Shantanu\CustomerField\Block;

use Magento\Framework\App\Http\Context as AuthContext;

class CustomerData extends \Magento\Framework\View\Element\Template {

    protected $customerSession;
    private $authContext;
    protected $_customerRepositoryInterface;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $customerSession;
    }
    
    public function getWelcomeText() {        
        return 'Hello World';
    }

    public function getFather() {
        $customerId = $this->customerSession->getCustomer()->getId();
        $customer = $this->_customerRepositoryInterface->getById($customerId);
        $attr = $customer->getCustomAttribute('fathers_name');
        return $attr->getValue();
    }

    public function getSpouce() {
        $customerId = $this->customerSession->getCustomer()->getId();
        $customer = $this->_customerRepositoryInterface->getById($customerId);
        $attr = $customer->getCustomAttribute('spouce');
        return $attr->getValue();
    }
}