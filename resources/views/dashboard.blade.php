@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- TOP STATS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <x-stat-card title="Total Income" value="₱18,225" icon="bi-cash-stack" icon-color="text-blue-600"
        subtitle="This Month" />

    <x-stat-card title="Available Balance" value="₱8,300" icon="bi-wallet2" icon-color="text-green-600"
        subtitle="After expenses" />

    <x-stat-card title="Total Loans" value="₱5,000" icon="bi-journal-text" icon-color="text-yellow-500"
        subtitle="3 Active Loans" />

    <x-stat-card title="Next Cutoff" value="3 Days" icon="bi-calendar-check" icon-color="text-emerald-600"
        subtitle="Feb 4" />
</div>


{{-- MAIN DASHBOARD --}}
<section class="dashboard-section">

    {{-- LEFT: MAIN CONTENT (col-8 equivalent) --}}
    <div class="dashboard-main">

        {{-- Income Resources --}}
        <x-income-card />

        {{-- Budget Allocation --}}
        <x-budget-card />

    </div>

    {{-- RIGHT: SIDE CONTENT (col-4 equivalent) --}}
    <aside class="dashboard-side">

        {{-- Subscriptions --}}
        <x-subscriptions-card />

        {{-- Loan Management --}}
        <x-loans-card />

    </aside>
</section>

@endsection