<?php 
namespace Jeevannew\Nav\Observer; 
use Magento\Framework\Event\ObserverInterface; 
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ObjectManager;
use \Magento\Framework\App\ResourceConnection; 
class OrderdataObserver implements ObserverInterface 
{ 
// protected $logger; 
// public function __construct(LoggerInterface $logger) 
// { 
// $this->logger = $logger;
// }
    protected $_dataExample;
    protected $resultRedirect;
    public function __construct(\Magento\Framework\App\Action\Context $context,
        \Jeevannew\Nav\Model\JeevanTableFactory  $dataExample,
    \Magento\Framework\Controller\ResultFactory $result){
        //parent::__construct($context);
        $this->_dataExample = $dataExample;
        $this->resultRedirect = $result;
    }
public function execute(\Magento\Framework\Event\Observer $observer)
{

    //$order = $observer->getEvent()->getOrder();
    $order = $observer->getEvent()->getOrder();

    $model = $this->_dataExample->create();
        $model->addData([
            "order_id" => $order->getId(),
            "taxvat" => $order->getData('customer_taxvat')
            ]);
        $saveData = $model->save();
    
    // $orderId = $observer->getEvent()->getOrderIds();
 //    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    
 //    $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
 //    $connection = $this->_resources->getConnection();

 //    $themeTable = $this->_resources->getTableName('jeevannew_nav_table');
 //    $sql = "INSERT INTO ".$themeTable." (`order_id`,`taxvat`) VALUES (`order_id`='".$orderId[0]."',`taxvat`='". $order->getFullTaxInfo()."')";
 //    $connection->query($sql);

  }
}