<?php

namespace TaskForce\classes\Task\Actions;

use TaskForce\classes\Task\Task;

abstract class AbstractAction
{
    protected $nameAction;
    protected $systemNameAction;

    public function getNameAction(): string
    {
        return $this->nameAction;
    }

    public function getSystemNameAction(): string
    {
        return $this->systemNameAction;
    }

    abstract protected function checkIdStatus($current_id, $current_status): bool;
}
