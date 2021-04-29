<?php

namespace Biswajit\Order\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\DataObject;

class Test extends Action
{
	public function execute()
	{
		$textDisplay = new DataObject(['text' => 'Biswajit Order Event Test Text']);

		$this->_eventManager->dispatch('biswajit_order_display_text', ['bo_text' => $textDisplay]);

		echo $textDisplay->getText();

		exit;
	}
}
