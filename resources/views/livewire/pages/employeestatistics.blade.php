<?php

use Livewire\Volt\Component;
use App\Models\EmployeeRecords;
use Carbon\Carbon;

new class extends Component {
    public $maleEmployees;
    public $femaleEmployees;
    public $averageAge;
    public $totalMonthlySalary;


    public function getMaleEmployees(){
        $this->maleEmployees = EmployeeRecords::where('gender', 'Male')->get()->count();
    }

    public function getFemaleEmployees(){
        $this->femaleEmployees = EmployeeRecords::where('gender', 'Female')->get()->count();
    }

    public function getAverageAge(){
        $employeeRecords = EmployeeRecords::all();
        if($employeeRecords){
            $totalEmployees = $employeeRecords->count();
            $sumAgeOfEmployees = 0;
            foreach($employeeRecords as $employeeRecord){
                $sumAgeOfEmployees += Carbon::now()->diffInYears($employeeRecord->birthday);
            }
            $this->averageAge = ($sumAgeOfEmployees/$totalEmployees);
        }else{
            $this->averageAge = 0;
        }
    }

    public function getTotalMonthlySalary(){
        $this->totalMonthlySalary = EmployeeRecords::sum('monthlySalary');
    }

    public function mount(){
        $this->getMaleEmployees();
        $this->getFemaleEmployees();
        $this->getAverageAge();
        $this->getTotalMonthlySalary();
    }



}; ?>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Employee Statistics') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-slate-200 overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-items-center items-center">

            <div class="flex">
                <div class="border-2 bg-white shadow-md rounded-lg p-6 m-6 flex flex-col items-center">
                    <h4>Total number of Male Employees</h4>
                    <div class="font-bold text-xl">{{$this->maleEmployees}}</div>
                </div>
                <div class="border-2 bg-white shadow-md rounded-lg p-6 m-6 flex flex-col items-center">
                    <h4>Total number of Female Employees</h4>
                    <div class="font-bold text-xl">{{$this->femaleEmployees}}</div>
                </div>
            </div>
            <div class="flex">
                <div class="border-2 bg-white shadow-md rounded-lg p-6 m-6 flex flex-col items-center">
                    <h4>Average Age of all employees</h4>
                    <div class="font-bold text-xl">{{$this->averageAge}}</div>
                </div>
                <div class="border-2 bg-white shadow-md rounded-lg p-6 m-6 flex flex-col items-center">
                    <h4>Total monthly salary of all employees</h4>
                    <div class="font-bold text-xl">{{$this->totalMonthlySalary}}</div>
                </div>
            </div>

        </div>
    </div>
</div>
