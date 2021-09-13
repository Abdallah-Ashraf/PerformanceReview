<?php

namespace Tests\Unit\Users;

use App\Http\Livewire\Employees;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;


class DeleteUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function can_delete_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);


        Livewire::test(Employees::class)
            ->call('deleteEmployee',$user->id)
            ->assertDispatchedBrowserEvent('employee-edit');

        $this->assertFalse(User::where('id',$user->id)->exists());
    }
}
