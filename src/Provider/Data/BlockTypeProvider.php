<?php

/**
 * File that defines the BlockTypeProvider trait.
 *
 * @author Damien DE SOUSA
 * @copyright 2021
 */

declare(strict_types=1);

namespace Dades\TestUtils\Provider\Data;

use Dades\CmsBundle\Entity\BlockType;

/**
 * Trait used to provide block type entity for test.
 */
trait BlockTypeProvider
{
    public function provideBlockType(): BlockType
    {
        $blockType = new BlockType();
        $blockType->setType('header');
        $blockType->setLayout('path/to/layout/header.html.twig');
        $blockType->setFormType('file-to-replace-by-real-form-types.php');

        return $blockType;
    }
}
