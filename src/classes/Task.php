<?php

namespace TaskForce\classes;

class Task
{
    public const STATUS_NEW = 'new';
    public const STATUS_CANCEL = 'cancelled';
    public const STATUS_WAIT = 'waiting';
    public const STATUS_WORK = 'at_work';
    public const STATUS_DONE = 'done';
    public const STATUS_FAIL = 'failed';

    public const ACTION_CANCEL = 'cancel';
    public const ACTION_RESPOND = 'respond';
    public const ACTION_ACCEPT = 'accept';
    public const ACTION_DONE = 'done';
    public const ACTION_DENY = 'deny';

    private $customer_id;
    private $implementer_id;
    private $status;

    public function __construct($current_id, $status)
    {
        $this->current_id = $current_id;
        $this->status = $status;
    }

    public function getMapStatus(): array
    {
        return [
            self::STATUS_NEW => 'Новое',
            self::STATUS_CANCEL => 'Отменено',
            self::STATUS_WAIT => 'В ожидании',
            self::STATUS_WORK => 'В работе',
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_FAIL => 'Провалено'
        ];
    }

    public function getMapAction(): array
    {
        return [
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_ACCEPT => 'Принять',
            self::ACTION_DONE => 'Выполнено',
            self::ACTION_DENY => 'Отказаться'
        ];
    }

    public function getAvailableActions($current_id, $status): string
    {
        if ($current_id === $this->customer_id) {
            $availableAction = [
                self::STATUS_NEW => self::ACTION_CANCEL,
                self::STATUS_WAIT => self::ACTION_ACCEPT,
                self::STATUS_WORK => self::ACTION_DONE
            ];
            return $availableAction[$this->status];
        }
        if ($current_id === $this->implementer_id) {
            $availableAction = [
                self::STATUS_NEW => self::ACTION_RESPOND,
                self::STATUS_WORK => self::ACTION_DENY
            ];
            return $availableAction[$this->status];
        }
        return 'Пользователь не найден!';
    }

    public function getNewStatus ($action): string
    {
        $newStatus = [
            self::ACTION_CANCEL => self::STATUS_CANCEL,
            self::ACTION_RESPOND => self::STATUS_WAIT,
            self::ACTION_ACCEPT => self::STATUS_WORK,
            self::ACTION_DONE => self::STATUS_DONE,
            self::ACTION_DENY => self::STATUS_FAIL
        ];
        return $newStatus[$action];
    }
}
