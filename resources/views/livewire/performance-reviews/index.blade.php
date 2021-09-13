<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Performance Reviews') }}
        </h2>
    </x-slot>
    <div >
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!--  flash Message -->
            <div class="mt-10  mx-auto sm:mt-0 " id="alert">
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
                        {{ __('Manage Performance Reviews') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Admin user can create/view/update performance review with the ability to assign reviewees and reviewers.') }}
                    </x-slot>



                    <x-slot name="form">


                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="review.name" autocomplete="name" />
                            @error('review.name') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>

                        <!-- description -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <textarea id="description" rows="7" class="form-textarea border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="review.description" >
                            </textarea>
                            @error('review.description') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>

                        <!-- reviewer -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="reviewer_id" value="{{ __('Reviewer') }}" />
                            <select id="reviewer_id" rows="7" class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="review.reviewer_id" >
                                <option>{{__('select reviewer')}}</option>
                                @foreach($allEmployees as $emp)
                                    <option value="{{$emp->id}}">{{$emp->name}}</option>
                                @endforeach
                            </select>
                            @error('review.reviewer_id') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>

                        <!-- reviewee -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="reviewee" value="{{ __('Reviewees') }}" />
                            <select multiple id="reviewer_id" rows="7" class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="review.reviewee" >
                                <option>{{__('select reviewee')}}</option>
                                @foreach($allEmployees as $emp)
                                    <option value="{{$emp->id}}">{{$emp->name}}</option>
                                @endforeach
                            </select>
                            @error('review.reviewer_id') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
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
            @include('livewire.performance-reviews.performance-reviews-data',['allReviews','allReviews'])
        </div>



        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                Livewire.hook('element.updated', (el, component) => {
                    setTimeout(function() {
                        document.getElementById('alert').style.display = 'none';
                    }, 3000);

                })
            });


            window.addEventListener('review-edit', event => {
                const El = document.getElementById('alert');
                // Lets say you wish to scroll by 100px,
                El.scrollIntoView(true);


            })


        </script>

    </div>

</div>


