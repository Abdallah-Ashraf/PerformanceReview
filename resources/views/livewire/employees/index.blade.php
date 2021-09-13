<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>
    <div >
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!--  flash Message -->
            <div class="mt-10  mx-auto sm:mt-0  " id="alert">
                @if (session()->has('message'))
                    <div class="alert alert-success" >
                        <div style="background-color: #92ffc8;" class=" bg-green-100 border-t-4 border-white-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"></div>
                                <div>
                                    <p class="font-bold"><i class="fas fa-info-circle"></i> {{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Employee form  -->
            <div class="mt-10 py-4  mx-auto sm:mt-0">


                <x-jet-form-section  submit="{{$action}}"  >
                    <x-slot name="title">
                        {{ __('Manage Employees') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Admin user can create,view,update,delete employee users.') }}
                    </x-slot>



                    <x-slot name="form">


                    <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="employee.name" autocomplete="name" />
                           @error('employee.name') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>

                        <!-- email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="email" value="{{ __('email') }}" />
                            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="employee.email" />
                            @error('employee.email') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>
                        <!-- paasword -->
                        @if($action == 'updateEmployee')
                            <div class="col-span-6 sm:col-span-4">

                                <span style="background-color: #ffdcdc;" class="p-2 rounded  text-sm"><i class="fas fa-exclamation-triangle"></i> {{__('Write new password if want to change or leave it empty. ')}}</span>

                            </div>
                        @endif
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="password" value="{{ __('New Password') }}" />
                            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="employee.password" autocomplete="new-password" />
                            @error('employee.password') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>
                        <!-- password confirmation-->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="employee.password_confirmation" autocomplete="new-password" />
                            @error('employee.password_confirmation') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>


                    </x-slot>

                    <x-slot name="actions">


                        <x-jet-button wire:loading.attr="disabled" >
                            {{ __('Save') }}
                        </x-jet-button>
                    </x-slot>
                </x-jet-form-section>
            </div>

            <!-- Manage API Tokens -->
            @include('livewire.employees.employees-data',['allEmployees','allEmployees'])
        </div>



        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                Livewire.hook('element.updated', (el, component) => {
                    setTimeout(function() {
                        document.getElementById('alert').style.display = 'none';
                    }, 3000);

                })
            });


            window.addEventListener('employee-edit', event => {
                const El = document.getElementById('alert');

                // Lets say you wish to scroll by 100px,
                El.scrollIntoView({behavior: "smooth", block: "start", inline: "start"});

            })


        </script>

    </div>

</div>


