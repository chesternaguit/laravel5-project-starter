<?php 

namespace App\Modules\Administration\Repositories\Interfaces;

interface UserRepositoryInterface {

    /**
     * Find a user by it's username.
     * @param  string $username
     * @return \Sentry\Models\User
     */
    public function findByUsername($username);

    /**
     * Find a user by it's email.
     * @param  string $email
     * @return \Sentry\Models\User
     */
    public function findByEmail($email);

    /**
     * Get the the datatable for the users
     * @return \Illuminate\Database
     */
    public function getDataTable();

    /**
     * Get the form editor from services
     *
     * @return \Sentinel\Services\Forms\UserEditForm | \Sentinel\Services\Forms\UserForm
     */
    public function getEditForm($id = null);

    /**
     * Get the form editor for usergroups
     */
    public function getUserGroupForm($id);

    /**
     * Updates user information
     * @param  array  $data
     * @return
     */
    public function updateUserInfo(array $data, $id);

    /**
     * Create user information
     * @param  array  $data
     * @return
     */
    public function createUser(array $data);
}
