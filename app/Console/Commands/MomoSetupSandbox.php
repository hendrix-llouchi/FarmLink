<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MomoSetupSandbox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'momo:setup-sandbox {subscription_key : The primary subscription key from MTN portal}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically registers an API User UUID, creates sandbox credentials on MTN, and updates the local .env configuration.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $primaryKey = $this->argument('subscription_key');
        $uuid = (string) Str::uuid();

        $this->info("1. Registering sandbox API User on MTN MoMo portal...");
        $this->comment("Generated user UUID: {$uuid}");

        $userUrl = "https://sandbox.momodeveloper.mtn.com/v1_0/apiuser";
        
        $response = Http::withHeaders([
            'X-Reference-Id' => $uuid,
            'Ocp-Apim-Subscription-Key' => $primaryKey,
            'Content-Type' => 'application/json',
        ])->post($userUrl, [
            'providerCallbackHost' => 'localhost'
        ]);

        if ($response->status() !== 201) {
            $this->error("Failed to create API User on MTN. Status: " . $response->status());
            $this->error($response->body());
            return 1;
        }

        $this->info("✓ API User created successfully on MTN!");

        $this->info("2. Generating API Key for user...");
        $keyUrl = "https://sandbox.momodeveloper.mtn.com/v1_0/apiuser/{$uuid}/apikey";

        $keyResponse = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => $primaryKey,
        ])->post($keyUrl);

        if ($keyResponse->status() !== 201) {
            $this->error("Failed to generate API Key from MTN. Status: " . $keyResponse->status());
            $this->error($keyResponse->body());
            return 1;
        }

        $apiKey = $keyResponse->json('apiKey');
        if (!$apiKey) {
            $this->error("API Key not found in response body.");
            return 1;
        }

        $this->info("✓ API Key generated successfully: {$apiKey}");

        $this->info("3. Saving configuration to .env file...");
        $this->updateEnvFile([
            'MOMO_PRIMARY_KEY' => $primaryKey,
            'MOMO_API_USER' => $uuid,
            'MOMO_API_KEY' => $apiKey,
            'MOMO_TARGET_ENVIRONMENT' => 'sandbox',
        ]);

        $this->info("✓ .env file updated successfully!");
        $this->line("");
        $this->comment("MOMO_PRIMARY_KEY: {$primaryKey}");
        $this->comment("MOMO_API_USER: {$uuid}");
        $this->comment("MOMO_API_KEY: {$apiKey}");
        $this->comment("MOMO_TARGET_ENVIRONMENT: sandbox");
        $this->line("");
        $this->info("Your local development MoMo sandbox environment is ready to test!");
        
        return 0;
    }

    /**
     * Update key-value pairs in the .env file.
     */
    protected function updateEnvFile(array $data)
    {
        $path = base_path('.env');

        if (!file_exists($path)) {
            $this->error('.env file does not exist. Please create one.');
            return;
        }

        $content = file_get_contents($path);

        foreach ($data as $key => $value) {
            $keyPosition = strpos($content, "{$key}=");

            if ($keyPosition !== false) {
                // Key exists, replace it
                $endOfLinePosition = strpos($content, "\n", $keyPosition);
                $oldLine = substr($content, $keyPosition, $endOfLinePosition - $keyPosition);
                $content = str_replace($oldLine, "{$key}={$value}", $content);
            } else {
                // Key doesn't exist, append it
                $content .= "\n{$key}={$value}";
            }
        }

        file_put_contents($path, $content);
    }
}
