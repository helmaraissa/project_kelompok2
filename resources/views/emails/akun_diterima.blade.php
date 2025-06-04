@component('mail::message')
# Halo, {{ $nama }}

Selamat! Pendaftaran ekstrakurikuler Anda telah diterima.

Berikut informasi akun Anda untuk login:

- Username: **{{ $username }}**  
- Password: **{{ $password_plain }}**

Silakan login dan ubah password Anda setelah masuk.

Terima kasih.

Salam,  
Tim Ekstrakurikuler
@endcomponent
