<?php

use Livewire\Volt\Component;
use App\Models\EmployeeRecords;

new class extends Component {

    public $firstName;
    public $lastName;
    public $gender;
    public $birthday;
    public $monthlySalary;
    public $failNotif = false;
    public $successNotif = false;
    public $id;
    public $isValidId = true;

    protected $rules = [
        'firstName' => 'required|alpha_dash:ascii',
        'lastName' => 'required|alpha_dash:ascii',
        'birthday' => 'required|date',
        'monthlySalary' => 'required|numeric'
    ];

    protected $queryString = ['id'];

    protected $listeners = ['deleteUser'];

    public function mount(){

        $employee = EmployeeRecords::find($this->id);
        if($employee){
            $employee = EmployeeRecords::find($this->id);
            $this->firstName = $employee->firstName;
            $this->lastName = $employee->lastName;
            $this->gender = $employee->gender;
            $this->birthday = $employee->birthday;
            $this->monthlySalary = $employee->monthlySalary;
            $this->isValidId = true;
        }else{
            $this->isValidId = false;
        }

    }

    public function submit(){
        $this->validate();
        $this->failNotif = false;
        $this->successNotif = false;
        try {
            $employee = EmployeeRecords::find($this->id);
            $employee->firstName = $this->firstName;
            $employee->lastName = $this->lastName;
            $employee->gender = $this->gender;
            $employee->birthday = $this->birthday;
            $employee->monthlySalary = $this->monthlySalary;
            $employee->save();

            $this->successNotif = true;
        } catch (\Throwable $th) {
            $this->failNotif = true;
        }

    }

    public function deleteEmployee(){
        $employee = EmployeeRecords::find($this->id);

        if($employee){
            $employee->delete();
            return redirect("/employee-records");
        }
    }

    public function cancel(){
        return redirect('/employee-records');
    }

}; ?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Employee Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col pl-32">
                <div class="flex justify-end">
                    <button class="bg-red-700 text-white hover:bg-red-600 rounded-lg p-2 m-5" {{($this->isValidId == false) ? 'disabled' : ''}} onclick="confirm('Are you sure you want to delete this employee?') || event.stopImmediatePropagation()" wire:click="deleteEmployee">Delete Employee </button>
                </div>
                @if(!$this->isValidId) <span class="text-xs text-red-500 p-2">Invalid Id Parameter</span> @endif
                <div class="flex">
                    <div class='flex flex-col pt-5 pr-5'>
                        <div><label class='text-xs'>First Name</label></div>
                        <input type="text" id="firstName" wire:model="firstName" placeholder='First Name' class="rounded-lg w-80 max-w-md"/>
                        @error('firstName') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class='flex flex-col pt-5'>
                        <div><label class='text-xs'>Last Name</label></div>
                        <input type="text" id="lastName" wire:model="lastName" placeholder='Last Name' class="rounded-lg w-80 max-w-md"/>
                        @error('lastName') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex">
                    <div class='flex flex-col pt-5 pr-5'>
                        <div><label class='text-xs'>Gender</label></div>
                        <select id="gender" wire:model="gender" placeholder='Gender' class="rounded-lg w-48 max-w-md">
                            <option value = "Male">Male</option>
                            <option value = "Female">Female</option>
                        </select>
                    </div>
                    <div class='flex flex-col pt-5'>
                        <div><label class='text-xs'>Birthday</label></div>
                        <input type="date" id="birthday" wire:model="birthday" placeholder='Birthday' class="rounded-lg w-48 max-w-md"/>
                        @error('birthday') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class='flex flex-col p-5'>
                        <div><label class='text-xs'>Monthly Salary</label></div>
                        <input type="number" step="0.01" id="monthlySalary" wire:model="monthlySalary" placeholder='0.00' class="rounded-lg w-60 max-w-md"/>
                        @error('monthlySalary') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="pr-10">
                        <button wire:click="submit" class="p-3 rounded-lg mb-5 bg-slate-400 hover:bg-slate-300">Update</button>
                        <button wire:click="cancel" class="p-3 rounded-lg mb-5 bg-red-300 hover:bg-red-200">Back</button>
                    </div>
                    <div>
                        @if ($this->failNotif)
                            <span class='text-red-500'>There was a problem in editing the employee</span>
                        @endif
                        @if($this->successNotif)
                            <span class='text-green-400'>Employee Details Successfully Edited</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
