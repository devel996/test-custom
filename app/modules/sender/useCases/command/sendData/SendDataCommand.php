<?php

declare(strict_types=1);

namespace app\modules\sender\useCases\command\sendData;

class SendDataCommand
{
    private string $data;

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = htmlspecialchars($data, ENT_QUOTES);
    }
}