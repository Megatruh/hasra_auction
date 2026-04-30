<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Lelang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Buat Lelang</h1>
                    <p class="text-sm text-gray-600">Halaman ini masih placeholder (supaya route tidak error). Nanti bisa kita lanjutkan form lengkapnya.</p>
                </div>
                <a href="{{ route('host.dashboard') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">Kembali</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-start gap-3">
                    <svg class="h-6 w-6 text-indigo-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-4a1 1 0 00-1 1v3a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L11 9.586V7a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-semibold text-gray-900">Next step</p>
                        <p class="text-sm text-gray-600 mt-1">Kalau kamu mau, bilang error yang muncul kemarin atau mau form create lelangnya seperti apa (pilih mobil, start/end time, status, upload gambar, dll). Aku bisa rapihin UI + validasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
