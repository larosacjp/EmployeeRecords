<?php

use Livewire\Volt\Component;

new class extends Component {
    public function createRecord(){
        return redirect()->to("/create-employee-record");
    }
}; ?>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Employee Records') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col items-center mb-10">
            <button class="btn btn-primary p-3 m-3 text-white bg-slate-500 hover:bg-slate-400 rounded-lg" wire:click="createRecord">
                {{ __("Create an Employee Record") }}
            </button>
        </div>
        <livewire:tables.employee-records-table />
    </div>
</div>
