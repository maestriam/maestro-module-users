<?php

return [
    'firstName' => [
        'required' => 'O campo "primeiro nome" é obrigatório.'
    ],
    'lastName' => [
        'required' => 'O campo "último nome" é obrigatório.'
    ],
    'accountName' => [
        'required' => 'O campo "username" é obrigatório.',
        'unique'   => 'A conta enviada já está em utilização.',
    ],
    'email' => [
        'email'    => 'E-mail informado possui um formato inválido',
        'required' => 'O campo "e-mail" é obrigatório.'
    ],
    'password' => [
        'required'  => 'O campo "senha" é obrigatório.',
        'confirmed' => 'O campo "senha" e "confirmar senha" devem ser iguais.',
    ],
];