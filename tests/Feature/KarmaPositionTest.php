<?php
namespace Tests\Feature;

use Tests\TestCase;

class KarmaPositionTest extends TestCase
{
	/**
	 * A basic feature test example.
	 */
	public function test_the_api_returns_a_successful_response()
	{
		$response = $this->get('/api/v1/user/30471/karma-position?count=9');

		$response->assertStatus(200);
	}
}
