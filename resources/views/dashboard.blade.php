@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
{{-- STAT CARDS --}}

@php
$balanceColor = $availableBalance < 0 ? 'text-red-600' : 'text-green-600' ; @endphp 

<div
    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <x-stat-card title="Total Income" :value="'₱' . number_format($totalIncome, 2)" icon="bi-cash-stack"
        icon-color="text-teal-500" />

    <x-stat-card title="Available Balance" :value="'₱' . number_format($availableBalance, 2)" icon="bi-wallet2"
        :icon-color="$balanceColor" :valueColor="$balanceColor" subtitle="After budget allocation" />

    <x-stat-card title="Total Loans" value="₱5,000" icon="bi-journal-text" icon-color="text-yellow-500"
        subtitle="3 Active Loans" />

    <x-stat-card title="Next Payday" :value="$daysBeforePayday !== null
            ? ($daysBeforePayday === 0 ? 'Today' : $daysBeforePayday . ' Days')
            : '—'" icon="bi-cash-stack" icon-color="text-violet-600"
        :subtitle="$nextPayday ? $nextPayday->format('M d') : 'Set your payday'" />
    </div>
    {{-- PAYDAY SETTINGS SECTION --}}
    <section class="payday-settings-section">
        <a href="#paydaySettingsModal" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-2">
            <i class="bi bi-gear"></i>
            <span>Payday Settings</span>
        </a>
        @include('components.modals.payday-settings-modal')
    </section>
    <section class="dashboard-section">
        <div class="dashboard-main">
            <x-income-card :incomes="$incomes" />
            <x-budget-card :cutoffs="$cutoffs" />
        </div>
        <aside class="dashboard-side">
            <x-subscriptions-card :subscriptions="$subscriptions" :total-subscriptions="$totalSubscriptions" />
            <x-loans-card />
        </aside>
    </section>
    @endsection