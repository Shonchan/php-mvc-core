<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.12.2020
 * Time: 10:33
 */

namespace App;


class Session
{
    protected const FLASH_KEY = 'flash_messages';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
        $flash_messages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flash_messages as $key => &$flash_message) {
            $flash_message['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flash_messages;
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }


    public function setFlash($key, $message): void
    {
       $_SESSION[self::FLASH_KEY][$key] = [
           'remove' => false,
           'value' => $message,
       ];
    }

    public function __destruct()
    {
        $flash_messages = $_SESSION[self::FLASH_KEY];
        foreach ($flash_messages as $key => &$flash_message) {
            if ($flash_message['remove']) {
                unset($flash_messages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $flash_messages;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

}