<?php 
namespace Jeevannew\Nav\Observer; 
use Magento\Framework\Event\ObserverInterface; 
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ObjectManager;
use \Magento\Framework\App\ResourceConnection; 
class OrderdataObserver implements ObserverInterface 
{ 
protected $logger; 
public function __construct(LoggerInterface $logger) 
{ 
$this->logger = $logger;
}
public function execute(\Magento\Framework\Event\Observer $observer)
{

	$order = $observer->getEvent()->getOrder();
	
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    
    $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
    $connection = $this->_resources->getConnection();

    $themeTable = $this->_resources->getTableName('jeevannew_nav_table');
    $sql = "INSERT INTO ".$themeTable." (`order_id`,`taxvat`) VALUES (`order_id`='".$order->getEntityId()."',`taxvat`='". $order->getFullTaxInfo()."')";
    $connection->query($sql);

  }
}