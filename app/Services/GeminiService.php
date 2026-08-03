<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent';
    protected string $systemInstruction =
    "Anda adalah 'TemanCurhat', asisten konseling AI yang suportif, empatik, dan non-judgmental untuk sistem e-counseling universitas. Tujuan utama Anda adalah memberikan dukungan emosional awal, membantu mahasiswa merumuskan masalah mereka, dan memberikan informasi umum yang positif.
    Aturan WAJIB Anda:
    1. JANGAN PERNAH memberikan diagnosis medis atau psikologis.
    2. JANGAN PERNAH memberikan saran medis.
    3. Selalu sarankan mahasiswa untuk berbicara dengan konselor profesional manusia untuk masalah yang mendalam atau serius. Kalimat anjuran: 'Untuk pembahasan lebih lanjut mengenai hal ini, sangat disarankan untuk membuat janji temu dengan konselor profesional kita.'
    4. Gunakan bahasa Indonesia yang ramah, positif, dan mudah dimengerti.
    5. Batasi SEMUA jawaban Anda secara singkat, tidak lebih dari 5 kalimat.";

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->apiKey = config('gemini.api_key');
    }

    public function chat(array $conversationHistory): string
    {
        $contents = collect($conversationHistory)->map(function ($message) {
            return [
                'role' => $message['role'],
                'parts' => [['text' => $message['text']]]
            ];
        })->values()->all();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
            ->post($this->baseUrl . '?key=' . $this->apiKey, [
                'contents' => $contents,
                'system_instruction' => [
                    'parts' => [
                        ['text' => $this->systemInstruction]
                    ]
                ]
            ]);

        // dd($response->json(), $response->status());
        if ($response->failed()) {
            return 'Maaf, terjadi kesalahan saat menghubungi asisten AI.';
        }

        $responseText = $response->json('candidates.0.content.parts.0.text');

        return $responseText ?? 'Maaf, saya tidak bisa memberikan jawaban saat ini.';
    }

    public function analyzeRefleksiBatch(array $refleksis): ?array
    {
        // 🔹 Susun prompt lengkap untuk analisis refleksi Islami
        $prompt = "
            Anda adalah 'TemanCurhat', asisten konseling AI yang suportif dan Islami.

            Analisis 10 refleksi berikut dari sisi makna emosional dan spiritual Islami.

            Langkah-langkah analisis:
            1. Ambil 3 kata kunci yang paling mewakili isi refleksi.
            2. Rumusan Skor Refleksi Pribadi:
            • Jawaban Negatif (kata kunci negatif): Skor 1
            • Jawaban Netral / Tidak jelas (campuran positif & negatif): Skor 2
            • Jawaban Positif (kata kunci positif): Skor 3
            3. Tentukan apakah refleksi bernada positif, negatif, atau campuran/netral.
            4. Berikan hasil dalam format JSON valid berikut (tanpa tambahan penjelasan atau teks lain di luar JSON):

            {
            \"1\": {\"keywords\": [\"kata1\", \"kata2\", \"kata3\"], \"kategori\": \"positif | negatif | netral\", \"score\": 1/2/3},
            \"2\": {\"keywords\": [\"kata1\", \"kata2\", \"kata3\"], \"kategori\": \"positif | negatif | netral\", \"score\": 1/2/3},
            ...
            }

            Berikut daftar refleksi yang perlu dianalisis:
            ";

        foreach ($refleksis as $i => $r) {
            $prompt .= "\n$i. $r";
        }

        // 🔹 Kirim ke Gemini
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '?key=' . $this->apiKey, [
            'contents' => [[
                'role' => 'user',
                'parts' => [['text' => $prompt]]
            ]],
            'system_instruction' => [
                'parts' => [['text' => $this->systemInstruction]]
            ]
        ]);

        if ($response->failed()) {
            return null;
        }

        $text = $response->json('candidates.0.content.parts.0.text');
        $text = trim($text);

        // 🔹 Ambil bagian JSON-nya saja (kadang Gemini nambah kalimat di luar JSON)
        $jsonStart = strpos($text, '{');
        $jsonEnd = strrpos($text, '}');
        if ($jsonStart !== false && $jsonEnd !== false) {
            $jsonString = substr($text, $jsonStart, $jsonEnd - $jsonStart + 1);
            $decoded = json_decode($jsonString, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
        }

        return null;
    }
}