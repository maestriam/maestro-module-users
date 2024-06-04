<?php

namespace Maestro\Users\Exceptions;

use Maestro\Admin\Exceptions\BaseException;

class InvalidExcludedUserException extends BaseException
{
    const CODE = 'USR-EXC-02';

    /**
     * Define as configuração para enviar o exception
     *
     * @param string $name
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return "The excluded users passed in user select is invalid. Please, check the params informed and try again.";
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode(): string
    {
        return self::CODE;
    }
}