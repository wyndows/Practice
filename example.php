<?php


/**
 * Very Small Cross Section of a Store's Information
 *
 * This can be considered a small example of what information is utilized from a Store Entity.
 *
 * @author Marlan Ball <mball15@cnm.edu>
 * @version 1.0.0
 */
class Store implements \JsonSerializable {

	/**
	 * the address of the store
	 * @var string $storeAddress
	 */
	private $storeAddress;

	/**
	 * constructor for this store
	 *
	 * @param string $newStoreAddress string containing address of the store
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g. strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(string $newStoreAddress) {
		try {
			$this->setStoreAddress($newStoreAddress);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for store address
	 *
	 * @return string value of store address
	 */
	public function getStoreAddress() {
		return($this->storeAddress);
	}

	/**
	 * mutator method for store address
	 *
	 * @param string $newStoreAddress new value of store address
	 * @throws \InvalidArgumentException if $newStoreAddress is not a string or insecure
	 * @throws \RangeException if $newStoreAddress is > 100 characters
	 * @throws \TypeError if $newStoreAddress is not a string
	 */
	public function setStoreAddress(string $newStoreAddress) {
		// verify the store address is secure
		$newStoreAddress = trim($newStoreAddress);
		$newStoreAddress = filter_var($newStoreAddress, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newStoreAddress) === true) {
			throw(new \InvalidArgumentException("store address is empty or insecure"));
		}

		// verify the store address will fit in the database
		if(strlen($newStoreAddress) > 100) {
			throw(new \RangeException("store address is too long"));
		}

		// store the store address
		$this->storeAddress = $newStoreAddress;
	}


	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}

}

// this section acts like a user creating a new store
//$userInput is acting like the user
//$userInput becomes the 'caller' and 'calls' the 'class' Store into existence
//the constructor method in the 'class' is run because the class was called
//therefore the value of "123WestRoad" is sent to the 2 methods get and set
//these methods check to see if the data the user put in, namely "123WestRoad" is valid

$userInput = new Store("123WestRoad");

//this next line asks the system to tell me what the variables called into existence now hold

var_dump($userInput);

//so basically, the code "class Store implements \JsonSerializable {" starts creating a blueprint for a store
//and we want to make sure that when we build the store the 'materials' we use are safe so we code the get and set section
//then as an example we use the blueprint and build a store address with the 'materials' 123WestRoad.
?>