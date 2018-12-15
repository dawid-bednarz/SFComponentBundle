<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\ComponentBundle\Model;

use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\Bundle;
use DawBed\ComponentBundle\DependencyInjection\ChildrenBundle\BundleInfo;
use DawBed\ComponentBundle\Event\AbstractEvents;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventListenerDebuger
{
    const REQUIRED_NOTICE = '"%s" is not registered and is required !';
    const OPTIONAL_NOTICE = '"%s" is not registered, but is not required';

    private $eventDispatcher;
    private $notRegisteredEventCount = 0;
    private $bundleInfo;

    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        BundleInfo $bundleInfo
    )
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->bundleInfo = $bundleInfo;
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);
        $this->checkRegistrationListener($io);
        if (!$this->notRegisteredEventCount) {
            $io->success($this->bundleInfo->getAlias());
        }
    }

    protected function checkRegistrationListener($io): void
    {
        $eventsClass = $this->bundleInfo->getEvents();
        $events = new $eventsClass;
        foreach ($events as $name => $necessaryLevel) {
            if (!$this->eventDispatcher->hasListeners($name)) {
                if ($necessaryLevel !== AbstractEvents::REQUIRED) {
                    $io->note(sprintf(self::OPTIONAL_NOTICE, $name));
                } else {
                    $io->error(sprintf(self::REQUIRED_NOTICE, $name));
                    $this->notRegisteredEventCount++;
                }
            }
        }
    }
}