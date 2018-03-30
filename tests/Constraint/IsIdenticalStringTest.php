<?php

/*
 * This file is part of PHP CS Fixer / PHPUnit Constraint IsIdenticalString.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer\PhpunitConstraintIsIdenticalString\Tests\Constraint;

use PhpCsFixer\PhpunitConstraintIsIdenticalString\Constraint\IsIdenticalString;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \PhpCsFixer\PhpunitConstraintIsIdenticalString\Constraint\IsIdenticalString
 */
final class IsIdenticalStringTest extends TestCase
{
    public function testSameStringsConstraintFail()
    {
        $this->expectException(
            'PHPUnit\Framework\ExpectationFailedException'
        );
        $this->expectExceptionMessageRegExp(
            '#^Failed asserting that two strings are identical\.[\n] \#Warning\: Strings contain different line endings\! Debug using remapping \["\\\\r" => "R", "\\\\n" => "N", "\\\\t" => "T"\]\:\n \-N\n \+RN$#'
        );

        $constraint = new IsIdenticalString("\r\n");
        $constraint->evaluate("\n");
    }
}
