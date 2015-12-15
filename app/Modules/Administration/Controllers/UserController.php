<?php

namespace App\Modules\Administration\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use yajra\Datatables\Html\Builder;
use Sentinel;

use App\Modules\Administration\Models\User;
use App\Modules\Administration\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * 
     * @var UserRepositoryInterface
     */
    private $user;

    /**
     * Datatables Html Builder
     * @var Builder
     */
    protected $htmlBuilder;

    public function __construct(UserRepositoryInterface $_user, Builder $htmlBuilder)
    {
        $this->user         = $_user;
        $this->htmlBuilder  = $htmlBuilder;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(User::select(['id', 'first_name', 'last_name', 'email', 'created_at', 'updated_at']))
                ->addColumn('action', function($user){
                    $url = URL::route('administration.users.edit', $user->id);
                    return '<button class="btn btn-xs btn-info" onclick="getData('.$user->id.')">Edit</button>';
                })
                ->make(true);
        }

        // Build your DataTable Html
        $html = $this->htmlBuilder
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'Id'])
            ->addColumn(['data' => 'first_name', 'name' => 'first_name', 'title' => 'First Name'])
            ->addColumn(['data' => 'last_name', 'name' => 'last_name', 'title' => 'Last Name'])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);

        return view('Administration.Views.users.lists', [
                'form' => \View::make('Administration.Views.forms.userForm', [
                        'route' => ['route' => ['administration.users.store'] , 'files'=> true]
                    ]),                
            ],
            compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Administration.Views.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form  = $this->user->getEditForm();

        if (! $form->isValid())
        {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data = $this->user->createUser($form->getInputData(), $request->input('id'));

        return $this->redirectRoute('administration.users.edit', $data->id, [
            'message' => '<strong>Record</strong> has been successfully added.',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->user->findById($id);
        return view('Administration.Views.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->user->findById($id);

        return [
            'data' => $data,
            'updateRoute'  => URL::route('administration.users.update', $data->id)
        ];

        // return view('Administration.Views.users.edit', [
        //         'user' => $data,
        //         'destroyRoute'  => ['administration.users.destroy', $data->id],
        //         'record'        => "{$data->first_name}"." "."{$data->last_name}"
        //     ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form  = $this->user->getEditForm($id);

        if (! $form->isValid())
        {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data = $this->user->updateUserInfo($form->getInputData(), $id);

        return $this->redirectRoute('administration.users.edit', $data->id, [
            'message' => '<strong>Record</strong> has been updated.',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //lets find the if the model is existing by default
        //so we can have a glimpse of the value we will soon
        //to be used to redirect the user
        $user = Sentinel::findUserById($id);

        $user->delete($id);

        return $this->redirectRoute('administration.users.index', null, [
            'message' => 'Record has been deleted.',
            'success' => true
        ]);
    }
}
