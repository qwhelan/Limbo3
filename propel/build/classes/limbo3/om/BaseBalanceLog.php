<?php


/**
 * Base class that represents a row from the 'balance_log' table.
 *
 * 
 *
 * @package    propel.generator.limbo3.om
 */
abstract class BaseBalanceLog extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'BalanceLogPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        BalanceLogPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the new_balance field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $new_balance;

	/**
	 * The value for the time field.
	 * Note: this column has a database default value of: (expression) current_timestamp
	 * @var        string
	 */
	protected $time;

	/**
	 * The value for the purchase_id field.
	 * @var        int
	 */
	protected $purchase_id;

	/**
	 * The value for the sell_id field.
	 * @var        int
	 */
	protected $sell_id;

	/**
	 * The value for the deposit_id field.
	 * @var        int
	 */
	protected $deposit_id;

	/**
	 * The value for the transfer_id field.
	 * @var        int
	 */
	protected $transfer_id;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        Purchase
	 */
	protected $aPurchase;

	/**
	 * @var        Purchase
	 */
	protected $aSale;

	/**
	 * @var        Deposit
	 */
	protected $aDeposit;

	/**
	 * @var        Transfer
	 */
	protected $aTransfer;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->new_balance = 0;
	}

	/**
	 * Initializes internal state of BaseBalanceLog object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [new_balance] column value.
	 * 
	 * @return     double
	 */
	public function getNewBalance()
	{
		return $this->new_balance;
	}

	/**
	 * Get the [optionally formatted] temporal [time] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getTime($format = 'Y-m-d H:i:s')
	{
		if ($this->time === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->time);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->time, true), $x);
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [purchase_id] column value.
	 * 
	 * @return     int
	 */
	public function getPurchaseId()
	{
		return $this->purchase_id;
	}

	/**
	 * Get the [sell_id] column value.
	 * 
	 * @return     int
	 */
	public function getSellId()
	{
		return $this->sell_id;
	}

	/**
	 * Get the [deposit_id] column value.
	 * 
	 * @return     int
	 */
	public function getDepositId()
	{
		return $this->deposit_id;
	}

	/**
	 * Get the [transfer_id] column value.
	 * 
	 * @return     int
	 */
	public function getTransferId()
	{
		return $this->transfer_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     BalanceLog The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BalanceLogPeer::ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [new_balance] column.
	 * 
	 * @param      double $v new value
	 * @return     BalanceLog The current object (for fluent API support)
	 */
	public function setNewBalance($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->new_balance !== $v || $this->isNew()) {
			$this->new_balance = $v;
			$this->modifiedColumns[] = BalanceLogPeer::NEW_BALANCE;
		}

		return $this;
	} // setNewBalance()

	/**
	 * Sets the value of [time] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     BalanceLog The current object (for fluent API support)
	 */
	public function setTime($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->time !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->time !== null && $tmpDt = new DateTime($this->time)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->time = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = BalanceLogPeer::TIME;
			}
		} // if either are not null

		return $this;
	} // setTime()

	/**
	 * Set the value of [purchase_id] column.
	 * 
	 * @param      int $v new value
	 * @return     BalanceLog The current object (for fluent API support)
	 */
	public function setPurchaseId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->purchase_id !== $v) {
			$this->purchase_id = $v;
			$this->modifiedColumns[] = BalanceLogPeer::PURCHASE_ID;
		}

		if ($this->aPurchase !== null && $this->aPurchase->getId() !== $v) {
			$this->aPurchase = null;
		}

		return $this;
	} // setPurchaseId()

	/**
	 * Set the value of [sell_id] column.
	 * 
	 * @param      int $v new value
	 * @return     BalanceLog The current object (for fluent API support)
	 */
	public function setSellId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->sell_id !== $v) {
			$this->sell_id = $v;
			$this->modifiedColumns[] = BalanceLogPeer::SELL_ID;
		}

		if ($this->aSale !== null && $this->aSale->getId() !== $v) {
			$this->aSale = null;
		}

		return $this;
	} // setSellId()

	/**
	 * Set the value of [deposit_id] column.
	 * 
	 * @param      int $v new value
	 * @return     BalanceLog The current object (for fluent API support)
	 */
	public function setDepositId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->deposit_id !== $v) {
			$this->deposit_id = $v;
			$this->modifiedColumns[] = BalanceLogPeer::DEPOSIT_ID;
		}

		if ($this->aDeposit !== null && $this->aDeposit->getId() !== $v) {
			$this->aDeposit = null;
		}

		return $this;
	} // setDepositId()

	/**
	 * Set the value of [transfer_id] column.
	 * 
	 * @param      int $v new value
	 * @return     BalanceLog The current object (for fluent API support)
	 */
	public function setTransferId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->transfer_id !== $v) {
			$this->transfer_id = $v;
			$this->modifiedColumns[] = BalanceLogPeer::TRANSFER_ID;
		}

		if ($this->aTransfer !== null && $this->aTransfer->getId() !== $v) {
			$this->aTransfer = null;
		}

		return $this;
	} // setTransferId()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->new_balance !== 0) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->new_balance = ($row[$startcol + 1] !== null) ? (double) $row[$startcol + 1] : null;
			$this->time = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->purchase_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->sell_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->deposit_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->transfer_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = BalanceLogPeer::NUM_COLUMNS - BalanceLogPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating BalanceLog object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aUser !== null && $this->id !== $this->aUser->getId()) {
			$this->aUser = null;
		}
		if ($this->aPurchase !== null && $this->purchase_id !== $this->aPurchase->getId()) {
			$this->aPurchase = null;
		}
		if ($this->aSale !== null && $this->sell_id !== $this->aSale->getId()) {
			$this->aSale = null;
		}
		if ($this->aDeposit !== null && $this->deposit_id !== $this->aDeposit->getId()) {
			$this->aDeposit = null;
		}
		if ($this->aTransfer !== null && $this->transfer_id !== $this->aTransfer->getId()) {
			$this->aTransfer = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BalanceLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = BalanceLogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?
			$this->aUser = null;
			$this->aPurchase = null;
			$this->aSale = null;
			$this->aDeposit = null;
			$this->aTransfer = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BalanceLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				BalanceLogQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BalanceLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				BalanceLogPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUser !== null) {
				if ($this->aUser->isModified() || $this->aUser->isNew()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}

			if ($this->aPurchase !== null) {
				if ($this->aPurchase->isModified() || $this->aPurchase->isNew()) {
					$affectedRows += $this->aPurchase->save($con);
				}
				$this->setPurchase($this->aPurchase);
			}

			if ($this->aSale !== null) {
				if ($this->aSale->isModified() || $this->aSale->isNew()) {
					$affectedRows += $this->aSale->save($con);
				}
				$this->setSale($this->aSale);
			}

			if ($this->aDeposit !== null) {
				if ($this->aDeposit->isModified() || $this->aDeposit->isNew()) {
					$affectedRows += $this->aDeposit->save($con);
				}
				$this->setDeposit($this->aDeposit);
			}

			if ($this->aTransfer !== null) {
				if ($this->aTransfer->isModified() || $this->aTransfer->isNew()) {
					$affectedRows += $this->aTransfer->save($con);
				}
				$this->setTransfer($this->aTransfer);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setNew(false);
				} else {
					$affectedRows += BalanceLogPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}

			if ($this->aPurchase !== null) {
				if (!$this->aPurchase->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPurchase->getValidationFailures());
				}
			}

			if ($this->aSale !== null) {
				if (!$this->aSale->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSale->getValidationFailures());
				}
			}

			if ($this->aDeposit !== null) {
				if (!$this->aDeposit->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDeposit->getValidationFailures());
				}
			}

			if ($this->aTransfer !== null) {
				if (!$this->aTransfer->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransfer->getValidationFailures());
				}
			}


			if (($retval = BalanceLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BalanceLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNewBalance();
				break;
			case 2:
				return $this->getTime();
				break;
			case 3:
				return $this->getPurchaseId();
				break;
			case 4:
				return $this->getSellId();
				break;
			case 5:
				return $this->getDepositId();
				break;
			case 6:
				return $this->getTransferId();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $includeForeignObjects = false)
	{
		$keys = BalanceLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getNewBalance(),
			$keys[2] => $this->getTime(),
			$keys[3] => $this->getPurchaseId(),
			$keys[4] => $this->getSellId(),
			$keys[5] => $this->getDepositId(),
			$keys[6] => $this->getTransferId(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aUser) {
				$result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aPurchase) {
				$result['Purchase'] = $this->aPurchase->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aSale) {
				$result['Sale'] = $this->aSale->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aDeposit) {
				$result['Deposit'] = $this->aDeposit->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aTransfer) {
				$result['Transfer'] = $this->aTransfer->toArray($keyType, $includeLazyLoadColumns, true);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BalanceLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNewBalance($value);
				break;
			case 2:
				$this->setTime($value);
				break;
			case 3:
				$this->setPurchaseId($value);
				break;
			case 4:
				$this->setSellId($value);
				break;
			case 5:
				$this->setDepositId($value);
				break;
			case 6:
				$this->setTransferId($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BalanceLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNewBalance($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTime($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPurchaseId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSellId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDepositId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTransferId($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(BalanceLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(BalanceLogPeer::ID)) $criteria->add(BalanceLogPeer::ID, $this->id);
		if ($this->isColumnModified(BalanceLogPeer::NEW_BALANCE)) $criteria->add(BalanceLogPeer::NEW_BALANCE, $this->new_balance);
		if ($this->isColumnModified(BalanceLogPeer::TIME)) $criteria->add(BalanceLogPeer::TIME, $this->time);
		if ($this->isColumnModified(BalanceLogPeer::PURCHASE_ID)) $criteria->add(BalanceLogPeer::PURCHASE_ID, $this->purchase_id);
		if ($this->isColumnModified(BalanceLogPeer::SELL_ID)) $criteria->add(BalanceLogPeer::SELL_ID, $this->sell_id);
		if ($this->isColumnModified(BalanceLogPeer::DEPOSIT_ID)) $criteria->add(BalanceLogPeer::DEPOSIT_ID, $this->deposit_id);
		if ($this->isColumnModified(BalanceLogPeer::TRANSFER_ID)) $criteria->add(BalanceLogPeer::TRANSFER_ID, $this->transfer_id);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BalanceLogPeer::DATABASE_NAME);
		$criteria->add(BalanceLogPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of BalanceLog (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setId($this->id);
		$copyObj->setNewBalance($this->new_balance);
		$copyObj->setTime($this->time);
		$copyObj->setPurchaseId($this->purchase_id);
		$copyObj->setSellId($this->sell_id);
		$copyObj->setDepositId($this->deposit_id);
		$copyObj->setTransferId($this->transfer_id);

		$copyObj->setNew(true);
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     BalanceLog Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     BalanceLogPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BalanceLogPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     BalanceLog The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUser(User $v = null)
	{
		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}

		$this->aUser = $v;

		// Add binding for other direction of this 1:1 relationship.
		if ($v !== null) {
			$v->setBalanceLog($this);
		}

		return $this;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUser(PropelPDO $con = null)
	{
		if ($this->aUser === null && ($this->id !== null)) {
			$this->aUser = UserQuery::create()->findPk($this->id, $con);
			// Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
			$this->aUser->setBalanceLog($this);
		}
		return $this->aUser;
	}

	/**
	 * Declares an association between this object and a Purchase object.
	 *
	 * @param      Purchase $v
	 * @return     BalanceLog The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPurchase(Purchase $v = null)
	{
		if ($v === null) {
			$this->setPurchaseId(NULL);
		} else {
			$this->setPurchaseId($v->getId());
		}

		$this->aPurchase = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Purchase object, it will not be re-added.
		if ($v !== null) {
			$v->addBalanceLogRelatedByPurchaseId($this);
		}

		return $this;
	}


	/**
	 * Get the associated Purchase object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Purchase The associated Purchase object.
	 * @throws     PropelException
	 */
	public function getPurchase(PropelPDO $con = null)
	{
		if ($this->aPurchase === null && ($this->purchase_id !== null)) {
			$this->aPurchase = PurchaseQuery::create()->findPk($this->purchase_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aPurchase->addBalanceLogsRelatedByPurchaseId($this);
			 */
		}
		return $this->aPurchase;
	}

	/**
	 * Declares an association between this object and a Purchase object.
	 *
	 * @param      Purchase $v
	 * @return     BalanceLog The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSale(Purchase $v = null)
	{
		if ($v === null) {
			$this->setSellId(NULL);
		} else {
			$this->setSellId($v->getId());
		}

		$this->aSale = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Purchase object, it will not be re-added.
		if ($v !== null) {
			$v->addBalanceLogRelatedBySellId($this);
		}

		return $this;
	}


	/**
	 * Get the associated Purchase object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Purchase The associated Purchase object.
	 * @throws     PropelException
	 */
	public function getSale(PropelPDO $con = null)
	{
		if ($this->aSale === null && ($this->sell_id !== null)) {
			$this->aSale = PurchaseQuery::create()->findPk($this->sell_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aSale->addBalanceLogsRelatedBySellId($this);
			 */
		}
		return $this->aSale;
	}

	/**
	 * Declares an association between this object and a Deposit object.
	 *
	 * @param      Deposit $v
	 * @return     BalanceLog The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setDeposit(Deposit $v = null)
	{
		if ($v === null) {
			$this->setDepositId(NULL);
		} else {
			$this->setDepositId($v->getId());
		}

		$this->aDeposit = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Deposit object, it will not be re-added.
		if ($v !== null) {
			$v->addBalanceLog($this);
		}

		return $this;
	}


	/**
	 * Get the associated Deposit object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Deposit The associated Deposit object.
	 * @throws     PropelException
	 */
	public function getDeposit(PropelPDO $con = null)
	{
		if ($this->aDeposit === null && ($this->deposit_id !== null)) {
			$this->aDeposit = DepositQuery::create()->findPk($this->deposit_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aDeposit->addBalanceLogs($this);
			 */
		}
		return $this->aDeposit;
	}

	/**
	 * Declares an association between this object and a Transfer object.
	 *
	 * @param      Transfer $v
	 * @return     BalanceLog The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setTransfer(Transfer $v = null)
	{
		if ($v === null) {
			$this->setTransferId(NULL);
		} else {
			$this->setTransferId($v->getId());
		}

		$this->aTransfer = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Transfer object, it will not be re-added.
		if ($v !== null) {
			$v->addBalanceLog($this);
		}

		return $this;
	}


	/**
	 * Get the associated Transfer object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Transfer The associated Transfer object.
	 * @throws     PropelException
	 */
	public function getTransfer(PropelPDO $con = null)
	{
		if ($this->aTransfer === null && ($this->transfer_id !== null)) {
			$this->aTransfer = TransferQuery::create()->findPk($this->transfer_id, $con);
			/* The following can be used additionally to
				 guarantee the related object contains a reference
				 to this object.  This level of coupling may, however, be
				 undesirable since it could result in an only partially populated collection
				 in the referenced object.
				 $this->aTransfer->addBalanceLogs($this);
			 */
		}
		return $this->aTransfer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->new_balance = null;
		$this->time = null;
		$this->purchase_id = null;
		$this->sell_id = null;
		$this->deposit_id = null;
		$this->transfer_id = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

		$this->aUser = null;
		$this->aPurchase = null;
		$this->aSale = null;
		$this->aDeposit = null;
		$this->aTransfer = null;
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		if (preg_match('/get(\w+)/', $name, $matches)) {
			$virtualColumn = $matches[1];
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
			// no lcfirst in php<5.3...
			$virtualColumn[0] = strtolower($virtualColumn[0]);
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
		}
		return parent::__call($name, $params);
	}

} // BaseBalanceLog
