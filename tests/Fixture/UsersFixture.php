<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

	/**
	 * Fields
	 *
	 * @var array
	 */
	// @codingStandardsIgnoreStart
	public $fields = [
		'id'           => [
			'type'          => 'integer',
			'length'        => 10,
			'unsigned'      => true,
			'null'          => false,
			'default'       => null,
			'comment'       => '',
			'autoIncrement' => true,
			'precision'     => null
		],
		'name'         => [
			'type'      => 'string',
			'length'    => 80,
			'null'      => false,
			'default'   => null,
			'comment'   => '',
			'precision' => null,
			'fixed'     => null
		],
		'token'        => [
			'type'      => 'string',
			'length'    => 60,
			'null'      => false,
			'default'   => null,
			'comment'   => '',
			'precision' => null,
			'fixed'     => null
		],
		'created'      => [
			'type'      => 'datetime',
			'length'    => null,
			'null'      => false,
			'default'   => null,
			'comment'   => '',
			'precision' => null
		],
		'updated'      => [
			'type'      => 'datetime',
			'length'    => null,
			'null'      => false,
			'default'   => null,
			'comment'   => '',
			'precision' => null
		],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
		],
		'_options'     => [
			'engine'    => 'InnoDB',
			'collation' => 'utf8_general_ci'
		],
	];
	// @codingStandardsIgnoreEnd

	/**
	 * Records
	 *
	 * @var array
	 */
	public $records = [
		[
			'id'      => 1,
			'name'    => 'Lorem ipsum dolor sit amet',
			'token'   => 'Lorem ipsum dolor sit amet',
			'created' => '2015-04-10 01:43:44',
			'updated' => '2015-04-10 01:43:44'
		],
	];
}
