<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6 px-8">

        {{-- Stats Cards --}}
        <div class="grid grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded shadow p-5 text-center">
                <p class="text-sm text-gray-500">Total Vehicles</p>
                <p class="text-3xl font-bold text-blue-900">{{ $totalVehicles }}</p>
            </div>
            <div class="bg-white rounded shadow p-5 text-center">
                <p class="text-sm text-gray-500">Available Cars</p>
                <p class="text-3xl font-bold text-green-600">{{ $availableCars }}</p>
            </div>
            <div class="bg-white rounded shadow p-5 text-center">
                <p class="text-sm text-gray-500">Rented Cars</p>
                <p class="text-3xl font-bold text-yellow-500">{{ $rentedCars }}</p>
            </div>
            <div class="bg-white rounded shadow p-5 text-center">
                <p class="text-sm text-gray-500">Total Customers</p>
                <p class="text-3xl font-bold text-blue-900">{{ $totalCustomers }}</p>
            </div>
        </div>

        {{-- Recent Rentals --}}
        <div class="bg-white rounded shadow">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-bold">Recent Rentals</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Vehicle</th>
                            <th class="px-6 py-3">Rent Date</th>
                            <th class="px-6 py-3">Return Date</th>
                            <th class="px-6 py-3">Total</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRentals as $rental)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $rental->customer->full_name }}</td>
                            <td class="px-6 py-3">{{ $rental->vehicle->brand }} {{ $rental->vehicle->model }}</td>
                            <td class="px-6 py-3">{{ $rental->rent_date }}</td>
                            <td class="px-6 py-3">{{ $rental->return_date }}</td>
                            <td class="px-6 py-3">₱{{ number_format($rental->total_amount, 2) }}</td>
                            <td class="px-6 py-3">
                                @if($rental->status === 'Ongoing')
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Ongoing</span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Returned</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-400">No rentals yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>