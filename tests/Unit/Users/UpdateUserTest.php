<?php

namespace Tests\Unit\Users;



use App\Http\Livewire\Employees;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test for view user data to edit .
     * @test
     * @return void
     */
    function can_edit_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(Employees::class)
            ->call('editEmployee',$user->id)
            ->assertSet('employee.email',$user->email)
            ->assertDispatchedBrowserEvent('employee-edit');
    }


    /**
     * A basic unit test for update user.
     * @test
     * @return void
     */
    function can_update_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);


        Livewire::test(Employees::class)
            ->call('updateEmployee')
            ->set('employeeId',$user->id)
            ->set('employee',[
                'name'=>'foo',
                'password'=>'',
                'email'=>'foo@gmail.com',
                'password_confirmation'=>''])
            ->assertSet('employee.name','foo')
            ->assertSet('employeeId',$user->id);

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
            ->call('updateEmployee')
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
            ->call('updateEmployee')
            ->assertHasErrors(['employee.email' => 'email']);



        Livewire::test(Employees::class)
            ->set('employee', [
                'name'=>'test',
                'password'=>'12345678',
                'email'=>$user->email,
                'password_confirmation'=>'12345678'
            ])
            ->call('updateEmployee')
            ->assertHasErrors(['employee.email' => 'unique']);
    }
}
