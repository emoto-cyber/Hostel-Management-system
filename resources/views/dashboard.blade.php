<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hostel Management Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- MAIN PROGRESS -->
       <div
    class="bg-green-600 h-6 rounded-full text-white text-sm text-center"
    style="width: {{ $bookingPercentage ?? 0 }}%">
    {{ $bookingPercentage ?? 0 }}%
</div>


                <div class="flex justify-between mt-2 text-sm text-gray-600">

                    <span>Booked: #</span>
                    <span>Vacant: $data['totalvacant']</span>
                    <span>Total Rooms: #</span>
                </div>
                
            </div>

            <!-- STAT CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Booked Rooms -->
                <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Booked Rooms</p>
                        <p class="text-3xl font-bold text-green-600">#</p>
                    </div>
                    <div class="text-green-600">
                        <!-- Bed Icon -->
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 10h18M5 10V7a2 2 0 012-2h4a2 2 0 012 2v3M5 14v6M19 14v6" />
                        </svg>
                    </div>
                </div>

                <!-- Vacant Rooms -->
                <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Vacant Rooms</p>
                        <p class="text-3xl font-bold text-yellow-500">#</p>
                    </div>
                    <div class="text-yellow-500">
                        <!-- Door Icon -->
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M8 3h8v18H8zM12 12h.01" />
                        </svg>
                    </div>
                </div>

                <!-- Total Paid -->
                <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Paid</p>
                        <p class="text-2xl font-bold text-purple-600">
                            {{-- KES {{ number_format($totalPaid) }} --}}
                        </p>
                    </div>
                    <div class="text-purple-600">
                        <!-- Money Icon -->
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 8c-3.866 0-7 1.79-7 4s3.134 4 7 4
                                     7-1.79 7-4-3.134-4-7-4z"/>
                            <path d="M5 12v4c0 2.21 3.134 4 7 4s7-1.79 7-4v-4"/>
                        </svg>
                    </div>
                </div>

                <!-- Monthly Growth -->
                <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Payment Growth</p>
                        {{-- <p class="text-2xl font-bold {{ $paymentGrowth >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $paymentGrowth }}% --}}
                        </p>
                        <p class="text-xs text-gray-400">
                            This month vs last month
                        </p>
                    </div>
                    {{-- <div class="{{ $paymentGrowth >= 0 ? 'text-green-600' : 'text-red-600' }}"> --}}
                        <!-- Chart Icon -->
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 3v18h18"/>
                            <path d="M7 14l4-4 4 3 5-7"/>
                        </svg>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
