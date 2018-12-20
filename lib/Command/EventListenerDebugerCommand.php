<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Command;

use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\BundleInfo;
use DawBed\ComponentBundle\Model\EventListenerDebuger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventListenerDebugerCommand extends Command
{
    const NAME = 'dawbed-component:debug:event-listener';

    private $debugCommands;
    private $bundleClasses;
    private $eventDispatcher;

    public function __construct(
        $name = null,
        array $debugCommands,
        array $bundleClasses,
        EventDispatcherInterface $eventDispatcher
    )
    {
        parent::__construct($name);
        $this->debugCommands = $debugCommands;
        $this->bundleClasses = $bundleClasses;
        $this->eventDispatcher = $eventDispatcher;
    }

    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Check if you have all registered listeners');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->bundleClasses as $bundleClass) {
            (new EventListenerDebuger($this->eventDispatcher, new BundleInfo($bundleClass)))
                ->execute($input, $output);
        }
        foreach ($this->debugCommands as $name) {

            $command = $this->getApplication()->find($name);

            $greetInput = new ArrayInput([
                'command' => $name,
            ]);
            $command->run($greetInput, $output);
        }
    }
}