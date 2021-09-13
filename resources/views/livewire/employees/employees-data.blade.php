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
                        <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow ">Email</th>
                        <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow  ">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($allEmployees as $emp)
                        <tr>
                            <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400  ">{{$emp->name}}</td>
                            <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 ">{{$emp->email}}</td>
                            <td class="border border-gray-700 px-4 py-2 font-flow text-center text-emerald-400 " >

                                <i class="fas fa-edit cursor-pointer" title="{{ __('Edit') }}" wire:click="editEmployee({{ $emp->id }})"></i>
                                <i class="fas fa-trash cursor-pointer" title="{{ __('Delete') }}" wire:click="deleteEmployee({{ $emp->id }})"></i>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $allEmployees->links() }}

            </div>

        </x-slot>
    </x-jet-action-section>
</div>
