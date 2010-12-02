<?php


/**
 * Base class that represents a query for the 'balance_log' table.
 *
 * 
 *
 * @method     BalanceLogQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BalanceLogQuery orderByNewBalance($order = Criteria::ASC) Order by the new_balance column
 * @method     BalanceLogQuery orderByTime($order = Criteria::ASC) Order by the time column
 * @method     BalanceLogQuery orderByPurchaseId($order = Criteria::ASC) Order by the purchase_id column
 * @method     BalanceLogQuery orderBySellId($order = Criteria::ASC) Order by the sell_id column
 * @method     BalanceLogQuery orderByDepositId($order = Criteria::ASC) Order by the deposit_id column
 * @method     BalanceLogQuery orderByTransferId($order = Criteria::ASC) Order by the transfer_id column
 *
 * @method     BalanceLogQuery groupById() Group by the id column
 * @method     BalanceLogQuery groupByNewBalance() Group by the new_balance column
 * @method     BalanceLogQuery groupByTime() Group by the time column
 * @method     BalanceLogQuery groupByPurchaseId() Group by the purchase_id column
 * @method     BalanceLogQuery groupBySellId() Group by the sell_id column
 * @method     BalanceLogQuery groupByDepositId() Group by the deposit_id column
 * @method     BalanceLogQuery groupByTransferId() Group by the transfer_id column
 *
 * @method     BalanceLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BalanceLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BalanceLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BalanceLogQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     BalanceLogQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     BalanceLogQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     BalanceLogQuery leftJoinPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the Purchase relation
 * @method     BalanceLogQuery rightJoinPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Purchase relation
 * @method     BalanceLogQuery innerJoinPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the Purchase relation
 *
 * @method     BalanceLogQuery leftJoinSale($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sale relation
 * @method     BalanceLogQuery rightJoinSale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sale relation
 * @method     BalanceLogQuery innerJoinSale($relationAlias = null) Adds a INNER JOIN clause to the query using the Sale relation
 *
 * @method     BalanceLogQuery leftJoinDeposit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Deposit relation
 * @method     BalanceLogQuery rightJoinDeposit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Deposit relation
 * @method     BalanceLogQuery innerJoinDeposit($relationAlias = null) Adds a INNER JOIN clause to the query using the Deposit relation
 *
 * @method     BalanceLogQuery leftJoinTransfer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Transfer relation
 * @method     BalanceLogQuery rightJoinTransfer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Transfer relation
 * @method     BalanceLogQuery innerJoinTransfer($relationAlias = null) Adds a INNER JOIN clause to the query using the Transfer relation
 *
 * @method     BalanceLog findOne(PropelPDO $con = null) Return the first BalanceLog matching the query
 * @method     BalanceLog findOneOrCreate(PropelPDO $con = null) Return the first BalanceLog matching the query, or a new BalanceLog object populated from the query conditions when no match is found
 *
 * @method     BalanceLog findOneById(int $id) Return the first BalanceLog filtered by the id column
 * @method     BalanceLog findOneByNewBalance(double $new_balance) Return the first BalanceLog filtered by the new_balance column
 * @method     BalanceLog findOneByTime(string $time) Return the first BalanceLog filtered by the time column
 * @method     BalanceLog findOneByPurchaseId(int $purchase_id) Return the first BalanceLog filtered by the purchase_id column
 * @method     BalanceLog findOneBySellId(int $sell_id) Return the first BalanceLog filtered by the sell_id column
 * @method     BalanceLog findOneByDepositId(int $deposit_id) Return the first BalanceLog filtered by the deposit_id column
 * @method     BalanceLog findOneByTransferId(int $transfer_id) Return the first BalanceLog filtered by the transfer_id column
 *
 * @method     array findById(int $id) Return BalanceLog objects filtered by the id column
 * @method     array findByNewBalance(double $new_balance) Return BalanceLog objects filtered by the new_balance column
 * @method     array findByTime(string $time) Return BalanceLog objects filtered by the time column
 * @method     array findByPurchaseId(int $purchase_id) Return BalanceLog objects filtered by the purchase_id column
 * @method     array findBySellId(int $sell_id) Return BalanceLog objects filtered by the sell_id column
 * @method     array findByDepositId(int $deposit_id) Return BalanceLog objects filtered by the deposit_id column
 * @method     array findByTransferId(int $transfer_id) Return BalanceLog objects filtered by the transfer_id column
 *
 * @package    propel.generator.limbo3.om
 */
abstract class BaseBalanceLogQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseBalanceLogQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'limbo3', $modelName = 'BalanceLog', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BalanceLogQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BalanceLogQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BalanceLogQuery) {
			return $criteria;
		}
		$query = new BalanceLogQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    BalanceLog|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = BalanceLogPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BalanceLogPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BalanceLogPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BalanceLogPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the new_balance column
	 * 
	 * @param     double|array $newBalance The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByNewBalance($newBalance = null, $comparison = null)
	{
		if (is_array($newBalance)) {
			$useMinMax = false;
			if (isset($newBalance['min'])) {
				$this->addUsingAlias(BalanceLogPeer::NEW_BALANCE, $newBalance['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($newBalance['max'])) {
				$this->addUsingAlias(BalanceLogPeer::NEW_BALANCE, $newBalance['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BalanceLogPeer::NEW_BALANCE, $newBalance, $comparison);
	}

	/**
	 * Filter the query on the time column
	 * 
	 * @param     string|array $time The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByTime($time = null, $comparison = null)
	{
		if (is_array($time)) {
			$useMinMax = false;
			if (isset($time['min'])) {
				$this->addUsingAlias(BalanceLogPeer::TIME, $time['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($time['max'])) {
				$this->addUsingAlias(BalanceLogPeer::TIME, $time['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BalanceLogPeer::TIME, $time, $comparison);
	}

	/**
	 * Filter the query on the purchase_id column
	 * 
	 * @param     int|array $purchaseId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByPurchaseId($purchaseId = null, $comparison = null)
	{
		if (is_array($purchaseId)) {
			$useMinMax = false;
			if (isset($purchaseId['min'])) {
				$this->addUsingAlias(BalanceLogPeer::PURCHASE_ID, $purchaseId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($purchaseId['max'])) {
				$this->addUsingAlias(BalanceLogPeer::PURCHASE_ID, $purchaseId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BalanceLogPeer::PURCHASE_ID, $purchaseId, $comparison);
	}

	/**
	 * Filter the query on the sell_id column
	 * 
	 * @param     int|array $sellId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterBySellId($sellId = null, $comparison = null)
	{
		if (is_array($sellId)) {
			$useMinMax = false;
			if (isset($sellId['min'])) {
				$this->addUsingAlias(BalanceLogPeer::SELL_ID, $sellId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($sellId['max'])) {
				$this->addUsingAlias(BalanceLogPeer::SELL_ID, $sellId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BalanceLogPeer::SELL_ID, $sellId, $comparison);
	}

	/**
	 * Filter the query on the deposit_id column
	 * 
	 * @param     int|array $depositId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByDepositId($depositId = null, $comparison = null)
	{
		if (is_array($depositId)) {
			$useMinMax = false;
			if (isset($depositId['min'])) {
				$this->addUsingAlias(BalanceLogPeer::DEPOSIT_ID, $depositId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($depositId['max'])) {
				$this->addUsingAlias(BalanceLogPeer::DEPOSIT_ID, $depositId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BalanceLogPeer::DEPOSIT_ID, $depositId, $comparison);
	}

	/**
	 * Filter the query on the transfer_id column
	 * 
	 * @param     int|array $transferId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByTransferId($transferId = null, $comparison = null)
	{
		if (is_array($transferId)) {
			$useMinMax = false;
			if (isset($transferId['min'])) {
				$this->addUsingAlias(BalanceLogPeer::TRANSFER_ID, $transferId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($transferId['max'])) {
				$this->addUsingAlias(BalanceLogPeer::TRANSFER_ID, $transferId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BalanceLogPeer::TRANSFER_ID, $transferId, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User $user  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		return $this
			->addUsingAlias(BalanceLogPeer::ID, $user->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'User');
		}
		
		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Filter the query by a related Purchase object
	 *
	 * @param     Purchase $purchase  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByPurchase($purchase, $comparison = null)
	{
		return $this
			->addUsingAlias(BalanceLogPeer::PURCHASE_ID, $purchase->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Purchase relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function joinPurchase($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Purchase');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Purchase');
		}
		
		return $this;
	}

	/**
	 * Use the Purchase relation Purchase object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PurchaseQuery A secondary query class using the current class as primary query
	 */
	public function usePurchaseQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPurchase($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Purchase', 'PurchaseQuery');
	}

	/**
	 * Filter the query by a related Purchase object
	 *
	 * @param     Purchase $purchase  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterBySale($purchase, $comparison = null)
	{
		return $this
			->addUsingAlias(BalanceLogPeer::SELL_ID, $purchase->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Sale relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function joinSale($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Sale');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Sale');
		}
		
		return $this;
	}

	/**
	 * Use the Sale relation Purchase object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PurchaseQuery A secondary query class using the current class as primary query
	 */
	public function useSaleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSale($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Sale', 'PurchaseQuery');
	}

	/**
	 * Filter the query by a related Deposit object
	 *
	 * @param     Deposit $deposit  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByDeposit($deposit, $comparison = null)
	{
		return $this
			->addUsingAlias(BalanceLogPeer::DEPOSIT_ID, $deposit->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Deposit relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function joinDeposit($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Deposit');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Deposit');
		}
		
		return $this;
	}

	/**
	 * Use the Deposit relation Deposit object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    DepositQuery A secondary query class using the current class as primary query
	 */
	public function useDepositQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinDeposit($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Deposit', 'DepositQuery');
	}

	/**
	 * Filter the query by a related Transfer object
	 *
	 * @param     Transfer $transfer  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function filterByTransfer($transfer, $comparison = null)
	{
		return $this
			->addUsingAlias(BalanceLogPeer::TRANSFER_ID, $transfer->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Transfer relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function joinTransfer($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Transfer');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Transfer');
		}
		
		return $this;
	}

	/**
	 * Use the Transfer relation Transfer object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TransferQuery A secondary query class using the current class as primary query
	 */
	public function useTransferQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinTransfer($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Transfer', 'TransferQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     BalanceLog $balanceLog Object to remove from the list of results
	 *
	 * @return    BalanceLogQuery The current query, for fluid interface
	 */
	public function prune($balanceLog = null)
	{
		if ($balanceLog) {
			$this->addUsingAlias(BalanceLogPeer::ID, $balanceLog->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseBalanceLogQuery
