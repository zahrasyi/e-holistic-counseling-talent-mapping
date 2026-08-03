@php
    $status = $meeting->status ?? 'pending';
@endphp

@if ($status === 'pending')
    <div class="flex items-center justify-center">
        <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div> Pending
    </div>
@elseif ($status === 'approved')
    <div class="flex items-center justify-center">
        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> approved
    </div>
@elseif ($status === 'rejected')
    <div class="flex items-center justify-center">
        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Rejected
    </div>
@elseif ($status === 'completed')
    <div class="flex items-center justify-center">
        <div class="h-2.5 w-2.5 rounded-full bg-blue-500 me-2"></div> Completed
    </div>
@elseif ($status === 'reschedule_pending')
    <div class="flex items-center justify-center">
        <div class="h-2.5 w-2.5 rounded-full bg-orange-500 me-2"></div> Reschedule Pending
    </div>
@elseif ($status === 'counselor_reschedule')
    <div class="flex items-center justify-center">
        <div class="h-2.5 w-2.5 rounded-full bg-lime-500 me-2"></div> Reschedule Pending
    </div>
@else
    <div class="flex items-center justify-center">
        <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2"></div> {{ ucfirst($status) }}
    </div>
@endif
