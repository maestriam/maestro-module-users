<?php

return [
    'firstName' => [
        'required' => 'O campo "primeiro nome" é obrigatório.'
    ],
    'lastName' => [
        'required' => 'O campo "último nome" é obrigatório.'
    ],
    'username' => [
        'required' => 'O campo "username" é obrigatório.',
        'unique'   => 'A conta enviada já está em utilização.',
    ],
    'email' => [
        'required' => 'O campo "e-mail" é obrigatório.'
    ],
    'password' => [
        'required'  => 'O campo "senha" é obrigatório.',
        'confirmed' => 'O campo "senha" e "confirmar senha" devem ser iguais.',
    ],
];