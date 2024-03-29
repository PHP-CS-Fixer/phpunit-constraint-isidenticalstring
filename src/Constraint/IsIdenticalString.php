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

use PHPUnit\Runner\Version;

if (version_compare(Version::id(), '7.0.0') < 0) {
    class_alias(IsIdenticalStringForV5::class, IsIdenticalString::class);
} elseif (version_compare(Version::id(), '8.0.0') < 0) {
    class_alias(IsIdenticalStringForV7::class, IsIdenticalString::class);
} elseif (version_compare(Version::id(), '9.0.0') < 0) {
    class_alias(IsIdenticalStringForV8::class, IsIdenticalString::class);
} else {
    class_alias(IsIdenticalStringForV9::class, IsIdenticalString::class);
}
