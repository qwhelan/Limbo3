<?php


/**
 * Base class that represents a row from the 'user' table.
 *
 * 
 *
 * @package    propel.generator.limbo3.om
 */
abstract class BaseUser extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'UserPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UserPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the username field.
	 * @var        string
	 */
	protected $username;

	/**
	 * The value for the pandora_username field.
	 * @var        string
	 */
	protected $pandora_username;

	/**
	 * The value for the real_name field.
	 * @var        string
	 */
	protected $real_name;

	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;

	/**
	 * The value for the balance field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $balance;

	/**
	 * The value for the created field.
	 * Note: this column has a database default value of: (expression) current_timestamp
	 * @var        string
	 */
	protected $created;

	/**
	 * @var        BalanceLog one-to-one related BalanceLog object
	 */
	protected $singleBalanceLog;

	/**
	 * @var        array Stock[] Collection to store aggregation of Stock objects.
	 */
	protected $collStocks;

	/**
	 * @var        array Purchase[] Collection to store aggregation of Purchase objects.
	 */
	protected $collPurchases;

        /**
         * @var        array Option[] Collection to store aggregation of Option objects.
         */
        protected $collOptions;

	/**
	 * @var        array Deposit[] Collection to store aggregation of Deposit objects.
	 */
	protected $collDeposits;

	/**
	 * @var        array Transfer[] Collection to store aggregation of Transfer objects.
	 */
	protected $collTransfersRelatedByFromUser;

	/**
	 * @var        array Transfer[] Collection to store aggregation of Transfer objects.
	 */
	protected $collTransfersRelatedByToUser;

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
		$this->balance = 0;
	}

	/**
	 * Initializes internal state of BaseUser object.
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
	 * Get the [username] column value.
	 * 
	 * @return     string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the [pandora_username] column value.
	 * 
	 * @return     string
	 */
	public function getPandoraUsername()
	{
		return $this->pandora_username;
	}

	/**
	 * Get the [real_name] column value.
	 * 
	 * @return     string
	 */
	public function getRealName()
	{
		return $this->real_name;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the [balance] column value.
	 * 
	 * @return     double
	 */
	public function getBalance()
	{
		return $this->balance;
	}

	/**
	 * Get the [optionally formatted] temporal [created] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreated($format = 'Y-m-d H:i:s')
	{
		if ($this->created === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->created);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created, true), $x);
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UserPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [username] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = UserPeer::USERNAME;
		}

		return $this;
	} // setUsername()

	/**
	 * Set the value of [pandora_username] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPandoraUsername($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->pandora_username !== $v) {
			$this->pandora_username = $v;
			$this->modifiedColumns[] = UserPeer::PANDORA_USERNAME;
		}

		return $this;
	} // setPandoraUsername()

	/**
	 * Set the value of [real_name] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setRealName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->real_name !== $v) {
			$this->real_name = $v;
			$this->modifiedColumns[] = UserPeer::REAL_NAME;
		}

		return $this;
	} // setRealName()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

		return $this;
	} // setEmail()

	/**
	 * Set the value of [balance] column.
	 * 
	 * @param      double $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setBalance($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->balance !== $v || $this->isNew()) {
			$this->balance = $v;
			$this->modifiedColumns[] = UserPeer::BALANCE;
		}

		return $this;
	} // setBalance()

	/**
	 * Sets the value of [created] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     User The current object (for fluent API support)
	 */
	public function setCreated($v)
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

		if ( $this->created !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created !== null && $tmpDt = new DateTime($this->created)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = UserPeer::CREATED;
			}
		} // if either are not null

		return $this;
	} // setCreated()

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
			if ($this->balance !== 0) {
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
			$this->username = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->pandora_username = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->real_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->email = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->balance = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
			$this->created = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = UserPeer::NUM_COLUMNS - UserPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?
			$this->singleBalanceLog = null;
			$this->collStocks = null;
			$this->collPurchases = null;
			$this->collOptions = null;
			$this->collDeposits = null;
			$this->collTransfersRelatedByFromUser = null;
			$this->collTransfersRelatedByToUser = null;
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				UserQuery::create()
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				UserPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = UserPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(UserPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows = 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows = UserPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->singleBalanceLog !== null) {
				if (!$this->singleBalanceLog->isDeleted()) {
						$affectedRows += $this->singleBalanceLog->save($con);
				}
			}

			if ($this->collStocks !== null) {
				foreach ($this->collStocks as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPurchases !== null) {
				foreach ($this->collPurchases as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOptions !== null) {
				foreach ($this->collOptions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDeposits !== null) {
				foreach ($this->collDeposits as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTransfersRelatedByFromUser !== null) {
				foreach ($this->collTransfersRelatedByFromUser as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTransfersRelatedByToUser !== null) {
				foreach ($this->collTransfersRelatedByToUser as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->singleBalanceLog !== null) {
					if (!$this->singleBalanceLog->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleBalanceLog->getValidationFailures());
					}
				}

				if ($this->collStocks !== null) {
					foreach ($this->collStocks as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPurchases !== null) {
					foreach ($this->collPurchases as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOptions !== null) {
                                        foreach ($this->collOptions as $referrerFK) {
                                                if (!$referrerFK->validate($columns)) {
                                                        $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                                                }
                                        }
                                }

				if ($this->collDeposits !== null) {
					foreach ($this->collDeposits as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTransfersRelatedByFromUser !== null) {
					foreach ($this->collTransfersRelatedByFromUser as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTransfersRelatedByToUser !== null) {
					foreach ($this->collTransfersRelatedByToUser as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUsername();
				break;
			case 2:
				return $this->getPandoraUsername();
				break;
			case 3:
				return $this->getRealName();
				break;
			case 4:
				return $this->getEmail();
				break;
			case 5:
				return $this->getBalance();
				break;
			case 6:
				return $this->getCreated();
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
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUsername(),
			$keys[2] => $this->getPandoraUsername(),
			$keys[3] => $this->getRealName(),
			$keys[4] => $this->getEmail(),
			$keys[5] => $this->getBalance(),
			$keys[6] => $this->getCreated(),
		);
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUsername($value);
				break;
			case 2:
				$this->setPandoraUsername($value);
				break;
			case 3:
				$this->setRealName($value);
				break;
			case 4:
				$this->setEmail($value);
				break;
			case 5:
				$this->setBalance($value);
				break;
			case 6:
				$this->setCreated($value);
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
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPandoraUsername($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRealName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setBalance($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreated($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::USERNAME)) $criteria->add(UserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(UserPeer::PANDORA_USERNAME)) $criteria->add(UserPeer::PANDORA_USERNAME, $this->pandora_username);
		if ($this->isColumnModified(UserPeer::REAL_NAME)) $criteria->add(UserPeer::REAL_NAME, $this->real_name);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::BALANCE)) $criteria->add(UserPeer::BALANCE, $this->balance);
		if ($this->isColumnModified(UserPeer::CREATED)) $criteria->add(UserPeer::CREATED, $this->created);

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
		$criteria = new Criteria(UserPeer::DATABASE_NAME);
		$criteria->add(UserPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of User (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setUsername($this->username);
		$copyObj->setPandoraUsername($this->pandora_username);
		$copyObj->setRealName($this->real_name);
		$copyObj->setEmail($this->email);
		$copyObj->setBalance($this->balance);
		$copyObj->setCreated($this->created);

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			$relObj = $this->getBalanceLog();
			if ($relObj) {
				$copyObj->setBalanceLog($relObj->copy($deepCopy));
			}

			foreach ($this->getStocks() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addStock($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPurchases() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPurchase($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getOptions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addOption($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getDeposits() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addDeposit($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTransfersRelatedByFromUser() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTransferRelatedByFromUser($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTransfersRelatedByToUser() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTransferRelatedByToUser($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);
		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     User Clone of current object.
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
	 * @return     UserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	/**
	 * Gets a single BalanceLog object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con optional connection object
	 * @return     BalanceLog
	 * @throws     PropelException
	 */
	public function getBalanceLog(PropelPDO $con = null)
	{

		if ($this->singleBalanceLog === null && !$this->isNew()) {
			$this->singleBalanceLog = BalanceLogQuery::create()->findPk($this->getPrimaryKey(), $con);
		}

		return $this->singleBalanceLog;
	}

	/**
	 * Sets a single BalanceLog object as related to this object by a one-to-one relationship.
	 *
	 * @param      BalanceLog $v BalanceLog
	 * @return     User The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setBalanceLog(BalanceLog $v = null)
	{
		$this->singleBalanceLog = $v;

		// Make sure that that the passed-in BalanceLog isn't already associated with this object
		if ($v !== null && $v->getUser() === null) {
			$v->setUser($this);
		}

		return $this;
	}

	/**
	 * Clears out the collStocks collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addStocks()
	 */
	public function clearStocks()
	{
		$this->collStocks = null; // important to set this to NULL since that means it is uninitialized
	}

        /**
         * Clears out the collOptions collection
         *
         * This does not modify the database; however, it will remove any associated objects, causing
         * them to be refetched by subsequent calls to accessor method.
         *
         * @return     void
         * @see        addOptions()
         */
        public function clearOptions()
        {
                $this->collOptions = null; // important to set this to NULL since that means it is uninitialized
        }

	/**
	 * Initializes the collStocks collection.
	 *
	 * By default this just sets the collStocks collection to an empty array (like clearcollStocks());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initStocks()
	{
		$this->collStocks = new PropelObjectCollection();
		$this->collStocks->setModel('Stock');
	}

        /**
         * Initializes the collOptions collection.
         *
         * By default this just sets the collOptions collection to an empty array (like clearcollOptions());
         * however, you may wish to override this method in your stub class to provide setting appropriate
         * to your application -- for example, setting the initial array to the values stored in database.
         *
         * @return     void
         */
        public function initOptions()
        {
                $this->collOptions = new PropelObjectCollection();
                $this->collOptions->setModel('Option');
        }

	/**
	 * Gets an array of Stock objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Stock[] List of Stock objects
	 * @throws     PropelException
	 */
	public function getStocks($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collStocks || null !== $criteria) {
			if ($this->isNew() && null === $this->collStocks) {
				// return empty collection
				$this->initStocks();
			} else {
				$collStocks = StockQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collStocks;
				}
				$this->collStocks = $collStocks;
			}
		}
		return $this->collStocks;
	}

        /**
         * Gets an array of Option objects which contain a foreign key that references this object.
         *
         * If the $criteria is not null, it is used to always fetch the results from the database.
         * Otherwise the results are fetched from the database the first time, then cached.
         * Next time the same method is called without $criteria, the cached collection is returned.
         * If this User is new, it will return
         * an empty collection or the current collection; the criteria is ignored on a new object.
         *
         * @param      Criteria $criteria optional Criteria object to narrow the query
         * @param      PropelPDO $con optional connection object
         * @return     PropelCollection|array Option[] List of Option objects
         * @throws     PropelException
         */
        public function getOptions($criteria = null, PropelPDO $con = null)
        {
                if(null === $this->collOptions || null !== $criteria) {
                        if ($this->isNew() && null === $this->collOptions) {
                                // return empty collection
                                $this->initOptions();
                        } else {
                                $collOptions = OptionQuery::create(null, $criteria)
                                        ->filterByUser($this)
                                        ->find($con);
                                if (null !== $criteria) {
                                        return $collOptions;
                                }
                                $this->collOptions = $collOptions;
                        }
                }
                return $this->collOptions;
        }


	/**
	 * Returns the number of related Stock objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Stock objects.
	 * @throws     PropelException
	 */
	public function countStocks(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collStocks || null !== $criteria) {
			if ($this->isNew() && null === $this->collStocks) {
				return 0;
			} else {
				$query = StockQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collStocks);
		}
	}

        /**
         * Returns the number of related Option objects.
         *
         * @param      Criteria $criteria
         * @param      boolean $distinct
         * @param      PropelPDO $con
         * @return     int Count of related Option objects.
         * @throws     PropelException
         */
        public function countOptions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
        {
                if(null === $this->collOptions || null !== $criteria) {
                        if ($this->isNew() && null === $this->collOptions) {
                                return 0;
                        } else {
                                $query = OptionQuery::create(null, $criteria);
                                if($distinct) {
                                        $query->distinct();
                                }
                                return $query
                                        ->filterByUser($this)
                                        ->count($con);
                        }
                } else {
                        return count($this->collOptions);
                }
        }


	/**
	 * Method called to associate a Stock object to this object
	 * through the Stock foreign key attribute.
	 *
	 * @param      Stock $l Stock
	 * @return     void
	 * @throws     PropelException
	 */
	public function addStock(Stock $l)
	{
		if ($this->collStocks === null) {
			$this->initStocks();
		}
		if (!$this->collStocks->contains($l)) { // only add it if the **same** object is not already associated
			$this->collStocks[]= $l;
			$l->setUser($this);
		}
	}

        /**
         * Method called to associate a Option object to this object
         * through the Stock foreign key attribute.
         *
         * @param      Option $l Option
         * @return     void
         * @throws     PropelException
         */
        public function addOption(Option $l)
        {
                if ($this->collOptions === null) {
                        $this->initOptions();
                }
                if (!$this->collOptions->contains($l)) { // only add it if the **same** object is not already associated
                        $this->collOptions[]= $l;
                        $l->setUser($this);
                }
        }

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related Stocks from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Stock[] List of Stock objects
	 */
	public function getStocksJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = StockQuery::create(null, $criteria);
		$query->joinWith('Item', $join_behavior);

		return $this->getStocks($query, $con);
	}

        /**
         * If this collection has already been initialized with
         * an identical criteria, it returns the collection.
         * Otherwise if this User is new, it will return
         * an empty collection; or if this User has previously
         * been saved, it will retrieve related Stocks from storage.
         *
         * This method is protected by default in order to keep the public
         * api reasonable.  You can provide public methods for those you
         * actually need in User.
         *
         * @param      Criteria $criteria optional Criteria object to narrow the query
         * @param      PropelPDO $con optional connection object
         * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
         * @return     PropelCollection|array Option[] List of Option objects
         */
        public function getOptionsJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
        {
                $query = OptionQuery::create(null, $criteria);
                $query->joinWith('Item', $join_behavior);

                return $this->getOptions($query, $con);
        }


	/**
	 * Clears out the collPurchases collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPurchases()
	 */
	public function clearPurchases()
	{
		$this->collPurchases = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPurchases collection.
	 *
	 * By default this just sets the collPurchases collection to an empty array (like clearcollPurchases());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPurchases()
	{
		$this->collPurchases = new PropelObjectCollection();
		$this->collPurchases->setModel('Purchase');
	}

	/**
	 * Gets an array of Purchase objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Purchase[] List of Purchase objects
	 * @throws     PropelException
	 */
	public function getPurchases($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPurchases || null !== $criteria) {
			if ($this->isNew() && null === $this->collPurchases) {
				// return empty collection
				$this->initPurchases();
			} else {
				$collPurchases = PurchaseQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collPurchases;
				}
				$this->collPurchases = $collPurchases;
			}
		}
		return $this->collPurchases;
	}

	/**
	 * Returns the number of related Purchase objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Purchase objects.
	 * @throws     PropelException
	 */
	public function countPurchases(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPurchases || null !== $criteria) {
			if ($this->isNew() && null === $this->collPurchases) {
				return 0;
			} else {
				$query = PurchaseQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collPurchases);
		}
	}

	/**
	 * Method called to associate a Purchase object to this object
	 * through the Purchase foreign key attribute.
	 *
	 * @param      Purchase $l Purchase
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPurchase(Purchase $l)
	{
		if ($this->collPurchases === null) {
			$this->initPurchases();
		}
		if (!$this->collPurchases->contains($l)) { // only add it if the **same** object is not already associated
			$this->collPurchases[]= $l;
			$l->setUser($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related Purchases from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Purchase[] List of Purchase objects
	 */
	public function getPurchasesJoinStock($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = PurchaseQuery::create(null, $criteria);
		$query->joinWith('Stock', $join_behavior);

		return $this->getPurchases($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related Purchases from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Purchase[] List of Purchase objects
	 */
	public function getPurchasesJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = PurchaseQuery::create(null, $criteria);
		$query->joinWith('Item', $join_behavior);

		return $this->getPurchases($query, $con);
	}

	/**
	 * Clears out the collDeposits collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addDeposits()
	 */
	public function clearDeposits()
	{
		$this->collDeposits = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collDeposits collection.
	 *
	 * By default this just sets the collDeposits collection to an empty array (like clearcollDeposits());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initDeposits()
	{
		$this->collDeposits = new PropelObjectCollection();
		$this->collDeposits->setModel('Deposit');
	}

	/**
	 * Gets an array of Deposit objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Deposit[] List of Deposit objects
	 * @throws     PropelException
	 */
	public function getDeposits($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collDeposits || null !== $criteria) {
			if ($this->isNew() && null === $this->collDeposits) {
				// return empty collection
				$this->initDeposits();
			} else {
				$collDeposits = DepositQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collDeposits;
				}
				$this->collDeposits = $collDeposits;
			}
		}
		return $this->collDeposits;
	}

	/**
	 * Returns the number of related Deposit objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Deposit objects.
	 * @throws     PropelException
	 */
	public function countDeposits(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collDeposits || null !== $criteria) {
			if ($this->isNew() && null === $this->collDeposits) {
				return 0;
			} else {
				$query = DepositQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collDeposits);
		}
	}

	/**
	 * Method called to associate a Deposit object to this object
	 * through the Deposit foreign key attribute.
	 *
	 * @param      Deposit $l Deposit
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDeposit(Deposit $l)
	{
		if ($this->collDeposits === null) {
			$this->initDeposits();
		}
		if (!$this->collDeposits->contains($l)) { // only add it if the **same** object is not already associated
			$this->collDeposits[]= $l;
			$l->setUser($this);
		}
	}

	/**
	 * Clears out the collTransfersRelatedByFromUser collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTransfersRelatedByFromUser()
	 */
	public function clearTransfersRelatedByFromUser()
	{
		$this->collTransfersRelatedByFromUser = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTransfersRelatedByFromUser collection.
	 *
	 * By default this just sets the collTransfersRelatedByFromUser collection to an empty array (like clearcollTransfersRelatedByFromUser());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initTransfersRelatedByFromUser()
	{
		$this->collTransfersRelatedByFromUser = new PropelObjectCollection();
		$this->collTransfersRelatedByFromUser->setModel('Transfer');
	}

	/**
	 * Gets an array of Transfer objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Transfer[] List of Transfer objects
	 * @throws     PropelException
	 */
	public function getTransfersRelatedByFromUser($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTransfersRelatedByFromUser || null !== $criteria) {
			if ($this->isNew() && null === $this->collTransfersRelatedByFromUser) {
				// return empty collection
				$this->initTransfersRelatedByFromUser();
			} else {
				$collTransfersRelatedByFromUser = TransferQuery::create(null, $criteria)
					->filterByUserFrom($this)
					->find($con);
				if (null !== $criteria) {
					return $collTransfersRelatedByFromUser;
				}
				$this->collTransfersRelatedByFromUser = $collTransfersRelatedByFromUser;
			}
		}
		return $this->collTransfersRelatedByFromUser;
	}

	/**
	 * Returns the number of related Transfer objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Transfer objects.
	 * @throws     PropelException
	 */
	public function countTransfersRelatedByFromUser(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTransfersRelatedByFromUser || null !== $criteria) {
			if ($this->isNew() && null === $this->collTransfersRelatedByFromUser) {
				return 0;
			} else {
				$query = TransferQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUserFrom($this)
					->count($con);
			}
		} else {
			return count($this->collTransfersRelatedByFromUser);
		}
	}

	/**
	 * Method called to associate a Transfer object to this object
	 * through the Transfer foreign key attribute.
	 *
	 * @param      Transfer $l Transfer
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTransferRelatedByFromUser(Transfer $l)
	{
		if ($this->collTransfersRelatedByFromUser === null) {
			$this->initTransfersRelatedByFromUser();
		}
		if (!$this->collTransfersRelatedByFromUser->contains($l)) { // only add it if the **same** object is not already associated
			$this->collTransfersRelatedByFromUser[]= $l;
			$l->setUserFrom($this);
		}
	}

	/**
	 * Clears out the collTransfersRelatedByToUser collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTransfersRelatedByToUser()
	 */
	public function clearTransfersRelatedByToUser()
	{
		$this->collTransfersRelatedByToUser = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTransfersRelatedByToUser collection.
	 *
	 * By default this just sets the collTransfersRelatedByToUser collection to an empty array (like clearcollTransfersRelatedByToUser());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initTransfersRelatedByToUser()
	{
		$this->collTransfersRelatedByToUser = new PropelObjectCollection();
		$this->collTransfersRelatedByToUser->setModel('Transfer');
	}

	/**
	 * Gets an array of Transfer objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Transfer[] List of Transfer objects
	 * @throws     PropelException
	 */
	public function getTransfersRelatedByToUser($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTransfersRelatedByToUser || null !== $criteria) {
			if ($this->isNew() && null === $this->collTransfersRelatedByToUser) {
				// return empty collection
				$this->initTransfersRelatedByToUser();
			} else {
				$collTransfersRelatedByToUser = TransferQuery::create(null, $criteria)
					->filterByUserTo($this)
					->find($con);
				if (null !== $criteria) {
					return $collTransfersRelatedByToUser;
				}
				$this->collTransfersRelatedByToUser = $collTransfersRelatedByToUser;
			}
		}
		return $this->collTransfersRelatedByToUser;
	}

	/**
	 * Returns the number of related Transfer objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Transfer objects.
	 * @throws     PropelException
	 */
	public function countTransfersRelatedByToUser(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTransfersRelatedByToUser || null !== $criteria) {
			if ($this->isNew() && null === $this->collTransfersRelatedByToUser) {
				return 0;
			} else {
				$query = TransferQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUserTo($this)
					->count($con);
			}
		} else {
			return count($this->collTransfersRelatedByToUser);
		}
	}

	/**
	 * Method called to associate a Transfer object to this object
	 * through the Transfer foreign key attribute.
	 *
	 * @param      Transfer $l Transfer
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTransferRelatedByToUser(Transfer $l)
	{
		if ($this->collTransfersRelatedByToUser === null) {
			$this->initTransfersRelatedByToUser();
		}
		if (!$this->collTransfersRelatedByToUser->contains($l)) { // only add it if the **same** object is not already associated
			$this->collTransfersRelatedByToUser[]= $l;
			$l->setUserTo($this);
		}
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->username = null;
		$this->pandora_username = null;
		$this->real_name = null;
		$this->email = null;
		$this->balance = null;
		$this->created = null;
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
			if ($this->singleBalanceLog) {
				$this->singleBalanceLog->clearAllReferences($deep);
			}
			if ($this->collStocks) {
				foreach ((array) $this->collStocks as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPurchases) {
				foreach ((array) $this->collPurchases as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collOptions) {
				foreach ((array) $this->collOptions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collDeposits) {
				foreach ((array) $this->collDeposits as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTransfersRelatedByFromUser) {
				foreach ((array) $this->collTransfersRelatedByFromUser as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTransfersRelatedByToUser) {
				foreach ((array) $this->collTransfersRelatedByToUser as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->singleBalanceLog = null;
		$this->collStocks = null;
		$this->collPurchases = null;
		$this->collOptions = null;
		$this->collDeposits = null;
		$this->collTransfersRelatedByFromUser = null;
		$this->collTransfersRelatedByToUser = null;
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

} // BaseUser
