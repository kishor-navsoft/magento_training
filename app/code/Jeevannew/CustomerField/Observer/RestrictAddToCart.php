<?php
namespace Jeevannew\CustomerField\Observer;
 
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Http\Context as AuthContext;
 
class RestrictAddToCart implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $_messageManager;
    protected $customerSession;
    private $authContext;
    protected $_customerRepositoryInterface;
 
    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    )
    {
        $this->_messageManager = $messageManager;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $customerSession;
    }
 
    /**
     * add to cart event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     *
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customerId = $this->customerSession->getCustomer()->getId();
        $customer = $this->_customerRepositoryInterface->getById($customerId);
        $attr = $customer->getCustomAttribute('add_to_cart_button');
        if ($customer->getCustomAttribute('add_to_cart_button')->getValue()) {
                $this->_messageManager->addError(__('add to cart not possible'));
                //set false if you not want to add product to cart
                $observer->getRequest()->setParam('product', false);
                return $this;
         }
 
        return $this;
    }
}