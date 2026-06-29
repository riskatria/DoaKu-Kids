<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoriteModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function favorite_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $favorite = Favorite::create([
            'user_id'      => $user->id,
            'prayer_id'    => '1',
            'prayer_title' => 'Doa Sebelum Makan',
        ]);

        $this->assertInstanceOf(User::class, $favorite->user);
        $this->assertEquals($user->id, $favorite->user->id);
    }

    /** @test */
    public function favorite_fillable_fields_are_correct(): void
    {
        $fav = new Favorite();
        $fillable = $fav->getFillable();

        $this->assertContains('user_id', $fillable);
        $this->assertContains('prayer_id', $fillable);
        $this->assertContains('prayer_title', $fillable);
    }
}
