<?php 
namespace krishanunw\Nav\Observer; 
use Magento\Framework\Event\ObserverInterface; 
use Psr\Log\LoggerInterface; 
use Krishanu\Nav\Model\KrishanunwTable;
class OrdedataObserver implements ObserverInterface 
{ 
protected $_krishanuTable;
protected $logger; 
public function __construct(LoggerInterface$logger,  \Krishanu\Nav\Model\KrishanunwTable  $krishanuTable) 
{
  $this->_krishanuTable = $krishanuTable;
  $this->logger = $logger;
}
public function execute(\Magento\Framework\Event\Observer $observer)
{
 try 
{
    $model = $this->_krishanuTable->create();
    $order = $observer->getEvent()->getOrder();
    $model->addData([
			"id" => rand(99999),
			"order_id" => $order,
			"status" => true,
			"sort_order" => 1
			]);
    $saveData = $model->save();

}
catch (\Exception $e) 
{
 $this->logger->info($e->getMessage());
}
  }
}