<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ApartmentRequestServiceInterface;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApartmentRequestController extends Controller
{
    protected ApartmentRequestServiceInterface $service;

    public function __construct(ApartmentRequestServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(): View
    {
        return view('apartments.request');
    }

    public function store(ApartmentRequest $request): View|RedirectResponse
    {
        try {
            $submittedRequest = $this->service->submitRequest($request->validated());
            
            // Generate WhatsApp link with message
            $whatsappMessage = $this->generateWhatsAppMessage($submittedRequest);
            $whatsappLink = 'https://wa.me/234' . $this->getWhatsAppNumber() . '?text=' . urlencode($whatsappMessage);
            
            // Store request in session for the success page
            session()->flash('request_data', $submittedRequest);
            
            return view('apartments.success', [
                'request' => $submittedRequest,
                'whatsapp_link' => $whatsappLink,
            ]);
            
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Generate WhatsApp message from request data
     */
    private function generateWhatsAppMessage($request): string
    {
        $message = "Hello! I just submitted an apartment request on " . config('app.name') . ". Here are my details:\n\n";
        $message .= "📝 Name: " . $request->full_name . "\n";
        $message .= "📞 Phone: " . $request->phone . "\n";
        $message .= "📧 Email: " . $request->email . "\n";
        $message .= "📍 Location: " . str_replace('_', ' ', $request->preferred_location) . "\n";
        $message .= "🏠 Apartment Type: " . str_replace('_', ' ', $request->apartment_type) . "\n";
        $message .= "💰 Budget: " . str_replace('_', ' - ₦', $request->budget) . "\n";
        $message .= "📅 Move-in: " . str_replace('_', ' ', $request->move_in_timeline) . "\n";
        $message .= "👥 Occupancy: " . ucfirst($request->occupancy_type) . "\n";
        $message .= "🤝 Roommate Needed: " . ucfirst($request->roommate_needed) . "\n";
        
        if ($request->requirements) {
            $requirements = is_array($request->requirements) ? $request->requirements : json_decode($request->requirements, true);
            if (!empty($requirements)) {
                $message .= "✅ Requirements: " . implode(', ', array_map(function($req) {
                    return str_replace('_', ' ', $req);
                }, $requirements)) . "\n";
            }
        }
        
        if ($request->notes) {
            $message .= "📝 Additional Notes: " . $request->notes . "\n";
        }
        
        $message .= "\nLooking forward to hearing from you! 🙏";
        
        return $message;
    }

    /**
     * Get WhatsApp number from config or env
     */
    private function getWhatsAppNumber(): string
    {
        // Format: 80XXXXXXXX (no +, no country code)
        return config('app.whatsapp_number', '');
    }
}