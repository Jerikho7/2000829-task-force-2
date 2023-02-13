<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use TaskForce\classes\Task\Task;

require_once 'vendor/autoload.php';

$task = new Task(1, 'new');

assert($task->getNewStatus(Task::ACTION_CANCEL) === Task::STATUS_CANCEL, 'cancel');
assert($task->getNewStatus(Task::ACTION_RESPOND) === Task::STATUS_NEW, 'waiting');
assert($task->getNewStatus(Task::ACTION_START) === Task::STATUS_WORK, 'at_work');
assert($task->getNewStatus(Task::ACTION_DONE) === Task::STATUS_DONE, 'done');
assert($task->getNewStatus(Task::ACTION_DENY) === Task::STATUS_FAIL, 'failed');

assert(in_array(Task::ACTION_CANCEL, $task->getAvailableActions(1, Task::STATUS_NEW)), 'cancel');
assert(in_array(Task::ACTION_RESPOND, $task->getAvailableActions(2, Task::STATUS_NEW)), 'respond');
assert(in_array(Task::ACTION_START, $task->getAvailableActions(1, Task::STATUS_NEW)), 'accept');
assert(in_array(Task::ACTION_DONE, $task->getAvailableActions(1, Task::STATUS_WORK)), 'done');
assert(in_array(Task::ACTION_DENY, $task->getAvailableActions(2, Task::STATUS_WORK)), 'failed');

$mapStatus = $task->getMapStatus();
$mapAction = $task->getMapAction();

echo "End.";
