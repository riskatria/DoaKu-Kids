<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\MemorizationList;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemorizationListModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function memorization_list_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $memo = MemorizationList::create([
            'user_id'      => $user->id,
            'prayer_id'    => '1',
            'prayer_title' => 'Doa Sebelum Makan',
            'status'       => 'belum_mulai',
        ]);

        $this->assertInstanceOf(User::class, $memo->user);
        $this->assertEquals($user->id, $memo->user->id);
    }

    /** @test */
    public function memorization_list_fillable_fields_are_correct(): void
    {
        $memo = new MemorizationList();
        $fillable = $memo->getFillable();

        $this->assertContains('user_id', $fillable);
        $this->assertContains('prayer_id', $fillable);
        $this->assertContains('prayer_title', $fillable);
        $this->assertContains('status', $fillable);
    }

    /** @test */
    public function memorization_list_uses_correct_table(): void
    {
        $memo = new MemorizationList();
        $this->assertEquals('memorization_lists', $memo->getTable());
    }
}
