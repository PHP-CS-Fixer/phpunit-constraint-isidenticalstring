<?php

/*
 * This file is part of PHP CS Fixer / PHPUnit Constraint IsIdenticalString.
 *
 * (c) Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer\PhpunitConstraintIsIdenticalString\Constraint;

use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * @internal
 */
final readonly class IsIdenticalStringForV11 extends Constraint
{
    private IsIdentical $isIdentical;

    public function __construct(private mixed $value)
    {
        $this->isIdentical = new IsIdentical($this->value);
    }

    public function evaluate(mixed $other, string $description = '', bool $returnResult = false): ?bool
    {
        try {
            return $this->isIdentical->evaluate($other, $description, $returnResult);
        } catch (ExpectationFailedException $exception) {
            $message = $exception->getMessage();

            $additionalFailureDescription = $this->additionalFailureDescription($other);

            if ($additionalFailureDescription) {
                $message .= "\n".$additionalFailureDescription;
            }

            throw new ExpectationFailedException(
                $message,
                $exception->getComparisonFailure(),
                $exception
            );
        }
    }

    public function toString(): string
    {
        return $this->isIdentical->toString();
    }

    protected function additionalFailureDescription(mixed $other): string
    {
        if (
            $other === $this->value
            || preg_replace('/(\r\n|\n\r|\r)/', "\n", $other) !== preg_replace('/(\r\n|\n\r|\r)/', "\n", $this->value)
        ) {
            return '';
        }

        return ' #Warning: Strings contain different line endings! Debug using remapping ["\r" => "R", "\n" => "N", "\t" => "T"]:'
            ."\n"
            .' -'.str_replace(["\r", "\n", "\t"], ['R', 'N', 'T'], $other)
            ."\n"
            .' +'.str_replace(["\r", "\n", "\t"], ['R', 'N', 'T'], $this->value);
    }
}
