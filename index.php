<?php
require_once 'classes/Task.php';

$task = new Task(1, 2, 'new');

assert($task->getNewStatus(Task::ACTION_CANCEL) === Task::STATUS_CANCEL, 'cancel');
assert($task->getNewStatus(Task::ACTION_RESPOND) === Task::STATUS_WORK, 'at_work');
assert($task->getNewStatus(Task::ACTION_DONE) === Task::STATUS_DONE, 'done');
assert($task->getNewStatus(Task::ACTION_DENY) === Task::STATUS_FAIL, 'failed');

assert($task->getAvailableAction(1, Task::STATUS_NEW) === Task::ACTION_CANCEL, 'cancel');
assert($task->getAvailableAction(2, Task::STATUS_NEW) === Task::ACTION_RESPOND, 'respond');

assert($task->getAvailableAction(1, Task::STATUS_WORK) === Task::ACTION_DONE, 'done');
assert($task->getAvailableAction(2, Task::STATUS_WORK) === Task::ACTION_DENY, 'failed');

//assert($task->getAvailableAction(3, Task::STATUS_NEW) === Task::ACTION_CANCEL, 'cancel');
//assert($task->getAvailableAction(3, Task::STATUS_NEW) === Task::ACTION_RESPOND, 'respond');

$mapStatus = $task->getMapStatus();
$mapAction = $task->getMapAction();
