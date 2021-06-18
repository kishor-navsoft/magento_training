<?php

namespace Biswajit\HidePendingOrders\Block\Order;

use \Magento\Framework\App\ObjectManager;
use \Magento\Sales\Model\ResourceModel\Order\CollectionFactoryInterface;

use Biswajit\HidePendingOrders\Helper\Data as CustomHelper;

class History extends \Magento\Sales\Block\Order\History
{
    const PENDING_ORDER_VISIBILITY_STATUS = 'biswajit_orders/pending_orders/orders_visibility';

    private $_customHelper;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $_orderCollectionFactory;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * @var \Magento\Sales\Model\Order\Config
     */
    protected $_orderConfig;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Collection
     */
    protected $orders;

    /**
     * @var CollectionFactoryInterface
     */
    private $orderCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Sales\Model\Order\Config $orderConfig,
        array $data = [],
        CustomHelper $customHelper
    ) {
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_customerSession = $customerSession;
        $this->_orderConfig = $orderConfig;

        $this->_customHelper = $customHelper;

        parent::__construct(
            $context, 
            $orderCollectionFactory, 
            $customerSession,
            $orderConfig,
            $data
        );
    }

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        parent::_construct();
        $this->pageConfig->getTitle()->set(__('My Orders'));
    }

    /**
     * Provide order collection factory
     *
     * @return CollectionFactoryInterface
     * @deprecated 100.1.1
     */
    private function getOrderCollectionFactory()
    {
        if ($this->orderCollectionFactory === null) {
            $this->orderCollectionFactory = ObjectManager::getInstance()->get(CollectionFactoryInterface::class);
        }
        return $this->orderCollectionFactory;
    }

    /**
     * Get customer orders
     *
     * @return bool|\Magento\Sales\Model\ResourceModel\Order\Collection
     */
    public function getOrders()
    {
        if (!($customerId = $this->_customerSession->getCustomerId())) {
            return false;
        }

        if (!$this->orders) {
            $allowedOrderStatues = $this->_orderConfig->getVisibleOnFrontStatuses();

            $pendingOrderVisibility = $this->getPendingOrderVisibilityStatus();

            $pendingOrderVisibility = (bool)$pendingOrderVisibility ?? false;

            if (!$pendingOrderVisibility) {
                $allowedOrderStatues = array_values(array_diff($allowedOrderStatues, ['pending']));
            }

            $this->orders = $this->getOrderCollectionFactory()->create($customerId)->addFieldToSelect(
                '*'
            )->addFieldToFilter(
                'status',
                ['in' => $allowedOrderStatues]
            )->setOrder(
                'created_at',
                'desc'
            );
        }

        return $this->orders;
    }

    private function getPendingOrderVisibilityStatus()
    {
        return $this->_customHelper->getConfig(self::PENDING_ORDER_VISIBILITY_STATUS);
    }
}
