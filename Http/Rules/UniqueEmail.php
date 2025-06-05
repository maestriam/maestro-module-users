<?php

namespace Maestro\Users\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Maestro\Users\Support\Concerns\SearchesUsers;

class UniqueEmail implements ValidationRule, DataAwareRule
{
    use SearchesUsers;

    /**
     * Todos os dados vindo da requisção
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Define os dados que são passados na requisição. 
     *
     * @param array $data
     * @return static
     */
    public function setData(array $data) : static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Executa a validação de e-mail já cadastrado na base de dados.  
     * Caso já esteja cadastrado, deve executar um retorno de falha
     * na verificação.  
     *
     * @param string $attr
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attr, mixed $value, Closure $fail) : void
    {
        $checked = $this->check($value);

        if ($checked == false) {
            $fail('users::validations.email.unique')->translate();
        }
    }

    /**
     * Verifica se o e-mail enviado já foi cadastrado na base do sistema.
     * Se a operação trata-se de um novo cadastro, verifica se já existe
     * o e-mail na base. Se houver, deve 
     *
     * @param string $email
     * @return boolean
     */
    public function check(string $email) : bool
    {
        $entity = $this->data['entity'] ?? null;
        $exists = $this->finder()->exists($email);

        if ($entity == null) {
            return ($exists == true) ? false : true;
        }

        $belongs = $this->finder()->belongsTo($email, $entity->id);

        return ($exists == false || $belongs == true) ? true : false;
    }
}