<?php

namespace Biswajit\Order\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class ShowTestText implements ObserverInterface
{
	public function execute(Observer $observer)
	{
		$displayText = $observer->getData('bo_text');

		echo $displayText->getText() . " - Event </br>";
		
		$displayText->setText('Execute event successfully.');

		return $this;
	}
}
