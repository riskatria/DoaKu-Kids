<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Favorite;
use App\Models\MemorizationList;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_has_many_favorites_relation(): void
    {
        $user = User::factory()->create();

        Favorite::create([
            'user_id'      => $user->id,
            'prayer_id'    => '1',
            'prayer_title' => 'Doa Sebelum Makan',
        ]);

        Favorite::create([
            'user_id'      => $user->id,
            'prayer_id'    => '2',
            'prayer_title' => 'Doa Sebelum Tidur',
        ]);

        $this->assertCount(2, $user->favorites);
        $this->assertInstanceOf(Favorite::class, $user->favorites->first());
    }

    /** @test */
    public function user_has_many_memorizations_relation(): void
    {
        $user = User::factory()->create();

        MemorizationList::create([
            'user_id'      => $user->id,
            'prayer_id'    => '1',
            'prayer_title' => 'Doa Sebelum Makan',
            'status'       => 'belum_mulai',
        ]);

        $this->assertCount(1, $user->memorizations);
        $this->assertInstanceOf(MemorizationList::class, $user->memorizations->first());
    }

    /** @test */
    public function user_fillable_attributes_are_correct(): void
    {
        $user = new User();
        $fillable = $user->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('email', $fillable);
        $this->assertContains('password', $fillable);
    }

    /** @test */
    public function user_password_is_hashed_on_creation(): void
    {
        $user = User::factory()->create(['password' => 'plaintext123']);

        $this->assertNotEquals('plaintext123', $user->password);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('plaintext123', $user->password));
    }
}
