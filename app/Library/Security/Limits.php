<?php
namespace Lib\Security;

class Limits
{
    const ILYA_LIMIT_QUESTIONS = 'Q';
    const ILYA_LIMIT_ANSWERS = 'A';
    const ILYA_LIMIT_COMMENTS = 'C';
    const ILYA_LIMIT_VOTES = 'V';
    const ILYA_LIMIT_REGISTRATIONS = 'R';
    const ILYA_LIMIT_LOGINS = 'L';
    const ILYA_LIMIT_UPLOADS = 'U';
    const ILYA_LIMIT_FLAGS = 'F';
    const ILYA_LIMIT_MESSAGES = 'M'; // i.e. private messages
    const ILYA_LIMIT_WALL_POSTS = 'W';

    /**
     * How many more times the logged in user (and requesting IP address) can perform an action this hour.
     * @param string $action One of the ILYA_LIMIT_* constants defined above.
     * @return int
     */
    public static function userLimitsRemaining($action)
    {
        return 1;
    }

    /**
     * Take note for rate limits that a user and/or the requesting IP just performed an action.
     * @param int $userId User performing the action.
     * @param string $action One of the ILYA_LIMIT_* constants defined above.
     * @return mixed
     */
    public static function limitsIncrement($userId, $action)
    {
    }
}