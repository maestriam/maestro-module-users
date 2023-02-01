<?php

namespace Maestro\Users\Exceptions;

class SessionUserNotFoundException extends BaseException
{
    const CODE = '0103';

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
        return "Not found any user logged in session.";
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode(): string
    {
        return self::CODE;
    }
}
