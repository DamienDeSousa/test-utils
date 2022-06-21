<?php

/**
 * Defines the FixturePantherTestCase class.
 *
 * @author Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\TestUtils;

use Dades\TestFixtures\Fixture\FixtureAttachedTrait;
use Dades\TestUtils\Provider\Actions\NavigationAction;
use Dades\TestUtils\Provider\Uri\AdminUriProvider;
use Dades\TestUtils\Provider\Uri\UriProvider;
use Dades\TestUtils\Provider\Url\AdminUrlProvider;
use Symfony\Component\Panther\PantherTestCase;

/**
 * Defines setUp and tearsDown method and giving some useful methods for tests.
 */
abstract class FixturePantherTestCase extends PantherTestCase
{
    use FixtureAttachedTrait {
        FixtureAttachedTrait::setUp as setUpTrait;
    }

    use AdminUriProvider;

    use NavigationAction;

    use AdminUrlProvider;

    use UriProvider;
}
