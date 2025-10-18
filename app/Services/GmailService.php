<?php

namespace App\Services;

use Google\Client;
use Google\Service\Gmail;
use App\Models\Email;
use App\Models\EmailAccount;
use Carbon\Carbon;

class GmailService
{
    public function fetchEmails(EmailAccount $emailAccount)
    {
        try {
            $client = new Client();
            $client->setAccessToken($emailAccount->access_token);
            
            // Token refresh logic (if needed)
            if ($client->isAccessTokenExpired()) {
                // You'll need to implement token refresh
                return false;
            }
            
            $gmail = new Gmail($client);
            
            // Fetch recent emails from Gmail
            $messages = $gmail->users_messages->listUsersMessages('me', [
                'maxResults' => 10, // Start with small number
                'labelIds' => 'INBOX'
            ]);
            
            $emailsSaved = 0;
            foreach ($messages->getMessages() as $message) {
                if ($this->saveEmail($gmail, $message->getId(), $emailAccount)) {
                    $emailsSaved++;
                }
            }
            
            return $emailsSaved;
            
        } catch (\Exception $e) {
            \Log::error('Gmail fetch error: ' . $e->getMessage());
            return false;
        }
    }
    
    private function saveEmail($gmail, $messageId, $emailAccount)
    {
        try {
            $message = $gmail->users_messages->get('me', $messageId, ['format' => 'full']);
            $payload = $message->getPayload();
            $headers = $payload->getHeaders();
            
            // Extract email data
            $emailData = [
                'email_account_id' => $emailAccount->id,
                'subject' => $this->getHeader($headers, 'Subject') ?? 'No Subject',
                'from_email' => $this->getHeader($headers, 'From') ?? 'Unknown Sender',
                'body' => $this->getBody($payload),
                'external_id' => $messageId,
                'provider' => 'gmail',
                'folder' => 'inbox',
                'status' => 'inbox',
                'direction' => 'incoming',
                'tenant_id' => $emailAccount->tenant_id,
                'created_at' => Carbon::createFromTimestamp($message->getInternalDate() / 1000),
            ];
            
            // Check if email already exists
            if (!Email::where('external_id', $messageId)->exists()) {
                Email::create($emailData);
                return true;
            }
            
            return false;
            
        } catch (\Exception $e) {
            \Log::error('Save email error: ' . $e->getMessage());
            return false;
        }
    }
    
    private function getHeader($headers, $name)
    {
        foreach ($headers as $header) {
            if ($header->getName() === $name) {
                return $header->getValue();
            }
        }
        return null;
    }
    
    private function getBody($payload)
    {
        if ($payload->getParts()) {
            foreach ($payload->getParts() as $part) {
                if ($part->getMimeType() === 'text/plain') {
                    $data = $part->getBody()->getData();
                    return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
                }
            }
        } else {
            $data = $payload->getBody()->getData();
            return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
        }
        
        return 'No body content';
    }
}