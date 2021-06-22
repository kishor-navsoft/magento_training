<?php

namespace Biswajit\CustomProductOrderAttribute\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    const CUSTOM_ATTRIBUTE_CODE = 'product_custom_order';

    const CUSTOM_ATTRIBUTE_LABEL = 'Product Custom Order'; 

    private $_eavSetupFactory;

    private $_eavConfig;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->_eavSetupFactory = $eavSetupFactory;

        $this->_eavConfig = $eavConfig;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.0', '<')) {
            if (!$this->isProductAttributeExists(static::CUSTOM_ATTRIBUTE_CODE)) {
                $attributeProperties = [
                    'group' => 'General',
                    'type' => 'text',
                    'label' => static::CUSTOM_ATTRIBUTE_LABEL,
                    'input' => 'textarea',
                    'sort_order' => 45,
                    'source' => '',
                    'frontend' => '',
                    'backend' => '',
                    'required' => false,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'is_used_in_grid' => false,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => false,
                    'visible' => true,
                    'is_html_allowed_on_front' => true,
                    'visible_on_front' => false,
                    'is_wysiwyg_enabled' => true
                ];

                $this->createCustomAttribute($setup, static::CUSTOM_ATTRIBUTE_CODE, $attributeProperties);
            }
        }
    }

    private function isProductAttributeExists($field)
    {
        $attr = $this->_eavConfig->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $field);
 
        return ($attr && $attr->getId());
    }

    private function createCustomAttribute($setup, $attributeCode, $attributeProperties)
    {
        $setup->startSetup();

        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);
        
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            $attributeCode,
            $attributeProperties
        );

        $setup->endSetup();
    }    
}
