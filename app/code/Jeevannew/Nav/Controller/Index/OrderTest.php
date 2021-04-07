<?php

namespace Jeevannew\Nav\Controller\Index;

class OrderTest extends \Magento\Framework\App\Action\Action
{

	public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'JeevanNew'));
		$this->_eventManager->dispatch('jeevannew_nav_display_text', ['mp_text' => $textDisplay]);
		echo $textDisplay->getText();
		exit;
	}
}