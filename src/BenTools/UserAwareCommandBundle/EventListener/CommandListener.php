<?php

namespace BenTools\UserAwareCommandBundle\EventListener;

use BenTools\UserAwareCommandBundle\Model\UserAwareInterface;
use Gedmo\Blameable\BlameableListener;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CommandListener implements EventSubscriberInterface {

    /**
     * @var BlameableListener
     */
    private $blameableListener;

    /**
     * @var string
     */
    private $userValue = '';

    /**
     * @var string
     */
    private $optionName = 'user';

    /**
     * @var string|null
     */
    private $optionShortcut;

    /**
     * CommandListener constructor.
     * @param BlameableListener $blameableListener
     */
    public function __construct(BlameableListener $blameableListener) {
        $this->blameableListener = $blameableListener;
    }

    public function onCommandInit(ConsoleCommandEvent $event) {
        if ($event->getCommand() instanceof UserAwareInterface) {
            $event->getCommand()->addOption($this->getOptionName(), $this->getOptionShortcut(), InputOption::VALUE_REQUIRED, 'Sets the user of this command.', $this->getUserValue());
            $event->getCommand()->mergeApplicationDefinition();
            $input = $event->getInput();
            $input->bind($event->getCommand()->getDefinition());
            $this->blameableListener->setUserValue($input->getOption($this->getOptionName()));
        }
    }

    /**
     * @return string
     */
    public function getUserValue() {
        return $this->userValue;
    }

    /**
     * @param string $userValue
     * @return $this - Provides Fluent Interface
     */
    public function setUserValue($userValue) {
        $this->userValue = $userValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getOptionName() {
        return $this->optionName;
    }

    /**
     * @param string $optionName
     * @return $this - Provides Fluent Interface
     */
    public function setOptionName($optionName) {
        $this->optionName = $optionName;
        return $this;
    }

    /**
     * @return string
     */
    public function getOptionShortcut() {
        return $this->optionShortcut;
    }

    /**
     * @param string $optionShortcut
     * @return $this - Provides Fluent Interface
     */
    public function setOptionShortcut($optionShortcut) {
        $this->optionShortcut = $optionShortcut;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents() {
        return [
            ConsoleEvents::COMMAND => 'onCommandInit',
        ];
    }

}