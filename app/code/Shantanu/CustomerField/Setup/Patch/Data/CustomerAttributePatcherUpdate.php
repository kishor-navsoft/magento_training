<?php
 
namespace Shantanu\CustomerField\Setup\Patch\Data;
 
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Setup\CustomerSetup;
 
class CustomerAttributePatcherUpdate implements DataPatchInterface, PatchRevertableInterface
{
 
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var CustomerSetup
     */
    private $customerSetupFactory;
 
    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }
 
    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'fathers_name',
            [
                'type' => 'varchar',
                'label' => 'Father',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 1,
                'system' => false,
                'backend' => ''
            ]
        );
         
        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'fathers_name')->addData([
            'used_in_forms' => [
                'adminhtml_checkout',
                'adminhtml_customer',
                'adminhtml_customer_address',
                'customer_account_edit',
                'customer_address_edit',
                'customer_register_address',
                'customer_account_create'
            ]
        ]);
        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'spouce',
            [
                'type' => 'varchar',
                'label' => 'Spouce',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 1,
                'system' => false,
                'backend' => ''
            ]
        );
         
        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'spouce')->addData([
            'used_in_forms' => [
                'adminhtml_checkout',
                'adminhtml_customer',
                'adminhtml_customer_address',
                'customer_account_edit',
                'customer_address_edit',
                'customer_register_address',
                'customer_account_create'
            ]
        ]);
        $attribute->save();
 
        $this->moduleDataSetup->getConnection()->endSetup();
    }
 
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, 'customer_salutation');
 
        $this->moduleDataSetup->getConnection()->endSetup();
    }
 
    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
 
    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
         
        ];
    }
}