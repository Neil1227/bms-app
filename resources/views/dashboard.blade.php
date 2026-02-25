@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
{{-- STAT CARDS --}}

@php
$balanceColor = $availableBalance < 0 ? 'text-red-600' : 'text-green-600' ; @endphp 
<div class="stats-grid gap-6 mb-12 ">
    <x-stat-card title="Total Income" :value="'₱' . number_format($totalIncome, 2)" icon="bi-cash-stack"
        icon-color="text-teal-500" subtitle="Planned spending total" />

        @php
        $nextCutoff = $activeCutoff === '1-15' ? '16-30' : '1-15';

        $cutoffLabel = $activeCutoff === '1-15'
        ? '1st Cutoff'
        : '2nd Cutoff';
        @endphp

    <x-stat-card title="Available Balance" :value="'₱' . number_format($availableBalance, 2)" icon="bi-wallet2"
        :icon-color="$balanceColor" :valueColor="$balanceColor" subtitle="Available for {{ $cutoffLabel }}" clickable
        :href="request()->fullUrlWithQuery(['cutoff' => $nextCutoff])" />

    <x-stat-card title="Total Loans" :value="'₱' . number_format($totalLoanDebt, 2)" icon="bi-journal-text"
        icon-color="text-yellow-500" :subtitle="$loanCount . ' Active Loan' . ($loanCount > 1 ? 's' : '')" />

    <x-stat-card title="Next Payday" :value="$daysBeforePayday !== null
            ? ($daysBeforePayday == 0
                ? 'Today'
                : ($daysBeforePayday == 1
                    ? '1 Day'
                    : $daysBeforePayday . ' Days'))
            : '—'" icon="bi-cash-stack" icon-color="text-violet-600"
        :subtitle="$nextPayday ? $nextPayday->format('M d') : 'Tap to set your payday'" clickablemodal
        href="#paydaySettingsModal" />

    @include('components.modals.payday-settings-modal')

    </div>
    {{-- PAYDAY SETTINGS SECTION --}}
    <section class="dashboard-section">
        <div class="dashboard-main">
            <x-income-card :incomes="$incomes" />
            <x-budget-card :cutoffs="$cutoffs" />
        </div>
        <aside class="dashboard-side">
            <x-subscriptions-card :subscriptions="$subscriptions" :total-subscriptions="$totalSubscriptions" />
            <x-loans-card :loans="$loans" />
        </aside>
    </section>
    @endsection


    