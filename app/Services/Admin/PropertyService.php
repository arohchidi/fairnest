<?php

namespace App\Services\Admin;

use App\Contracts\Services\PropertyServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Property;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use Override;

use function PHPUnit\Framework\throwException;

class PropertyService implements PropertyServiceInterface
{

protected $propertyModel;
    
    public function __construct(Property $model)
    {
        $this->propertyModel = $model;
    }


      
    public function createProperty(array $data)
    {
        
$user = Auth::user();


if(!$user){
    throw new \Exception('User not authenticated');
}
        $property = Property::create([
             'user_id' => $user->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'number_of_bedrooms' => $data['number_of_bedrooms'],
            'number_of_bathrooms' => $data['number_of_bathrooms'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'type_of_house' => $data['type_of_house'],
            'number_of_parking_spaces' => $data['number_of_parking_spaces'] ?? 0,
            'is_furnished' => $data['is_furnished'],
            'is_available' => $data['status'],
            'rent_fee' => $data['rent_fee'],
             'agency_fee' => $data['agency_fee'],
             'images' => $this->processImages($data['images']),
             'roommate_preferences' => $data['roommate_preferences'] ?? null,
             'contact_information' => $data['contact_information'] ?? null,
              'meta_data' => $data['amenities'] ?? null,
        ]);

        return $property;
    }

//process images and return comma-separated paths
private function processImages($images): array
{
    $imagePaths = [];

    foreach ($images as $image) {
       
        $imagePaths[] = $image->store('property_images', 'public');

        $path = $image->store('property_images', 'public');
        $imagePaths[] = str_replace('\\', '/', $path);
    }

    return $imagePaths;
}

    public function getProperties(): array
    {
        $property = Property::orderBy('created_at', 'desc')->paginate(10);

        return ['properties' => $property];

       
    }


    public function getFilteredProperties(array $filters): LengthAwarePaginator
    {
       
        $query =  $this->propertyModel->newQuery();

      

        //query  by different filters

        if(!empty($filters['search'])){
           $query =   $this->applySearchFilter($query, $filters['search']);
        }


        if(!empty($filters['status'])){
            $query = $this->applyStatusFilter($query, $filters['status']);
        }

        if(!empty($filters['rent_fee'])){

             [$min, $max] = explode(',', $filters['rent_fee']);

              $filters['rent_fee_min'] = $min;
              $filters['rent_fee_max'] = $max;


            $query = $this->applyRentFeeFilter($query, $filters['rent_fee_min'],$filters['rent_fee_max']);
        }

        if(!empty($filters['type_of_house'])){
            $query = $this->applyTypeofHouseFilter($query, $filters['type_of_house']);
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
            $q->where('title', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%")
              ->orWhere('city', 'like', "%$search%");
        });

      }


    private function applyStatusFilter($query, string $status){
        return $query->where('is_available', $status);
    }

    private function applyRentFeeFilter($query, float $rent_fee_min, float $rent_fee_max){
        return $query->whereBetween('rent_fee', [$rent_fee_min, $rent_fee_max]);

        
    }

    private function applyTypeofHouseFilter($query,  string $type_of_house){
        return $query->where('type_of_house', $type_of_house);
    }

        private function applySorting($query, string $sortBy, string $sortOrder)
    {
        $allowedSorts = ['created_at', 'rent_fee', 'title', 'type_of_house', 'is_available'];
        
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }
        
        if ($sortBy === 'rent_fee') {
            return $query->orderBy('rent_fee', $sortOrder);
        }
        if($sortBy === 'title'){
             return $query->orderBy('title', $sortOrder);
        }
         if($sortBy === 'is_available'){
             return $query->orderBy('is_available', $sortOrder);
        }

        if($sortBy === 'type_of_house'){
             return $query->orderBy('type_of_house', $sortOrder);
        }
        
        
        return $query->orderBy($sortBy, $sortOrder);
    }




    //get property by id
    #[Override]
    public function getPropertyById(int $id)
    {
        $property = $this->propertyModel->find($id);

        

        if(!$property){
             throw new \Exception('Cannot find a property with the id'.$id);
        }else{
            return $property;}
    }
            


    #[Override]
    public function updateProperty(int $id, array $data)
    {

DB::beginTransaction();

         try{
          $property = $this->propertyModel->findOrFail($id);

           if(isset($data['images']) && is_array($data['images'])){

           $data['images'] = $this->updateNewImages($property,$data['images']);
        }else{
            unset($data['images']);
         }

          $property->fill($data);
          $property->save();
          DB::commit(); 
        return $property;
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
         }

       
         }


    //process images and return comma-separated paths
private function updateNewImages($property,$images): array
{


    $imagePaths = [];
    $oldImages = $property->images ?? [];
   
// delete the old images in the storage folder
    if($oldImages){
        
       $oldImages = array_map(function ($img) {
    return str_replace('\\/', '/', $img);
       }, $oldImages);

    Storage::disk('public')->delete($oldImages);
    }

    foreach ($images as $image) {
        $path = $image->store('property_images', 'public');
$imagePaths[] = str_replace('\\', '/', $path);
        
    }

    return $imagePaths;
}



//delete a property
#[Override]
	public function deleteProperty(int $id)
    {

    return DB::transaction(function() use ($id){
    $property = $this->propertyModel->findOrFail($id);
    
    $delete = $property->delete();

    return $delete;

    });
       
    }

}