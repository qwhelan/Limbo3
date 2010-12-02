<?php



/**
 * This class defines the structure of the 'balance_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.limbo3.map
 */
class BalanceLogTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'limbo3.map.BalanceLogTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('balance_log');
		$this->setPhpName('BalanceLog');
		$this->setClassname('BalanceLog');
		$this->setPackage('limbo3');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'user', 'ID', true, null, null);
		$this->addColumn('NEW_BALANCE', 'NewBalance', 'DOUBLE', true, null, 0);
		$this->addColumn('TIME', 'Time', 'TIMESTAMP', false, null, 'current_timestamp');
		$this->addForeignKey('PURCHASE_ID', 'PurchaseId', 'INTEGER', 'purchase', 'ID', false, null, null);
		$this->addForeignKey('SELL_ID', 'SellId', 'INTEGER', 'purchase', 'ID', false, null, null);
		$this->addForeignKey('DEPOSIT_ID', 'DepositId', 'INTEGER', 'deposit', 'ID', false, null, null);
		$this->addForeignKey('TRANSFER_ID', 'TransferId', 'INTEGER', 'transfer', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('id' => 'id', ), null, null);
    $this->addRelation('Purchase', 'Purchase', RelationMap::MANY_TO_ONE, array('purchase_id' => 'id', ), null, null);
    $this->addRelation('Sale', 'Purchase', RelationMap::MANY_TO_ONE, array('sell_id' => 'id', ), null, null);
    $this->addRelation('Deposit', 'Deposit', RelationMap::MANY_TO_ONE, array('deposit_id' => 'id', ), null, null);
    $this->addRelation('Transfer', 'Transfer', RelationMap::MANY_TO_ONE, array('transfer_id' => 'id', ), null, null);
	} // buildRelations()

} // BalanceLogTableMap
