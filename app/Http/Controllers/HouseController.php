<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\house;
use App\Models\Housecategories;
use App\Models\Apartment;
use App\Models\Lease;
use App\Models\User;
use Spatie\Permission\Models\Permission;


use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $houses = house::FilterByUSerRole()
                       ->FilterByUSerAccess()
                       ->select('houses.id','houses.*')
                       ->with('apartment')
                       ->with('housecategories')
                       ->get();
        
        return view('houses.index', compact('houses'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    if (Auth::user()->id != 1) {
        $housecategories = Housecategories::with('apartment')->where('apartment_id',Auth::user()->apartment_id)->get();
    }
    else{
        $housecategories = Housecategories::orderBy('apartment_id')->get();  
    }
         return view('houses.create', compact('housecategories'));
        //
    }
   
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
                if(House::where('housenumber',$request->housenumber)->exists()){
                    return redirect('/add-house')->with('statuserror','House Number already registered, House is already in the system')
                                               ->withInput($request->input());
                }
        
        
        $validatedData = $request->validate([
            'housenumber' => 'required',
            'housecategoryid' => 'required'
            
        ], [
            'housenumber.required' => 'This field is required',
            'housecategoryid.required' => 'This field is required',
        ]);
        $houses = new house;
        $houses->housecategoryid = $request->input('housecategoryid');
        $houses->housenumber = $request->input('housenumber');
        $houses->title = $request->input('title');
        $houses->description = $request->input('description');
        $houses->meternumber = $request->input('meternumber');  
        $houses->status = $request->input('status');
        $houses->save();

        
        $permissions = Permission::where('name','House.store_managers')->pluck('name')->toArray();
        $user = User::get()
        ->filter(function ($user) use ($permissions) {
            foreach ($permissions as $permission) {
                if (!$user->can($permission)) {
                    return false;
                }
            }

            return $user;
        });
        
        $houses->users()->attach($user);

        if(House::join('house_user','house_user.house_id','=','houses.id')
        ->where('house_user.house_id',$houses->id)
        ->where('house_user.user_id',Auth::user()->id)->exists())
            {
                return redirect('view-housemanagers/'.$houses->id)->with('status','House Added Successfully. Attach and remove managers of the House'); 
            }

        else{
        $user2 = User::where('id',Auth::user()->id)->pluck('id')->toArray();
        $houses->users()->attach($user2);
        }

          
            
       
       
        
        return redirect('view-housemanagers/'.$houses->id)->with('status','House Added Successfully. Attach and remove managers of the House');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $houses = house::find($id);
        $housecategories =housecategories::all();
        return view('houses.edit', compact('houses','housecategories'));
        //
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
        $validatedData = $request->validate([
            'housenumber' => 'required',
            'housecategoryid' => 'required'
            
        ], [
            'housenumber.required' => 'This field is required',
            'housecategoryid.required' => 'This field is required',
        ]);
        ////// Get the current number of the house being edited
        $hnum = House::where('id',$id)->select('housenumber')->first();

        $houses = house::find($id);
        $houses->housecategoryid = $request->input('housecategoryid');
        $houses->housenumber = $request->input('housenumber');
        $houses->title = $request->input('title');
        $houses->description = $request->input('description');
        $houses->meternumber = $request->input('meternumber');  
        
        ///// if housenumber being edited is equal to the house number entered then proceed
        if($hnum->housenumber == $request->get('housenumber') ){
            $houses->update();
            return redirect('/house')->with('status','House Updated Successfully');
        }
        //// if house number entered exists in the system, create an error
        elseif(House::where('housenumber', $request->housenumber)
        ->exists()) {
            return redirect('house')->with('statuserror','House is already in the system');
        }
        else{
            $houses->update();
            return redirect('/house')->with('status','House Updated Successfully');
        }   
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $houses = house::find($id);

        if(Lease::where('house_id',$id)->exists()){
            return redirect('/tenants')->with('statuserror','Cannot delete house. Lease is still active');
        }
        else{       
        $houses->delete();
        return redirect()->back()->with('status','House Deleted Successfully');
            }
        //
    }

    ///////////////////// functions to attach and detach managers
    public function ViewManagers($id)
    {
        $houses = house::with('apartment')->find($id);
        $managerview = House::join('house_user','house_user.house_id','=','houses.id')
                            ->join('users','house_user.user_id','=','users.id')
                            ->where('houses.id',$id)
                            ->select('houses.id','users.name','house_user.user_id','houses.housenumber')
                            ->get();
        
        return view('houses.viewmanager', compact('managerview','houses'));
    }

    public function editManagers($id){

        $houses = House::find($id);
        $userrole = Auth::user()->apartment_id;
        //////// Get all users with the mentioned permission from the permission model ////
        $permissions = Permission::where('name','House.view_managers')->pluck('name')->toArray();
    
        ////// This method is used to add users who have the role described above ///////////
        $user = User::with('roles')->FilterByUSerRole($userrole)->get()
            ->filter(function ($user) use ($permissions) {
                foreach ($permissions as $permission) {
                    if (!$user->can($permission)) {
                        return false;
                    }
                }

                return $user;
            });
        
        $managerview = House::join('house_user','house_user.house_id','=','houses.id')
                            ->join('users','house_user.user_id','=','users.id')
                            ->where('houses.id',$id)
                            ->select('house_user.id','users.name','house_user.user_id')
                            ->get();

        


        return view('houses.editmanager', compact('houses','user','managerview'));
    }
    
    public function storeManagers(Request $request, $id){

        if(House::join('house_user','house_user.house_id','=','houses.id')
                           ->where('house_user.house_id',$id)
                           ->where('house_user.user_id',$request->get('user_id'))->exists())
        {
            return redirect('view-housemanagers/'.$id)->with('statuserror','Manager Already added to House');
        }

        $houses = House::find($id);
     
        $houses->users()->attach($request->get('user_id'));

    
    

        return redirect('view-housemanagers/'.$id)->with('status','House Manager Added Successfully');
    }
    public function updateManagers(Request $request, $id){
        $houses = House::find($id);

        $houses->users()->detach($request->get('user_id'));

     
       

    
    

        return redirect('view-housemanagers/'.$id)->with('status','House Manager Removed Successfully');
    }
    
}
