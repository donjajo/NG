<?php 
declare( strict_types = 1 );
use PHPUnit\Framework\TestCase;
use Jajo\NG;

class NGTest extends TestCase {
	public function testGetStates() : void {
		$ng = new NG();
		$total = count( $ng->states );
		printf( "\nTotal States and Capital: %d", $total );

		$this->assertTrue( $total == 37 );
	}

	public function testGetLGA() : void {
		$ng = new NG();
		$states = [ 'Abia', 'Lagos', 'Zamfara', 'Kano', 'Anambra', 'Imo', 'Benue', 'Cross River', 'Rivers', 'Akwa Ibom', 'Bauchi', 'Edo' ];
		$selected = $states[ array_rand( $states ) ];
		$lgas = $ng->getLGA( $selected );
		printf( "\nTotal LGA in %s: %d", $selected, count( $lgas ) );
		$this->assertNotEmpty( $lgas );
	}

	public function testGetCapital() : void {
		$ng = new NG();
		$states = [ 'Abia', 'Lagos', 'Zamfara', 'Kano', 'Anambra', 'Imo', 'Benue', 'Cross River', 'Rivers', 'Akwa Ibom', 'Bauchi', 'Edo' ];
		$selected = $states[ array_rand( $states ) ];
		$capital = $ng->getCapital( $selected );
		printf( "\nCapital of %s is %s", $selected, $capital );
		$this->assertTrue( $capital !== '' );
	}

	public function testGetStateByCapital() : void {
		$ng = new NG();
		$state = $ng->getStateBy( 'capital', 'port harcourt' );
		printf( "\nState of Port Harcourt is Rivers" );
		$this->assertEquals( 'Rivers', $state );
	}

	public function testGetStateByLGA() : void {
		$ng = new NG();
		$state = $ng->getStateBy( 'lga', 'Ohafia' );
		printf( "\nOhafia LGA is in Abia" );
		$this->assertEquals( 'Abia', $state );
	}
}