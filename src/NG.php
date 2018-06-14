<?php 
declare( strict_types=1 );
namespace Jajo;

class NG {
	private $data;
	public $states;

	public function __construct() 
	{
		$this->load();
	}

	private function load() : self 
	{
		$this->data = file_get_contents( __DIR__ . '/../data/states.json' );
		if( $this->data ) {
			$this->data = json_decode( $this->data );
			$this->states = array_keys( ( array ) $this->data );
		}
		return $this;
	}

	public function getLGA( string $state ) : array 
	{
		$state = ucwords( $state );
		if( !empty( $this->data->{ $state } ) ) {
			return $this->data->{ $state }->lga;
		}
		return [];
	}

	public function getCapital( string $state ) : string 
	{
		$state = ucwords( $state );
		if( !empty( $this->data->{ $state } ) ) {
			return $this->data->{ $state }->capital;
		}
		return '';
	}

	public function getStateBy( string $by, string $value ) : string 
	{
		$value = strtolower( $value );

		$state = array_filter( ( array ) $this->data, function( $content ) use ( $by, $value ) {
			if( strtolower( $by ) == 'capital' ) 
				return strtolower( $content->capital ) == $value;
			return in_array( $value, array_map( 'strtolower', $content->lga ) );
		});

		return !empty( $state ) ? key( $state ) : '';
	}
}