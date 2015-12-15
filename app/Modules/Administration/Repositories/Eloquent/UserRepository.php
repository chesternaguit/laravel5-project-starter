<?php 

namespace App\Modules\Administration\Repositories\Eloquent;

use App\GenericRepositories\src\Eloquent\AbstractRepository;

use App\Modules\Administration\Models\User;
use App\Modules\Administration\Repositories\Interfaces\UserRepositoryInterface;
use App\Modules\Administration\Services\Forms\UserForm;
use App\Modules\Administration\Services\Forms\UserEditForm;
// use Administration\Services\Forms\UserGroupForm;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {

    /**
     * Create a new DbUserRepository instance.
     *
     * @return \Sentry\Models\User
     * @return void
     */
    public function __construct(User $user)
    {
        $this->model  = $user;
    }

    /**
     * Find a user by it's username.
     *
     * @param  string $username
     * @return \Sentry\Models\User
     */
    public function findByUsername($username)
    {
        return $this->model->whereUsername($username)->first();
    }

    /**
     * Find a user by it's email.
     *
     * @param  string $email
     * @return \Sentry\Models\User
     */
    public function findByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
    }

    /**
     * Get the the datatable for the users
     * @return \Illuminate\Database
     */
    public function getDataTable()
    {
        return $this->model;
    }

    /**
     * Get the form editor from services
     *
     * @return \Services\Forms\UserEditForm | \Services\Forms\UserForm
     */
    public function getEditForm($id = null)
    {
        return (!$id) ? new UserForm() : new UserEditForm($id);
    }

    /**
     * Get the form editor for usergroups
     */
    public function getUserGroupForm($id)
    {
        return new UserGroupForm($id);
    }

    /**
     * Updates user information
     * @param  array  $data
     * @return
     */
    public function updateUserInfo(array $data, $id)
    {
        try
        {
            $user = \Sentinel::findUserById($id);

            $user->email        = $data['email'];
            $user->last_name         = $data['last_name'];
            $user->first_name         = $data['first_name'];

            if($data['password'])
            {
                $user->password     = $data['password'];
            }

            // if($data['image'])
            // {
            //     $file      = $data['image'];
            //     $filename  = str_random(30);
            //     $filename .= "." . $file->getClientOriginalExtension();
            //     $file->move('public/img', $filename);

            //     $user->image = $filename;
            // }

            $user->save();

            return $user;
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return 'User with that login already exists';
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return 'User was not found';
        }
    }

    /**
     * Create user information
     * @param  array  $data
     * @return
     */
    public function createUser(array $data)
    {
        try
        {
            // Create the user
            $user = \Sentinel::register([
                'email'          => $data['email'],
                'last_name'           => $data['last_name'],
                'first_name'       => $data['first_name'],
                'password'       => bcrypt($data['password'])
            ]);

            // if(isset($data['image']))
            // {
            //     $file      = $data['image'];
            //     $filename  = str_random(30);
            //     $filename .= "." . $file->getClientOriginalExtension();
            //     $file->move('public/img', $filename);
            // }
            return $user;
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            echo 'User with this login already exists.';
        }
    }

    /**
     * Get an array of key-value (id => name) pairs of all tags.
     *
     * @return array
     */
    public function listAll()
    {
        return $this->model->lists('display_name', 'id');
    }
}
