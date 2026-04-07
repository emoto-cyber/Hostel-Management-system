@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Payments Records
        </h2>

        {{-- <a href="{{ route('hostel.create')  }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            Payments
        </a> --}}
    </div>
     {{-- Search Section --}}
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('payment.index') }}" class="flex flex-wrap gap-4 items-center">

            {{-- Search Records --}}
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search hostel"
                   class="border rounded-md px-3 py-2 w-64 focus:ring focus:ring-indigo-200">

            {{-- Search Month --}}
            <input type="month"
                   name="month"
                   value="{{ request('month') }}"
                   class="border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200">

            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Search
            </button>

            <a href="{{ route('payment.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Reset
            </a>
              <a href="{{ route('hostel.create')  }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            Payments
        </a>

        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">#</th>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">Admission No/ID</th>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">Tenant Name</th>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">Contact</th>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">Hostel</th>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">Room Booked</th>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">Amount</th>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-large text-dark-600">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($payments as $payment)
                    <tr>
                        <td class="px-6 py-4">{{$loop->iteration}}</td>
                        <td class="px-6 py-4">{{ $payment->user->adm_no }}</td>
                        {{-- <td class="px-6 py-4">{{ $payment->user->contact }}</td> --}}
                        <td class="px-6 py-4">{{ $payment->user->name }}</td>
                        <td class="px-6 py-4">{{ $payment->user->contact }}</td>
                        <td class="px-6 py-4">{{ $payment->room->hostel->name }}</td>
                        <td class="px-6 py-4">{{ $payment->room->room_number }}</td>
                        <td class="px-6 py-4">{{ $payment->amount }}</td>
                        <td class="px-6 py-4">{{ $payment->status}}</td>


                        {{-- Actions --}}
                        <td class="px-6 py-4 space-x-2 whitespace-nowrap">

                            {{-- View --}}
                            {{-- <a href="{{ route('hostels.show', $hostel->id) }}"
                               class="text-blue-600 hover:underline">
                                View
                            </a> --}}

                            {{-- Edit --}}
                            {{-- <a href="{{ route('hostels.edit', $hostel->id) }}"
                               class="text-indigo-600 hover:underline">
                                Edit
                            </a> --}}

                            {{-- Delete --}}
                            <form action="#"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this hostel?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No payments Available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
