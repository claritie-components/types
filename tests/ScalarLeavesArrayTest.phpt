<?php

declare(strict_types = 1);

namespace SmartEmailing\Types;

use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/bootstrap.php';

final class ScalarLeavesArrayTest extends TestCase
{

	public function testIsScalarLeavesArray(): void
	{
		$scalarArray = ScalarLeavesArray::from([]);
		Assert::type(ScalarLeavesArray::class, $scalarArray);

		$input = [
			[
				'a',
			],
			[
				1,
			],
			[
				'b',
				[
					true,
					[
						null,
					],
					[],
				],
			],
		];

		$scalarArray = ScalarLeavesArray::from($input);
		Assert::type(ScalarLeavesArray::class, $scalarArray);

		Assert::throws(
			static function (): void {
				ScalarLeavesArray::from([new \StdClass()]);
			},
			InvalidTypeException::class
		);

		Assert::throws(
			static function (): void {
				ScalarLeavesArray::from([\tmpfile()]);
			},
			InvalidTypeException::class
		);
	}

}

(new ScalarLeavesArrayTest())->run();
