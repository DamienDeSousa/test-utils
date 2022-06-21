<?php

/**
 * File that defines the PageTemplateBlockTypeProvider class.
 *
 * @author    Damien DE SOUSA
 * @copyright 2022
 */

declare(strict_types=1);

namespace Dades\TestUtils\Provider\Data;

use Dades\CmsBundle\Entity\PageTemplateBlockType;

/**
 * Trait is used to provide page template block type entity for tests.
 */
trait PageTemplateBlockTypeProvider
{
    public function providePageTemplateBlockType(): PageTemplateBlockType
    {
        $pageTemplateBlockType = new PageTemplateBlockType();
        $pageTemplateBlockType->setSlug('my_slug');

        return $pageTemplateBlockType;
    }
}
