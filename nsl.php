<?php 
/**
 * PHP Nigerian States, Capitals and L.G.As
 * @author Don Jajo <donjajo4all@gmail.com> {@link http://donjajo.com}
 * @version 1.0
*/

require( 'data.php' );

define( 'PHP_ARRAY', 'PHP_ARRAY' );
define( 'JSON', 'JSON' );

class NGStatesLGA {

	public $totalLGA;
	public $capital;

	function __construct( $format = PHP_ARRAY ) {
		global $states;

		$this->states = $states;
		$this->format = $format;
	}

	public function getLGA( $state ) {
		if( isset( $this->states[ $state ] ) ) {
			$this->totalLGA = count( $this->states[ $state ][ 'lga' ] );
			$this->capital = $this->states[ $state ][ 'capital' ];
			return $this->processReturn( $this->states[ $state ] );
		}
		else
			return false;
	}

	private function processReturn( $data ) {
		if( $this->format == PHP_ARRAY ) {
			return $data;
		}
		elseif( $this->format == JSON ) {
			return json_encode( $data );
		}
		else {
			return $data;
		}
	}

	public function getLGAState( $user_lga ) {
		foreach( $this->states as $state => $data ) {
			foreach( $data as $lga ) {
				if( is_array( $lga ) ) {
					foreach( $lga as $per_lga ) {
						if( strtolower( $per_lga ) == strtolower( $user_lga ) ) {
							return $this->processReturn( $state ); break;
						}
					}
				}
			}
		}
	}

	public function getCapitalState( $capital ) {
		foreach( $this->states as $state => $data ) {
			foreach( $data as $key => $value ) {
				if( $key == 'capital' && strtolower( $value ) == strtolower( $capital ) ) {
					return $this->processReturn( $state ); 
					break;
				}
			}
		}
	}
}
