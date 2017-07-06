
<?php 
/**
 * PHP Nigerian States, Capitals and L.G.As
 * 
 * Updated, Aiming towards method chaining(major)
 * 
 * @author Don Jajo <donjajo4all@gmail.com> {@link http://donjajo.com}
 * @author Michael Akanji <promatmot@gmail.com> {@link http://michaelakanji.com}
 * 
 * @version 3.0
 * 
 */

class NSL {

	public 	//$totalLGA,
			//$capital,
			$lga; //not used..

	private $nsl_data,
			$result;

	function __construct( $file_name = 'nsl_data') { // output array when set to true
		$data_file = $file_name.'.json';
		$df_content = file_get_contents($data_file);
		//check for file existense
		if (file_exists($data_file)){
			$this->nsl_data = json_decode($df_content, TRUE);
			// set the result as it is incase developer want to do manipulation them self
			$this->result = $this->nsl_data;
			return $this;
		}
		// die if no data file is pointed to
		die('NSL Data File does not exist');

	}

	/**
	 * Get the states
	 * 
	 */
	public function state() {
		$this->result = array(); // initialize to prevent interference when chaining methods
		foreach ($this->nsl_data as $key => $value) {
			$this->result[] = $key;
		}
		return $this;
	}

	/**
	 * Get the states and capital
	 * for real precision i avoid to make this method dependent of the state result
	 * 
	 */
	public function stateAndCapital() {
		foreach ($this->nsl_data as $key => $value) {
			$this->result[] = array($key => $value['capital']);
		}
		return $this;
	}

	/**
	 * Get local goverment under a state
	 * 
	 */
	public function stateLga($state) {
		$this->result = $this->nsl_data[$state]['lga'];
		return $this;
	}

	/**
	 * Get the state of a local government
	 * 
	 */
	public function lgaState($lga) {
		foreach( $this->nsl_data as $state => $s_data ) {
			if(in_array($lga, array_map('strtolower', $s_data['lga']))){ // array map to tackle any value in upper case
				$this->result = $state;
			}
		}
		return $this;
	}

	/**
	 * Get the state of a capital
	 * 
	 */
	public function capitalState($capital) {
		foreach( $this->nsl_data as $state => $s_data ) {
			if($capital == $s_data['capital']){
				$this->result = $state;
			}
		}
		return $this;
	}
	
	/**
	 * Get the capital of a state
	 * 
	 */
	public function stateCapital($state) {
		$this->result = $this->nsl_data[$state]['capital'];
		return $this;
	}
	
	/**
	 * Get the total number of a data return
	 * 
	 */
	public function countResult() {
		$this->result = count($this->result);
		return $this;
	}
	
	/**
	 * return the result
	 * 
	 */
	public function get() {
		return $this->result;
	}

	/**
	 * modifier - set return data to json obj or array , depends on the 2nd parameter when creating new nsl object
	 * Options are json or csv (only one level up associate array result can be output via the csv stdout format)
	 * 
	 */
	public function stdout($format = NULL) {
		switch ($format) {
		 	case 'json':
		 			$this->result = json_encode($this->result);
		 		break;
		 	
		 	case 'csv':
		 			$result = $this->result;
		 			$count = 0;
		 			$result_num = count($result);
 					$this->result = "";
 					// check if parameter passed is an array else gabage out as it is in
 					if (is_array($result)){
	 					foreach ($result as $part) {
		 					if(is_array($part)){
		 						foreach ($part as $key => $value) {
		 							$this->result .= $key . ',' .$value . "\n";
		 						}
		 					} else {
			 					$this->result .= $part;
			 					if($count < ($result_num-1)){
			 						$this->result .= ',';
			 					}
			 					$count += 1;
		 					}
		 				}		
 					} else {
 						// gabage out
 						$this->result = $result;
 					}			 			
		 		break;
		 	
		 	default:
					return $this;
		 		break;
		}

		return $this;
	}

}
