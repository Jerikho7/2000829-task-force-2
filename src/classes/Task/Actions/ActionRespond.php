<?php

namespace TaskForce\classes\Task\Actions;

use TaskForce\classes\Task;

class ActionRespond extends AbstractAction
{
    public function getNameAction(): string
    {
        return 'Откликнуться';
    }

    public function getSystemNameAction(): string
    {
        return 'respond';
    }

    public function checkIdStatus($current_id, $current_status): bool
    {
        if ($current_id === $this->implementer_id && $current_status === Task::STATUS_NEW) {
            return true;
        }
        return false;
    }
}
