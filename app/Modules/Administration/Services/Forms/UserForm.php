<?php 

namespace App\Modules\Administration\Services\Forms;

class UserForm extends AbstractForm {

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        //'username'      => 'required|min:6',
        'email'             => 'required|email',
        'first_name'        => 'required',
        'last_name'         => 'required',
        'password'          => 'required|min:6|confirmed'
    ];

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            //'username',
            'email',
            'first_name',
            'last_name',
            'password',
            'password_confirmation',
        ]);
    }

}
