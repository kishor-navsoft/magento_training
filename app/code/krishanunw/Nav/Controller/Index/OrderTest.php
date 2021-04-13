<?php

namespace krishanunw\Nav\Controller\Index;

class OrderTest extends \Magento\Framework\App\Action\Action
{

	public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'krishanunw'));
		$this->_eventManager->dispatch('krishanunw_display_text', ['mp_text' => $textDisplay]);
		echo $textDisplay->getText();
		exit;
	}
}