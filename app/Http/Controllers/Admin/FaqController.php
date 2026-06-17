<?php

namespace App\Http\Controllers\Admin;
use App\Models\Faq;
use App\Contracts\Services\FaqServiceInterface;
use App\Services\Admin\FaqService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use Illuminate\Http\Request;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;


use Illuminate\View\View;

class FaqController extends Controller
{
    //

    protected $faqService;

    public function __construct(FaqService $faqService){
     
    $this->faqService  =  $faqService;

    }

  
    public function index():View
    {
       $data = $this->faqService->getFaqs();
       $faqs = $data['faqs'];
       $total = $data['total'];


        return view('admin.faq.index',compact('faqs', 'total'));
    }

    public function create():View
    {
        return view('admin.faq.create');    
    }

    public function store(FaqRequest $request):RedirectResponse

    {

    try{

    $this->faqService->storeFaq($request->validated());
   
      return redirect()->route('admin.faq.index')->with('success', 'Faq has been  added successfully');

    } catch(\Exception $e){
        Log::error($e->getMessage());
    return redirect()->route('admin.faq.create')->withInput($request->all());
    }

    }


    public function edit(Request $request):View
    {
       
     $faq = $this->faqService->getFaqById($request['id']);
      
    return view('admin.faq.edit',compact('faq'));
    }

    public function updateFaq(int $id, FaqRequest $request):RedirectResponse
    {

        try{
            $this->faqService->updateFaq($id, $request->validated());
            return redirect()->route('admin.faq.index')->with('success', 'Edited successfully');
        } catch (\Exception $e){

          Log::error($e->getMessage());
          return redirect()->route('admin.faq.edit', $id)->withInput()->with('error', 'whoops, something went wrong');
        }
    }

    public function toggleStatus(int $id):RedirectResponse
    {
        try{
            $this->faqService->toggleStatus($id);
        return redirect()->route('admin.faq.index')->with('success','Status changed successfully');

        } catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.faq.index')->with('error','Something went wrong');
        }
    }

    public function destroy(int $id):RedirectResponse
    {
        try{
           $this->faqService->deleteFaq($id);
             return redirect()->route('admin.faq.index')->with('success','Deleted successfully');
        } catch(\Exception $e){
              Log::error($e->getMessage());
            return redirect()->route('admin.faq.index')->with('error','Something went wrong');
        }
    }




}
