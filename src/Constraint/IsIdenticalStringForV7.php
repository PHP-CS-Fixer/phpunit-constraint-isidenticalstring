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

use PHPUnit\Framework\Constraint\IsIdentical;

/**
 * @author Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * @internal
 */
final class IsIdenticalStringForV7 extends IsIdentical
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        parent::__construct($value);

        $this->value = $value;
    }

    protected function additionalFailureDescription($other): string
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
