@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <x-stat-card title="Total Income" :value="'₱' . number_format($totalIncome, 2)" icon="bi-cash-stack"
        icon-color="bg-blue-500" />
    <x-stat-card title="Available Balance" value="₱8,300" icon="bi-wallet2" icon-color="text-green-600"
        subtitle="After expenses" />
    <x-stat-card title="Total Loans" value="₱5,000" icon="bi-journal-text" icon-color="text-yellow-500"
        subtitle="3 Active Loans" />
    <x-stat-card title="Next Cutoff" value="3 Days" icon="bi-calendar-check" icon-color="text-emerald-600"
        subtitle="Feb 4" />
</div>

<section class="dashboard-section">
    <div class="dashboard-main">
        <x-income-card :incomes="$incomes" />
        <x-budget-card :cutoffs="$cutoffs" />
    </div>

    <aside class="dashboard-side">
        <x-subscriptions-card />
        <x-loans-card />
    </aside>
</section>

@endsection