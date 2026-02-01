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
        <div class="card">
            <h2 class="section-title">Income Resources</h2>

            <ul class="list">
                <li><span>Salary</span><strong>₱12,000</strong></li>
                <li><span>Freelance</span><strong>₱4,500</strong></li>
                <li><span>Side Hustle</span><strong>₱1,725</strong></li>
            </ul>
        </div>

        {{-- Budget Allocation --}}
        <div class="card">
            <h2 class="section-title">Budget Allocation</h2>

            <ul class="list">
                <li><span>Food</span><strong>₱4,000</strong></li>
                <li><span>Transportation</span><strong>₱1,500</strong></li>
                <li><span>Savings</span><strong>₱3,000</strong></li>
                <li><span>Emergency Fund</span><strong>₱2,000</strong></li>
            </ul>
        </div>

    </div>

    {{-- RIGHT: SIDE CONTENT (col-4 equivalent) --}}
    <aside class="dashboard-side">

        {{-- Subscriptions --}}
        <div class="card">
            <h2 class="section-title">Subscriptions</h2>

            <ul class="list">
                <li><span>Netflix</span><strong>₱549</strong></li>
                <li><span>Spotify</span><strong>₱149</strong></li>
                <li><span>Adobe</span><strong>₱1,200</strong></li>
            </ul>
        </div>

        {{-- Loan Management --}}
        <div class="card">
            <h2 class="section-title">Loan Management</h2>

            <ul class="list">
                <li><span>Personal Loan</span><strong>₱2,000</strong></li>
                <li><span>Gadget Loan</span><strong>₱1,500</strong></li>
                <li><span>Emergency Loan</span><strong>₱1,500</strong></li>
            </ul>
        </div>

    </aside>
</section>

@endsection