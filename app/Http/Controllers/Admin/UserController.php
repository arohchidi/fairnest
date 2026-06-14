<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Admin\UserService;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\RegisterRequest;
use Illuminate\Support\Facades\Log;


use Symfony\Component\HttpFoundation\RedirectResponse as HttpFoundationRedirectResponse;





class UserController extends Controller
{
    //
     protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

//return users page
    public function index(Request $request):View{
         

        $filters = $request->only(['search', 'role', 'is_active', 'is_verified', 'sort_by', 'sort_order', 'per_page']);
        $statistics = $this->userService->getUsersStatistics();
        $users = $this->userService->getFilteredUsers($filters);
        return view('admin.users.index',compact('statistics','users'));
    }

    public function show(int $id): View{
     $data = $this->userService->getUserById($id);
      

     return view('admin.users.show',$data);
    }


    public function delete(int $id):HttpFoundationRedirectResponse
    {
        $data = $this->userService->deleteUser($id);
        if($data){
             return redirect()->route('admin.users.index')->with('success', 'User has been successfully deleted');
        }else{
            Log::warning('Failed to delete user', [
            'user_id' => $id,]);
             return redirect()->route('admin.users.index')->with('error', 'Whoops, something went wrong');
        }

       
    }

    public function toggleStatus(int $id):HttpFoundationRedirectResponse
    {
       $data = $this->userService->toggleUserStatus($id);

       if($data){
         return redirect()->route('admin.users.index')->with('success', "User's status has sucessfully been changed");
       }else{
       Log::warning('Failed to delete user', [
            'user_id' => $id,]);
             return redirect()->route('admin.users.index')->with('error', 'Whoops, something went wrong');
       }
    }

    
  //return edit page
    public function edit(int $id):View
    {
    $user = $this->userService->editUser($id);

    return view('admin.users.edit', $user);
    }

    //Update user account
    public function updateUser(int $id, UpdateUserRequest $request):HttpFoundationRedirectResponse
    {
        
      $user = $this->userService->updateUser($id,$request->all());

      

      if($user){
        return redirect()->route('admin.users.edit', $id)->with('success', 'Account of   has successfully been edited');
      }else{
        return redirect()->route('admin.users.edit', $id)->with('error', 'Whoops, something went wrong');
      }


    }


    //return create user view
    public function create():View{
        return view('admin.users.create');
    }

    public function store(RegisterRequest $request):HttpFoundationRedirectResponse

    {
      
    try{

       $user =  $this->userService->createUser($request->all());
        
        return redirect()->route('admin.users.create')->with('success', 'User ' .$user->username .  ' has been created successfully');

    } catch(\Exception $e){
      return redirect()->route('admin.users.create')->with('error', 'Something went wrong.Coult not create user'); 
    }
        
    }





}
