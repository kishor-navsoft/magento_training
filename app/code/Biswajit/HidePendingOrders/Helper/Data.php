<?php

namespace Biswajit\HidePendingOrders\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
	/**
   * @var \Magento\Framework\App\Config\ScopeConfigInterface
   */
   protected $scopeConfig;

   public function __construct(ScopeConfigInterface $scopeConfig)
   {
      $this->scopeConfig = $scopeConfig;
   }

	public function getConfig($path='')
   {
      if ($path) {
         return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
      }

      return $this->scopeConfig;
   }
}
