<div class="hidden sm:block">
    <div class="py-2">
        <div class="border-t border-gray-400"></div>
    </div>
</div>

<!-- Manage API Tokens -->
<div class="mt-10 sm:mt-0">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('') }}
        </x-slot>

        <x-slot name="description">
            {{ __('') }}
        </x-slot>

        <!-- API Token List -->
        <x-slot name="content">

            <div class="space-y-6">
                <table class="border-separate w-full border-2 border-gray-700 ">
                    <thead>
                    <tr>
                        <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow  ">Name</th>
                        <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow ">Description</th>
                        <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow ">Status</th>
                        <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow  ">Reviewer</th>
                        <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow  ">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($allReviews as $emp)
                        <tr>
                            <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400  ">{{$emp->name}}</td>
                            <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 ">{{ substr($emp->description,0,40)}}
                            @if(strlen($emp->description)>40) ... @endif</td>
                            <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 ">
                                @if($emp->status == 'Open' )
                                    <span style="background-color: #a0e69b; display: inline-flex;" class="p-2 text-sm rounded shadow"><i class="fa fa-lock-open"></i> {{$emp->status}}</span>
                                @else
                                    <span title="{{$emp->feedback}}" style="background-color: #e63232; display: inline-flex;" class="p-2 text-sm rounded shadow cursor-pointer"><i class="fa fa-lock"></i> {{$emp->status}}</span>
                                @endif
                            </td>
                            <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 ">{{$emp->reviewer->name}}</td>
                            <td class="border border-gray-700 px-4 py-2 font-flow text-center text-emerald-400 " >
                                @if($emp->status == 'Open' )
                                    <i class="fas fa-edit cursor-pointer" title="{{ __('Edit') }}" wire:click="editReview({{ $emp->id }})"></i>
                                    <i class="fas fa-trash cursor-pointer" title="{{ __('Delete') }}" wire:click="deleteReview({{ $emp->id }})"></i>
                                @endif


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $allReviews->links() }}

            </div>

        </x-slot>
    </x-jet-action-section>
</div>
