<?php

namespace Maestro\Users\Exceptions;

use Maestro\Admin\Exceptions\BaseException;

class UserNotFoundException extends BaseException
{
    const CODE = '0102';

    /**
     * Define as configuração para enviar o exception
     *
     * @param string $name
     */
    public function __construct($id)
    {
        $this->initialize($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorMessage(): string
    {
        return "Not possible to found user by id = %s.";
    }

    /**
     * {@inheritDoc}
     */
    public function getErrorCode(): string
    {
        return self::CODE;
    }
}
