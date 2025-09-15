@extends('layouts.app')
@section('content')
    <div class="space-y-4">
        @foreach ($loans as $loan)
            <div class="border border-gray-200 shadow rounded-lg">
                <div class="flex justify-between items-center py-4 px-6 bg-gray-100">
                    <h3 class="font-bold text-base">{{ $loan->offer->lender->company_name }}</h3>
                    <div class="text-right">
                        <p class="text-xs">Tanggal Pengajuan</p>
                        <p class="text-sm">{{ $loan->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="p-6">
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'approved' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];

                        $statusLabels = [
                            'pending' => 'Menunggu Persetujuan',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                        ];

                        $status = strtolower($loan->status);
                    @endphp

                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $statusLabels[$status] ?? ucfirst($status) }}
                    </span>
                </div>

                <div class="px-6 mb-6">
                    <h5 class="text-lg font-semibold">Fixed Sepanjang Tenor</h5>
                    <p class="text-sm text-gray-600">Tenor {{ $loan->offer->tenor }} bulan</p>
                </div>

                <div class="px-6 grid grid-cols-2 text-sm gap-6">
                    <div class="col-span-1">
                        <h5 class="text-lg font-semibold mb-2">Estimasi Angsuran Bulanan</h5>

                        <div class="rounded-md text-sm pr-6">
                            <div class="flex justify-between py-2">
                                <span>Uang Muka</span>
                                <span class="font-medium">Rp {{ number_format($loan->dp_amount, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between py-2">
                                <span>Angsuran Pertama</span>
                                <span class="ont-medium">Rp
                                    {{ number_format($loan->installment_amount, 2, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between py-2">
                                <span>Total Pembayaran Pertama</span>
                                <span class="ont-medium">Rp {{ number_format($loan->first_payment, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 flex gap-4">
                        <div class="flex-1">
                            <h5 class="text-lg font-semibold mb-2">Jumlah Pinjaman</h5>
                            <h5 class="text-lg">Rp {{ number_format($loan->offer->amount, 2, ',', '.') }}</h5>
                        </div>

                        <div class="flex-1">
                            <h5 class="text-lg font-semibold mb-2">Cicilan</h5>
                            <h5 class="text-lg">Rp {{ number_format($loan->installment_amount, 2, ',', '.') }}</h5>
                            <p class="text-gray-700">per bulan</p>
                        </div>

                        <div class="flex-1">
                            <div>
                                <h5 class="text-lg font-semibold mb-2">Bunga</h5>
                                <h5 class="text-lg">{{ $loan->offer->interest_rate }}%</h5>
                                <p class="text-gray-700">per tahun</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <h5 class="text-lg font-semibold">Tujuan</h5>
                    <p class="text-sm text-gray-600">{{ $loan->purpose }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
