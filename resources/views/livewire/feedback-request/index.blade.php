<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback Requests') }}
        </h2>
    </x-slot>
    <div >
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-10">
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
            @if($action == 'submitFeedback')
                <!-- Employee form  -->
                <div class="mt-10 py-4  mx-auto sm:mt-0">


                <x-jet-form-section  submit="{{$action}}"  >
                    <x-slot name="title">
                        {{ __('Manage Feedback Requests') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('The reviewer can submit feedback for each pending feedback request.') }}
                    </x-slot>



                    <x-slot name="form">


                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" readonly="readonly" type="text" class="mt-1 block w-full" wire:model.defer="review.name" autocomplete="name" />
                            @error('review.name') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>

                        <!-- description -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <textarea readonly="readonly" id="description" rows="7" class="form-textarea border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="review.description" >
                            </textarea>
                            @error('review.description') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>

                        <!-- reviewer -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="reviewer_id" value="{{ __('Reviewer') }}" />
                            <x-jet-input type="text" readonly="readonly" class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="review.reviewer_name" />
                            @error('review.reviewer_id') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>

                        <!-- reviewee -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="reviewee" value="{{ __('Reviewees') }}" />
                            <x-jet-input type="text" id="reviewee" readonly="readonly" class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="review.reviewee" />

                        </div>

                        <!-- description -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="feedback" value="{{ __('Feedback') }}" />
                            <textarea  id="feedback" rows="7" class="form-textarea border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="review.feedback" >
                            </textarea>
                            @error('review.feedback') <span class="text-red-500 text-sm">{{$message}}</span>@enderror
                        </div>




                    </x-slot>

                    <x-slot name="actions">


                        <x-jet-button wire:loading.attr="disabled" >
                            {{ __('Save') }}
                        </x-jet-button>
                    </x-slot>
                </x-jet-form-section>
            </div>
            @endif

            <!-- Manage API Tokens -->
            @include('livewire.feedback-request.feedback-request-data',['allReviews','allReviews'])
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
