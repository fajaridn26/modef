<div
    style="max-width: width auto; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background: #f7f7f7; border-radius: 10px; text-align: center;">

    <h3 style="margin-bottom: 10px; font-size: 22px; color: #333;">Halo</h3>

    <p style="font-size: 14px; color: #555; line-height: 22px; margin-bottom: 25px;">
        Kami menerima permintaan untuk mereset password akun Anda.
        Jika Anda yang mengajukan permintaan ini, silakan klik tombol di bawah ini untuk melanjutkan:
    </p>

    <a href="{{ route('validation-forgot-password', ['token' => $token]) }}"
        style="display: inline-block; padding: 12px 24px; background-color: #4f46e5; color: #fff; text-decoration: none; border-radius: 6px; font-size: 15px; font-weight: bold; margin-bottom: 25px;">
        Reset Password
    </a>

    <p style="font-size: 13px; color: #666; line-height: 20px; margin-top: 20px;">
        {{-- Tautan ini hanya berlaku selama <strong>1 menit</strong>.<br><br> --}}
        Jika Anda tidak merasa meminta reset password, abaikan email ini — akun Anda tetap aman.
    </p>

    <p style="font-size: 13px; color: #444; margin-top: 20px;">
        Terima kasih,<br>
        <strong>Tim Support</strong>
    </p>

</div>
