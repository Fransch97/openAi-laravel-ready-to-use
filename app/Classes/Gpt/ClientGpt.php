<?php

namespace App\Features\Gpt;

use Orhanerday\OpenAi\OpenAi;

class ClientGpt
{
    private OpenAi $gpt;
    private string $message;

    public function __construct(
        private readonly string $token,
        private string $model,
        private float $temperature,
        private int $maxTokens,
        private int $frequencyPenalty,
        private float $presencePenalty,
    ){
        $this->gpt = new OpenAi($this->token);
        $this->message = null;
    }

    public function getModelList()
    {
        return $this->gpt->listModels();
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getModel(string $model): string
    {
        return $this->model;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(string $message): string
    {
        return $this->message;
    }

    public function setMaxTokens(int $maxTokens): void
    {
        $this->maxTokens = $maxTokens;
    }

    public function getMaxTokens(): int
    {
        return $this->maxTokens;
    }

    public function setFrequencyPenalty(int $frequencyPenalty): void
    {
        $this->frequencyPenalty = $frequencyPenalty;
    }

    public function getFrequencyPenalty(): int
    {
        return $this->frequencyPenalty;
    }

    public function setPresencePenalty(int $presencePenalty): void
    {
        $this->presencePenalty = $presencePenalty;
    }

    public function getPresencePenalty(): float
    {
        return $this->presencePenalty;
    }

    public function ask(string $message = null)
    {
        if (!$message && !$this->message) {
            return "Provide a message and retry";
        }

        return $this->gpt->completion([
            'model' => $this->model,
            'prompt' => $message ?? $this->message,
            'temperature' => $this->temperature,
            'max_tokens' => $this->maxTokens,
            'frequency_penalty' => $this->frequencyPenalty,
            'presence_penalty' => $this->presencePenalty,
        ]);
    }
}
