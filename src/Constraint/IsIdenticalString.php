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

if (version_compare(\PHPUnit\Runner\Version::id(), '7.0.0') < 0) {
    class_alias(IsIdenticalStringForV5::class, IsIdenticalString::class);
} elseif (version_compare(\PHPUnit\Runner\Version::id(), '8.0.0') < 0) {
    class_alias(IsIdenticalStringForV7::class, IsIdenticalString::class);
} elseif (version_compare(\PHPUnit\Runner\Version::id(), '9.0.0') < 0) {
    class_alias(IsIdenticalStringForV8::class, IsIdenticalString::class);
} elseif (version_compare(\PHPUnit\Runner\Version::id(), '11.0.0') < 0) {
    class_alias(IsIdenticalStringForV9::class, IsIdenticalString::class);
} else {
    class_alias(IsIdenticalStringForV11::class, IsIdenticalString::class);
}
