<div class="hidden sm:block">
    <div class="py-2">
        <div class="border-t border-gray-400"></div>
    </div>
</div>

<!-- Manage API Tokens -->
<div class="mt-10  mx-auto sm:mt-0 ">
    <div class="md:grid md:grid-cols-6 md:gap-12">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <!-- API Token List -->
            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">

                <div class="space-y-6">
                    <table class="border-separate w-full border-2 border-gray-700 ">
                        <thead>
                        <tr>
                            <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow  ">Name</th>
                            <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow ">Description</th>
                            <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow ">Status</th>
                            <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow  ">Reviewer</th>
                            <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow  ">Reviewees</th>
                            <th class="border-2 border-gray-700 px-4 py-2 text-emerald-800 text-left font-flow  ">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(count($allReviews)>0)
                            @foreach ($allReviews as $emp)
                            <tr>
                                <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400  ">{{$emp->name}}</td>
                                <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 ">{{ substr($emp->description,0,40)}}
                                    @if(strlen($emp->description)>40) ... @endif</td>
                                <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 ">
                                    @if($emp->status == 'Open' )
                                        <span style="background-color: #a0e69b;" class="p-2 text-sm rounded shadow"><i class="fa fa-lock-open"></i> {{$emp->status}}</span>
                                    @else
                                        <span title="{{$emp->feedback}}" style="background-color: #e63232;" class="p-2 text-sm rounded shadow cursor-pointer"><i class="fa fa-lock"></i> {{$emp->status}}</span>
                                    @endif
                                </td>
                                <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 ">{{$emp->reviewer->name}}</td>
                                <td class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 ">
                                    @php $i=0; @endphp
                                    @foreach($emp->reviewees as $user)
                                        @if($i>0) , @endif
                                        {{$user->name}}
                                        @php $i++; @endphp
                                    @endforeach</td>
                                <td class="border border-gray-700 px-4 py-2 font-flow text-center text-emerald-400 " >
                                    @if($emp->status == 'Open' )
                                        <i class="fas fa-comments cursor-pointer" title="{{ __('Feedback') }}" wire:click="editReview({{ $emp->id }})"></i>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        @else
                            <td colspan="6" class="border border-gray-700 px-4 py-2 font-flow text-emerald-400 text-center ">
                              No records
                            </td>
                        @endif
                        </tbody>
                    </table>
                    {{ $allReviews->links() }}

                </div>


            </div>
        </div>
    </div>
</div>
