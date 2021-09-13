<?php

namespace Tests\Unit\Users;

use App\Http\Livewire\Employees;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;


class CreateUserTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic unit test for create user.
     * @test
     * @return void
     */
    function can_create_post()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'test',
                'password'=>'12345678',
                'email'=>'foo@gmail.com',
                'password_confirmation'=>'12345678'
            ])
            ->call('saveEmployee');

        $this->assertTrue(User::where('email','foo@gmail.com')->exists());
    }


    /**
     * unit test that Employee name validation passed
     * @test
     */
    function employee_name_is_valid()
    {
        $this->actingAs(User::factory()->create());
        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'',
                'password'=>'',
                'email'=>'',
                'password_confirmation'=>''
            ])
            ->call('saveEmployee')
            ->assertHasErrors(['employee.name' => 'required']);
    }


    /**
     * unit test that Employee Email validation passed
     * @test
     */
    function employee_email_is_valid()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'test',
                'password'=>'12345678',
                'email'=>'55555',
                'password_confirmation'=>'12345678'
            ])
            ->call('saveEmployee')
            ->assertHasErrors(['employee.email' => 'email']);

        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'',
                'password'=>'',
                'email'=>'',
                'password_confirmation'=>''
            ])
            ->call('saveEmployee')
            ->assertHasErrors(['employee.email' => 'required']);

        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'test',
                'password'=>'12345678',
                'email'=>$user->email,
                'password_confirmation'=>'12345678'
            ])
            ->call('saveEmployee')
            ->assertHasErrors(['employee.email' => 'unique']);
    }


    /**
     * unit test that Employee Password validation passed
     * @test
     */
    function employee_password_is_valid()
    {
        $this->actingAs(User::factory()->create());
        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'test',
                'password'=>'',
                'email'=>'55555',
                'password_confirmation'=>'12345678'
            ])
            ->call('saveEmployee')
            ->assertHasErrors(['employee.password' => 'required']);

        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'test',
                'password'=>'123456',
                'email'=>'55555',
                'password_confirmation'=>'12345678'
            ])
            ->call('saveEmployee')
            ->assertHasErrors(['employee.password' => 'min']);

        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'test',
                'password'=>'12345678',
                'email'=>'55555',
                'password_confirmation'=>'12345677'
            ])
            ->call('saveEmployee')
            ->assertHasErrors(['employee.password' => 'confirmed']);
    }
}
