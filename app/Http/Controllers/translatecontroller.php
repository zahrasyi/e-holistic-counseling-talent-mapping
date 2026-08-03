use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

public function translate(Request $request)
{
    $textAsli = $request->input('text');

    // Memanggil API OpenAI dari Backend (Aman!)
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-3.5-turbo', // Bisa diganti gpt-4o-mini biar lebih murah & pintar
        'messages' => [
            [
                'role' => 'system',
                'content' => 'Anda adalah penerjemah ahli. Terjemahkan teks berikut ke bahasa Inggris. Jaga struktur paragrafnya agar tetap sama. JANGAN menambahkan teks penjelasan apapun, cukup berikan hasil terjemahannya saja.'
            ],
            [
                'role' => 'user',
                'content' => $textAsli
            ]
        ],
    ]);

    $hasil = $response->json();
    return response()->json([
        'translated_text' => $hasil['choices'][0]['message']['content'] ?? 'Gagal menerjemahkan.'
    ]);
}