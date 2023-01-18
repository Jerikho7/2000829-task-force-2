<?php

namespace TaskForce\classes\Task\Actions;

use TaskForce\classes\Task;

class ActionDone extends AbstractAction
{
    public function getNameAction(): string
    {
        return 'Выполнено';
    }

    public function getSystemNameAction(): string
    {
        return 'done';
    }

    public function checkIdStatus($current_id, $current_status): bool
    {
        if ($current_id === $this->customer_id && $current_status === Task::STATUS_WORK) {
            return true;
        }
        return false;
    }
}
