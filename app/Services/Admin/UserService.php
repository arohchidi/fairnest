<?php
namespace  App\Services\Admin;
use App\Models\User;
use App\Models\Property;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;




use Override;

class UserService implements UserServiceInterface
{
   protected $userModel;
   protected $propertyModel;

   public function __construct(User $model, Property $propModel)
   {
    $this->userModel = $model;
    $this->propertyModel = $propModel;
   }
   


	public function getUsersStatistics(): array
    {

      return [
        
        'active' => $this->userModel->where('is_active', 1)->count(),
        'is_active'  => $this->userModel->where('is_active',0)->count(),
        'new_this_month' => $this->userModel->where('created_at', '<=', Carbon::now())->count(),
        'total' =>  $this->userModel->count(),
      ];
     


     
    }

        public function getFilteredUsers(array $filters): LengthAwarePaginator
    {
       
        $query =  $this->userModel->newQuery();

      

        //query  by different filters

        if(!empty($filters['search'])){
           $query =   $this->applySearchFilter($query, $filters['search']);
        }


        if(!empty($filters['is_active'])){
            $query = $this->applyStatusFilter($query, $filters['is_active']);
        }
         

        if(!empty($filters['is_verified'])){
            $query = $this->applyIsVerifiedFilter($query, $filters['is_verified']);
        }
    
        if(!empty($filters['role'])){
            $query = $this->applyRoleFilter($query, $filters['role']);
        }

        // Apply sorting
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query = $this->applySorting($query, $sortBy, $sortOrder);

        $perPage = $filters['per_page'] ?? 15;

        return $query->paginate($perPage);
        
        

        
    }

        private  function applySearchFilter($query, string $search){

      return $query->where(function($q) use ($search){
            $q->where('username', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('phone', 'like', "%$search%");
        });

      }


      private function applyStatusFilter($query, string $is_active){
        return $query->where('is_active', $is_active);
      }


       private function applyIsVerifiedFilter($query, string $is_verified){
        return $query->where('is_verified', $is_verified);
      }

         private function applyRoleFilter($query, string $role){
        return $query->where('role', $role);
      }



        private function applySorting($query, string $sortBy, string $sortOrder)
    {
        $allowedSorts = ['role', 'is_verified', 'is_active', '', 'is_available', 'username'];
        
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }
        
        if ($sortBy === 'role') {
            return $query->orderBy('role', $sortOrder);
        }
        if($sortBy === 'username'){
             return $query->orderBy('username', $sortOrder);
        }
         if($sortBy === 'is_verified'){
             return $query->orderBy('is_verified', $sortOrder);
        }

        if($sortBy === 'is_active'){
             return $query->orderBy('is_active', $sortOrder);
        }
        
        
        return $query->orderBy($sortBy, $sortOrder);
    }


    #[Override]
    public function getUserById(int $id):array
    {
       $user = $this->userModel
        ->withCount('properties')
        ->findOrFail($id);

        $userProperties = $this->propertyModel->where('user_id', $id)->paginate(5);

        

    return [
        'user' => $user,
        'properties' => $user->properties_count,
        'userProperties' => $userProperties,
    ];
    }

    public function deleteUser(int $id):bool
    {
         return $this->userModel->findOrFail($id)->delete();
    }


    #[Override]
    public function toggleUserStatus(int $id): bool
    {
       $user = $this->userModel->findOrFail($id);
       return $user->update([
        'is_active' => ! $user->is_active,
    ]);
    }

    #[Override]
    public function editUser(int $id):array
    {
        $user =  $this->userModel->findOrFail($id);
        return [
            'user' => $user
        ];
    }

    //update user account
    #[Override]
    public function updateUser(int $id, array $data): array
    {  
    

     $user =  $this->userModel->findOrFail($id);
     $data = array_filter($data,
        fn ($value) => $value !== null
    );

     $user->fill($data);
     $user->save();
     

     return ['user' => $user->id ];
     


    }

    #[Override]
    public function createUser(array $data)
    {
         $user = $this->userModel->create([
         'username' => $data['username'],
         'email' => $data['email'],
         'phone' => $data['phone'],
         'role' => $data['role'],
         'is_active' => $data['is_active'],
         'password' => Hash::make($data['password']),

         ]);

         $user->save();
        
      return $user;
    }



}


?>