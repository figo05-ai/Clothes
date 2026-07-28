<?php

namespace App\Contracts\Notification;

interface NotificationServiceInterface
{
    /**
     * Send an email notification to the user.
     *
     * @param string $email
     * @param string $subject
     * @param string $message
     * @return bool
     */
    public function sendEmail(string $email, string $subject, string $message): bool;

    /**
     * Send an SMS notification to the user.
     *
     * @param string $phoneNumber
     * @param string $message
     * @return bool
     */
    public function sendSms(string $phoneNumber, string $message): bool;
}
