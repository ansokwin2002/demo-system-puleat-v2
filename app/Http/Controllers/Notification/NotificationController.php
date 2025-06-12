<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\PatientHistory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index()
    {
        // [Page_title----------------------------------]
            $pageTitle = 'Notification | Laor-Prornit-Clinic-Dental';
        // [Page_title----------------------------------]
    
        // Get today's date
        $today = Carbon::today()->format('Y-m-d');
    
        // Retrieve patient histories with related doctor and patient
        $patientHistories = PatientHistory::with(['doctor', 'patient'])
            ->whereRaw('JSON_EXTRACT(patient_payment, "$.next_appointment_date") = ?', [$today])
            ->get();
    
        // Prepare data for the view and collect messages for notifications
        $appointmentNotifications = $patientHistories->map(function ($history) {
            // Access related models
            $doctorName = $history->doctor ? $history->doctor->name : 'No Doctor Assigned';
            $patientName = $history->patient ? $history->patient->name : 'Unknown Patient';
            $patientPhone = $history->patient ? $history->patient->telephone : 'N/A';
            
            // Access next appointment date from patient_payment JSON
            $nextAppointmentDate = isset($history->patient_payment['next_appointment_date']) 
                ? Carbon::parse($history->patient_payment['next_appointment_date']) 
                : null;
    
            // Convert services to a collection for further operations
            $services = collect($history->patient_payment['services'] ?? []);
    
            // Prepare the services string
            $servicesList = $services->isNotEmpty() 
                ? implode(", ", $services->pluck('service_name')->toArray()) // Assuming service_name is the field you want to display
                : 'No services assigned';
    
            // Prepare the message for Telegram
            $message = "╔═════════════════════╗\n" .
           "      🦷 <b>Today Appointments</b> 🦷\n" . // Title (correctly bold)
           "╚═════════════════════╝\n\n" . // Separator
           "📅 <b>Date:</b> " . date('Y-m-d') . "  " . // Format date as YYYY-MM-DD
           "🕘 <b>Time:</b> " . now()->format('h:i A') . "\n\n" . // Time
           "🔻 <b>Patient:</b> <b>{$patientName}</b>\n" .
           "🔻 <b>Doctor:</b> <b>{$doctorName}</b>\n" .
           "🔻 <b>Appointment:</b> <b>" . 
           ($nextAppointmentDate ? $nextAppointmentDate->format('Y-m-d') : 'N/A') . 
           "</b>\n" .
           "🔻 <b>Phone:</b> <b>{$patientPhone}</b>\n" .
           "🔻 <b>Services:</b> <b>{$servicesList}</b>";
    
            return [
                'patient_id' => $history->patient_id,
                'patient_name' => $patientName,
                'patient_phone' => $patientPhone,
                'doctor_name' => $doctorName,
                'register_date' => $history->created_at->format('Y-m-d'),
                'next_appointment' => $nextAppointmentDate ? $nextAppointmentDate->format('Y-m-d') : 'N/A',
                'services' => $services,
                'message' => $message, // Include the message in the returned array
            ];
        });
    
        return view('backend.notifications.index', [
            'appointmentNotifications' => $appointmentNotifications,
            'pageTitle' => $pageTitle,
        ]);
    }

    public function sendAppointmentNotifications()
    {
        $appointmentNotifications = $this->index()->getData()['appointmentNotifications'];
    
        // Start the combined message
        $combinedMessage = "╔═════════════════════╗\n" .
                           "      🦷 <b>Today Appointments</b> 🦷\n" .
                           "╚═════════════════════╝\n\n" .
                           "📅 <b>Date:</b> " . date('Y-m-d') . "  " .
                           "🕘 <b>Time:</b> " . now()->format('h:i A') . "\n\n";
        
        $counter = 1; // Initialize counter for appointments
        
        foreach ($appointmentNotifications as $notification) {
            // Combine individual patient messages into the combined message
            $combinedMessage .= "No: {$counter}\n" . // Include the counter for numbering
                                "🔻 <b>Patient:</b> <b>{$notification['patient_name']}</b>\n" .
                                "🔻 <b>Doctor:</b> <b>{$notification['doctor_name']}</b>\n" .
                                "🔻 <b>Appointment On:</b> <b>{$notification['next_appointment']}</b>\n" .
                                "🔻 <b>Phone:</b> <b>{$notification['patient_phone']}</b>\n" .
                                "🔻 <b>Services:</b> <b>" . implode(", ", $notification['services']->pluck('service_name')->toArray()) . "</b>\n" .
                                "-----------------------------------------------\n"; // Separator for each patient
            
            $counter++; // Increment counter for next appointment
        }
    
        // Check if there are any notifications to send
        if ($counter > 1) { // Only send if there are appointments
            // Send the combined message to Telegram
            $this->sendToTelegram($combinedMessage, 'Today Appointments');
        } else {
            Log::info("No appointments for today.");
        }
    }
    

    private function sendToTelegram($message, $patientName)
    {
        $botToken = '7338867954:AAEs-_CBwnUyRTHo3hhnO6qRx4cFPDLQ5Gk';
        $groupId = '-4593458451';

        try {
            $response = Http::withOptions(['verify' => false]) // Change to false for testing
                ->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $groupId,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ]);

            if ($response->successful()) {
                Log::info("Notification sent successfully for patient: {$patientName}");
            } else {
                Log::error("Failed to send notification for patient: {$patientName} - {$response->body()}");
            }
        } catch (\Exception $e) {
            Log::error("Error sending notification for patient: {$patientName} - {$e->getMessage()}");
        }
    }


    
}
