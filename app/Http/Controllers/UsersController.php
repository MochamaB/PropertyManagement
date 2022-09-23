<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Apartment;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;


class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        
        $apartment = User::latest()->paginate(10);

        if (Auth::user()->id != 1) {
           $users= User::where('apartment_id',Auth::user()->apartment_id)->get();
        }
        elseif(Auth::user()->id == 1){
            $users = User::get();
        }

      

        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $apartment = Apartment::get();
        return view('users.create',compact('apartment'));
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $role = Role::where('name', 'Guest')->first();

    ///// Make sure that user that is registered from the registration page is assigned the right apartment ID
        if($request->apartment_id == null){
            $apartmentid = Auth::user()->apartment_id; ///Assigns the current users logged in apartment ID
        }else{
            $apartmentid = $request->apartment_id; //// Assigns apartment from edit form
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'apartment_id' => $apartmentid,
        ]);
        $user->assignRole($role);

        return redirect('/users')->with('status','User created successfully');
    }                                      

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        $apartment = Apartment::get();

        return view('users.edit', [
            'user' => $user,
            'apartment' => $apartment,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);

        
       
            

    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request) 
    {
        $user->update($request->validated());
        

        $user->syncRoles($request->get('role'));

        

        return redirect()->route('Users.view')
        ->with('status','User updated successfully.');
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        
        if($user->id == 1 ){
            return redirect()->route('Users.view')
                    ->with('statuserror','Super Admin user cannot be deleted');
        }
        
        $user->delete();

        return redirect()->route('Users.view')
            ->with('status','User deleted successfully.');
    }
}