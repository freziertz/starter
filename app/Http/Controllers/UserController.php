<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Arr;
use App\Models\Organization;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as Req;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = User::orderBy('id','DESC')->paginate(5);

        // return Inertia::render('Users/Index', ['users' => $users ])
        //         ->with('i', ($request->input('page', 1) - 1) * 5);



        // return view('users.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);


              return Inertia::render('Users/Index', [
            'filters' => Req::all('search', 'role', 'trashed'),
            'users' => Auth::user()->account->users()
                ->orderByName()
                ->filter(Req::only('search', 'role', 'trashed'))
                ->get()
                ->transform(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'owner' => $user->owner,
                    'photo' => $user->profile_photo_path ? URL::route('image', ['path' => $user->profile_photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
                    'deleted_at' => $user->deleted_at,
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::get();
        $accounts = Account::get();
        $organizations = Organization::get();
        return Inertia::render('Users/Create',compact('roles','accounts','organizations'));

        // $roles = Role::pluck('id','id')->all();
        return view('users.create',compact('roles'));
        // return Inertia::render('Users/Show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'name' => 'required',
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|same:confirm-password',
            // 'roleIds' => 'required'
        ]);





        $input = $request->all();

        // $input['account_id'] = 1;
        // $input['organization_id'] = 1;
        //   $input['first_name'] = 'Frezier';
        // $input['last_name'] = 'Beatus';




        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);



        $user->assignRole($request->input('roleIds'));



        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  {
        $user_edited = User::find($id);

        $account = Account::find($user_edited->account_id);
        $roles = Role::get();
        $accounts = Account::get();
        $organizations = Organization::get();
        $userRoles = $user_edited->roles->pluck('id','id')->all();


         return Inertia::render('Users/Edit',compact('accounts','organizations', 'user_edited','roles','userRoles'));

        // return view('users.edit',compact('user_edited','roles','userRole'));
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




        $this->validate($request, [

             'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.$id,
            // 'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            // 'roles' => 'required'
        ]);





        if (isset($request['photo'])) {
            $user = User::find($id);
            $user->updateProfilePhoto($request['photo']);
        }

         $input = $request->all();
        // if(!empty($input['password'])){
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = Arr::except($input,array('password'));
        // }



        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();



        $user->assignRole($request->input('roleIds'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}

