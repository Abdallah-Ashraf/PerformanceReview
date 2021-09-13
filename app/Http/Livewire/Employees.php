<?php

namespace App\Http\Livewire;

use App\Http\Requests\CreateEmployeeRequest;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;
    public $employee =[
        'name'=>'',
        'password'=>'',
        'email'=>'',
        'password_confirmation'=>''
    ];
    public $action = 'saveEmployee';
    public $employeeId;



    protected $validationAttributes = [
        'employee.name' => 'Name',
        'employee.password' => 'Password',
        'employee.email' => 'Email',
        'employee.password_confirmation' => 'Password Confirmation',
    ];





    public function saveEmployee(UserRepositoryInterface $userRepository){
        $this->validate();
        $userRepository->create($this->employee);
        $this->employee =[
            'name'=>'',
            'password'=>'',
            'email'=>'',
            'password_confirmation'=>''
        ];
        session()->flash('message', 'Employee Data Saved successfully.');
        $this->dispatchBrowserEvent('employee-edit');

    }


    public function editEmployee(UserRepositoryInterface $userRepository,$id){
        $user=$userRepository->find($id);
        $this->employeeId = $id;
        $this->employee['name'] = $user->name;
        $this->employee['email'] = $user->email;
        $this->action = 'updateEmployee';
        $this->dispatchBrowserEvent('employee-edit');
    }

    public function updateEmployee(UserRepositoryInterface $userRepository){
        $this->validate();
        $data['name'] = $this->employee['name'];
        $data['email'] = $this->employee['email'];
        if(!empty($this->employee['password'])){
            $data['password'] = $this->employee['password'];
        }

        $res=$userRepository->update($this->employeeId,$data);

        $this->action = 'saveEmployee';
        $this->employeeId = null;
        $this->employee =[
            'name'=>'',
            'password'=>'',
            'email'=>'',
            'password_confirmation'=>''
        ];
        session()->flash('message', 'Employee Data Updated successfully.');
        $this->dispatchBrowserEvent('employee-edit');
    }



    public function deleteEmployee(UserRepositoryInterface $userRepository,$id){
        $user = $userRepository->delete($id);
        session()->flash('message', 'Employee Deleted successfully.');
        $this->dispatchBrowserEvent('employee-edit');
    }

    public function render(UserRepositoryInterface $userRepository)
    {
        $allEmployees = $userRepository->paginate(2,[
            'is_admin'=>false
        ]);
        return view('livewire.employees.index',compact('allEmployees'));
    }

    protected function rules()
    {
        if($this->action == 'saveEmployee') {
            return [
                'employee.name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                'employee.email' => 'required|email|unique:users,email',
                'employee.password' => 'required|min:8|confirmed',
            ];
        }else{
            return [
                'employee.name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                'employee.email' => 'required|email|unique:users,email,'.$this->employeeId,
                'employee.password' => 'min:8|confirmed',
            ];
        }
    }
}
