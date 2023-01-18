<?php

namespace TaskForce\classes\Task\Actions;

use TaskForce\classes\Task;

class ActionDeny extends AbstractAction
{
    public function getNameAction(): string
    {
        return 'Отказаться';
    }

    public function getSystemNameAction(): string
    {
        return 'deny';
    }

    public function checkIdStatus($current_id, $current_status): bool
    {
        if ($current_id === $this->implementer_id && $current_status === Task::STATUS_WORK) {
            return true;
        }
        return false;
    }
}
