<?php
namespace  App\Services\Admin;
use App\Models\Faq;

use App\Contracts\Services\FaqServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;




use Override;

class FaqService implements FaqServiceInterface
{
   protected $faqModel;
 

   public function __construct(Faq $faq)
   {
    $this->faqModel = $faq;
   }
   

   #[Override]
   public function getFaqs(): array
   {
    
       $faqs = $this->faqModel->orderby('sort_id','ASC')->paginate(10);
       
       return [
        'faqs' => $faqs,
        'total' => $faqs->total(),
       ]; 
  

   }


   #[Override]
   public function storeFaq(array $data)
   {

    return $this->faqModel->create([
        'sort_id' => $data['sort_id'],
        'question' => $data['question'],
        'answer' => $data['answer'],
        'category' => $data['category'],
        'is_active' => $data['is_active'],
    ]);
    
   }

   #[Override]
   public function getFaqById(int $id)
   {
    
     return $this->faqModel->findorFail($id);

   }


   #[Override]
   public function updateFaq(int $id, array $data)
   {
    $faq = $this->faqModel->findOrFail($id);
    $faq->fill($data);
    $faq->save();
    return $faq;
       
   }

   #[Override]
   public function toggleStatus(int $id):Faq
   {
    $faq = $this->faqModel->findOrFail($id);
    $is_active  = $faq->is_active;

    if($is_active == 1){
       $faq->update(['is_active' => 0]); 
    }else{
         $faq->update(['is_active' => 1]); 
    }

    return $faq->refresh();

   }

   #[Override]
   public function deleteFaq(int $id):bool
   {
      
      return $this->faqModel->findOrFail($id)->delete();


   }



}


?>