<?php

namespace TaskForce\classes\Task\Actions;

use TaskForce\classes\Task;

class ActionCancel extends AbstractAction
{
    public function getNameAction(): string
    {
        return 'Отменить';
    }

    public function getSystemNameAction(): string
    {
        return 'cancel';
    }

    public function checkIdStatus($current_id, $current_status): bool
    {
        if ($current_id === $this->customer_id && $current_status === Task::STATUS_NEW) {
            return true;
        }
        return false;
    }
}
