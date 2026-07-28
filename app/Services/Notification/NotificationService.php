<?php

namespace App\Services\Notification;

use App\Contracts\Notification\NotificationServiceInterface;
use Illuminate\Support\Facades\Log;

class NotificationService implements NotificationServiceInterface
{
    public function sendEmail(string $email, string $subject, string $message): bool
    {
        // Here we would typically dispatch a Laravel Job to send the email
        // Example: dispatch(new SendEmailJob($email, $subject, $message));
        
        Log::info("Simulating email sent to {$email} with subject: {$subject}");
        return true;
    }

    public function sendSms(string $phoneNumber, string $message): bool
    {
        // Integration with Twilio, Nexmo, etc.
        Log::info("Simulating SMS sent to {$phoneNumber}");
        return true;
    }
}
