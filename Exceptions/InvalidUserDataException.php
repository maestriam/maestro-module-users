<?php

namespace Maestro\Users\Exceptions;

class InvalidUserDataException extends BaseException
{
    const CODE = '0101';

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
        return 'The request provided is invalid. Check the data passed.';
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode(): string
    {
        return self::CODE;
    }
}
