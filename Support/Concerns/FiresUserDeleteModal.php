<?php

namespace Maestro\Users\Support\Concerns;

trait FiresUserDeleteModal 
{
    protected string $modalEvent = 'swal:confirm';

    public function fireDeleteModal(mixed $params, string $accept, string $deny = null)
    {
        $this->dispatchBrowserEvent($this->modalEvent, [
            'accept'     => $accept,
            'deny'       => $deny,
            'params'     => $params,
            'buttons'    => true,
            'dangerMode' => true,
            'title'      => __('users::modals.delete.title'),
            'text'       => __('users::modals.delete.text'),
            'icon'       => __('users::modals.delete.icon'),
        ]);
    }
}