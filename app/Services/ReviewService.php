<?php

namespace App\Services;
use App\Contracts\Services\ReviewServiceInterface;
use App\Models\Review;
use App\Models\Property;


class ReviewService implements ReviewServiceInterface {


protected $reviewModel;
protected $propertyModel;
 public function __construct(Review $reviewModel, Property $propertyModel)
 {
   $this->reviewModel = $reviewModel;
   $this->propertyModel = $propertyModel;
 }

 public function store(array $data, int $id):Review

 {
    //check for property id 
    $property = $this->propertyModel->findOrFail($id);

    

    $review = $this->reviewModel->create([
      'property_id' => $property->id,
      'name' => $data['name'],
      'comment' => $data['comment'],
      'ratings' => $data['ratings'],
    ]);

 return $review->refresh();
 }


}
?>