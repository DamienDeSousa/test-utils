<?php

declare(strict_types=1);

namespace Dades\TestUtils\Runner;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

trait RunCommandTrait
{
    public function runCommand(Application $application, array $commandParameters = []): string
    {
        $input = new ArrayInput($commandParameters);
        $output = new BufferedOutput();
        $application->run($input, $output);

        return $output->fetch();
    }
}
