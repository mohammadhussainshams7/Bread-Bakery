<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CardImport;

class CardImportService
{
    protected string $sheetId = '19IiPTliC8LhaBNj_oMgkIBa2vjoH4kS76k84lBH0UiM';

    public function import(): void
    {
        $url = $this->getExportUrl();

        $filePath = $this->downloadFile($url);

        Excel::import(new CardImport, $filePath);

        $this->cleanup($filePath);
    }

    protected function getExportUrl(): string
    {
        return "https://docs.google.com/spreadsheets/d/{$this->sheetId}/export?format=xlsx";
    }

    protected function downloadFile(string $url): string
    {
        $response = Http::get($url);

        if ($response->failed()) {
            throw new \Exception('Failed to download Google Sheet');
        }

        $fileName = 'imports/cards_' . now()->timestamp . '.xlsx';

        Storage::put($fileName, $response->body());

        return Storage::path($fileName);
    }

    protected function cleanup(string $filePath): void
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
