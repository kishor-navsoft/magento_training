<?php

namespace Biswajit\Order\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
	public function __construct(Context $context)
	{
		parent::__construct($context);
	}

	public function index()
	{
		return __('Test View');
	}

	public function getText() 
	{
        return "Hello World";
    }
}
