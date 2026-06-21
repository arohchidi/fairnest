<?php

namespace App\Services;

use App\Contracts\Services\ReportServiceInterface;

use App\Models\Report;
use App\Models\Property;


use Override;

class ReportService implements ReportServiceInterface {

protected $reportModel;
protected $propertyModel;
public function __construct(Report $model, Property $property){
 $this->reportModel = $model;
 $this->propertyModel = $property;

}


#[Override]
	public function storeReport(array $data, int $id): ?Report
    {
       // check if the property id exists


       $property = $this->propertyModel->findOrFail($id);
    
      
  if(!empty($data['photo'])){
   $imagePath =  $this->processPhotos($data['photo']);
  }

       $report = $this->reportModel->create([
       'name' => $data['name'],
       'email' => $data['email'],
       'title' => $data['title'],
       'description' => $data['description'],
       'property_id' => $property->id,
       'anonymous' => $data['anonymous'] ?? null,
       'photo' =>  $imagePath ?? null,
       'category'  => $data['category'],
       
       ]);

       return $report;
      
    }

    //process images and return comma-separated paths
private function processPhotos($photo): array
{
    $imagePaths = [];

    foreach ($photo as $image) {
       
        //$imagePaths[] = $image->store('report_photos', 'public');

        $path = $image->store('report_photos', 'public');
        $imagePaths[] = str_replace('\\', '/', $path);
    }

    return $imagePaths;
}

}





?>