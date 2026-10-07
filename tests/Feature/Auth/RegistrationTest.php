<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_renders_with_sipinjam_branding(): void
    {
        $this->get('/register')
            ->assertOk()
            ->assertSee('Logo SIPINJAM')
            ->assertSee('Nama lengkap')
            ->assertSee('Email sekolah')
            ->assertSee('Konfirmasi kata sandi')
            ->assertSee('action="' . route('register') . '"', false);
    }

    public function test_registration_rejects_missing_fields_and_invalid_email(): void
    {
        $this->post('/register', [])
            ->assertSessionHasErrors(['name', 'email', 'password']);

        $this->post('/register', [
            'name' => 'Siswa Uji',
            'email' => 'not-an-email',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
        ])->assertSessionHasErrors('email');
    }

    public function test_registration_rejects_duplicate_email_and_weak_or_mismatched_password(): void
    {
        $existingUser = User::factory()->create(['email' => 'siswa@example.test']);
        $this->assertNotNull($existingUser->id);

        $this->post('/register', [
            'name' => 'Siswa Uji',
            'email' => 'siswa@example.test',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
        ])->assertSessionHasErrors('email');

        $this->post('/register', [
            'name' => 'Siswa Uji',
            'email' => 'baru@example.test',
            'password' => 'short',
            'password_confirmation' => 'short',
        ])->assertSessionHasErrors('password');

        $this->post('/register', [
            'name' => 'Siswa Uji',
            'email' => 'baru@example.test',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'DifferentPass123!',
        ])->assertSessionHasErrors('password');
    }

    public function test_registration_creates_a_hashed_student_account_and_authenticates_it(): void
    {
        $response = $this->post('/register', [
            'name' => 'Siswa Baru',
            'email' => 'siswa.baru@example.test',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
        ]);

        $user = User::where('email', 'siswa.baru@example.test')->firstOrFail();

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
        $this->assertSame('siswa', $user->role);
        $this->assertTrue(Hash::check('StrongPass123!', $user->password));
    }
}
