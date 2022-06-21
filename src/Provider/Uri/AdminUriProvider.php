<?php

/**
 * File that defines the Admin uri provider trait.
 * This trait provides admin uri for tests.
 *
 * @author    Damien DE SOUSA <desousadamien30@gmail.com>
 * @copyright 2021 Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\TestUtils\Provider\Uri;

use Dades\EasyAdminExtensionBundle\Controller\Admin\Index;
use Dades\FosUserExtensionBundle\Controller\Admin\Security\Login;

/**
 * Trait that provides uri for tests.
 */
trait AdminUriProvider
{
    public function provideAdminLoginUri(): string
    {
        return Login::LOGIN_PAGE_URI;
    }

    public function provideAdminHomePageUri(): string
    {
        return Index::ADMIN_HOME_PAGE_URI;
    }
}
