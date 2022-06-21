<?php

/**
 * File that defines the PageTemplateProvider trait.
 *
 * @author    Damien DE SOUSA
 * @copyright 2021 Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\TestUtils\Provider\Data;

use Dades\CmsBundle\Entity\PageTemplate;

/**
 * This trait is used to provide page template entity for tests.
 */
trait PageTemplateProvider
{
    public function providePageTemplate(): PageTemplate
    {
        $pageTemplate = new PageTemplate();
        $pageTemplate->setLayout('relative/path/to/layout/file.html.twig');
        $pageTemplate->setName('Test Page Template');

        return $pageTemplate;
    }
}
