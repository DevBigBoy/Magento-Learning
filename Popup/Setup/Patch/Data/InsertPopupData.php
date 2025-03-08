<?php
namespace Learning\Popup\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\App\ResourceConnection;

class InsertPopupData implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * InsertPopupData constructor.
     *
     * @param ResourceConnection $resource
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ResourceConnection $resource,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->resource = $resource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Apply the patch: Insert dummy data into the learning_popup table.
     *
     * @return void
     */
    public function apply()
    {
        $connection = $this->resource->getConnection();
        $tableName = $this->resource->getTableName('learning_popup');

        // Dummy data to insert
        $data = [
            [
                'name' => 'Popup 1',
                'content' => 'This is a dummy popup content for Popup 1.',
                'created_at' => new \Zend_Db_Expr('CURRENT_TIMESTAMP'),
                'updated_at' => new \Zend_Db_Expr('CURRENT_TIMESTAMP'),
                'is_active' => 1,
                'timeout' => 10
            ],
            [
                'name' => 'Popup 2',
                'content' => 'This is another dummy popup content for Popup 2.',
                'created_at' => new \Zend_Db_Expr('CURRENT_TIMESTAMP'),
                'updated_at' => new \Zend_Db_Expr('CURRENT_TIMESTAMP'),
                'is_active' => 1,
                'timeout' => 15
            ],
            [
                'name' => 'Popup 3',
                'content' => 'This is a third dummy popup content for Popup 3.',
                'created_at' => new \Zend_Db_Expr('CURRENT_TIMESTAMP'),
                'updated_at' => new \Zend_Db_Expr('CURRENT_TIMESTAMP'),
                'is_active' => 1,
                'timeout' => 20
            ]
        ];

        // Insert the data into the table
        foreach ($data as $row) {
            $connection->insert($tableName, $row);
        }

        // Close the connection after use
        $connection = null;
    }

    /**
     * Revert the patch: Remove the inserted dummy data.
     *
     * @return void
     */
    public function revert()
    {
        $connection = $this->resource->getConnection();
        $tableName = $this->resource->getTableName('learning_popup');

        // Remove the inserted data (revert)
        $connection->delete($tableName, ['name LIKE ?' => 'Popup %']);

        // Close the connection after use
        $connection = null;
    }

    /**
     * Get the dependencies for this patch.
     * In this case, no other patches are required.
     *
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Get the aliases for this patch.
     * In this case, we can return an empty array, or you can add aliases if needed.
     *
     * @return array
     */
    public function getAliases()
    {
        return []; // You can add custom aliases if needed.
    }
}
