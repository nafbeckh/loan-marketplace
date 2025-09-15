@extends('layouts.app')
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1 bg-white p-6">
        <h2 class="text-lg font-semibold mb-4">Ajukan Pinjaman</h2>

        <form method="POST" action="{{ route('offers.get') }}" class="space-y-4">
            @csrf
            <div>
                <label for="amount" class="block text-sm/6 font-medium text-gray-900">Harga Properti*</label>
                <div class="mt-2">
                    <input
                        id="amount"
                        type="text"
                        name="amount"
                        min="0"
                        required
                        placeholder="Harga Properti"
                        value="{{ old('amount', number_format($formData['amount'] ?? 0, 0, ',', '.')) }}"
                        class="rupiah-input block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    />
                </div>
            </div>

            <div class="flex gap-4 items-end">
                <div class="w-1/4">
                    <label for="dp_percent" class="block text-sm/6 font-medium text-gray-900">Persen DP*</label>
                    <div class="mt-2 relative">
                        <input
                            id="dp_percent"
                            type="text"
                            name="dp_percent"
                            min="0"
                            required
                            placeholder="10"
                            value="{{ old('dp_percent', $formData['dp_percent'] ?? '10') }}"
                            class="block w-full rounded-md bg-white pr-10 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            %
                        </span>
                    </div>
                </div>

                <div class="flex-1">
                    <label for="dp_amount" class="block text-sm/6 font-medium text-gray-900">Jumlah DP*</label>
                    <div class="mt-2">
                        <input
                            id="dp_amount"
                            type="text"
                            name="dp_amount"
                            min="0"
                            required
                            placeholder="0"
                            value="{{ old('dp_amount', number_format($formData['dp_amount'] ?? 0, 0, ',', '.')) }}"
                            class="rupiah-input block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                        />
                    </div>
                </div>
            </div>

            <div>
                <label for="tenor" class="block text-sm/6 font-medium text-gray-900">Tenor (Bulan)*</label>
                <div class="mt-2">
                    <input
                        id="tenor"
                        type="number"
                        name="tenor"
                        min="0"
                        required
                        placeholder="Tenor"
                        value="{{ old('tenor', $formData['tenor'] ?? '') }}"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    />
                </div>
            </div>

            <div>
                <label for="purpose" class="block text-sm/6 font-medium text-gray-900">Tujuan*</label>
                <div class="mt-2">
                    <input
                        id="purpose"
                        type="text"
                        name="purpose"
                        required
                        placeholder="Tujuan"
                        value="{{ old('purpose', $formData['purpose'] ?? '') }}"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    />
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="cursor-pointer w-full rounded-md bg-indigo-600 px-4 py-2 text-white text-sm shadow hover:bg-indigo-500 focus:outline-none">
                        Lihat Penawaran
                </button>
            </div>
        </form>
    </div>

    <div class="lg:col-span-2">
        @if(isset($offers))
            <div class="bg-white p-6 border border-gray-200 shadow rounded-lg">
                <div class="flex justify-between items-center pb-4 border-b">
                    <div>
                        <h2 class="text-lg font-semibold">Rincian Pinjaman</h2>
                        <p class="text-sm text-gray-500">{{ $formData['purpose'] ?? '' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Jumlah yang dipinjam</p>
                        <p class="font-bold text-lg text-indigo-600">
                            Rp {{ number_format($formData['total_amount'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="py-4 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span>Harga Properti</span>
                        <span>Rp {{ number_format($formData['dp_amount'] + $formData['amount'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>DP ({{ $formData['dp_percent'] }}%)</span>
                        <span>Rp {{ number_format($formData['dp_amount'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Tenor</span>
                        <span>{{ $formData['tenor'] }} bulan</span>
                    </div>
                </div>
            </div>

            <h3 class="font-bold text-lg mt-6">Rekomendasi Produk</h3>
            <p class="text-sm text-gray-500 mb-4">Menampilkan {{ count($offers) }} Produk Rekomendasi</p>

            <div class="space-y-4">
                @foreach($offers as $offer)
                    <div class="border border-gray-200 shadow rounded-lg">
                        <div class="flex items-center py-4 px-6 bg-gray-100">
                            <h3 class="font-bold text-base">{{ $offer->lender->company_name }}</h3>
                        </div>

                        <div class="p-6">
                            <h5 class="text-lg font-semibold">Fixed Sepanjang Tenor</h5>
                            <p class="text-sm text-gray-600">Tenor {{ $offer->tenor }} bulan</p>
                        </div>

                        <div class="px-6 pb-6 flex text-sm gap-8">
                            <div class="flex-auto">
                                <h5 class="text-lg font-semibold mb-2">Estimasi Angsuran Bulanan</h5>

                                <div class="rounded-md text-sm">
                                    <div class="flex justify-between py-2">
                                        <span>Uang Muka</span>
                                        <span class="font-medium">Rp {{ number_format($formData['dp_amount'], 0, ',', '.') }}</span>
                                    </div>

                                    <div class="flex justify-between py-2">
                                        <span>Angsuran Pertama</span>
                                        <span class="ont-medium">Rp {{ number_format($offer->installment, 2, ',', '.') }}</span>
                                    </div>

                                    <div class="flex justify-between py-2">
                                        <span>Total Pembayaran Pertama</span>
                                        <span class="ont-medium">Rp {{ number_format($offer->first_payment, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-1">
                                <h5 class="text-lg font-semibold mb-2">Cicilan</h5>
                                <h5 class="text-lg">Rp {{ number_format($offer->installment, 2, ',', '.') }}</h5>
                                <p class="text-gray-700">per bulan</p>
                            </div>

                            <div class="flex-1">
                                <div>
                                    <h5 class="text-lg font-semibold mb-2">Bunga</h5>
                                <h5 class="text-lg">{{ $offer->interest_rate }}%</h5>
                                    <p class="text-gray-700">per tahun</p>
                                </div>
                                <button
                                    class="cursor-pointer mt-4 w-[80%] rounded-md bg-indigo-600 px-2 py-2 text-white text-sm shadow hover:bg-indigo-500 focus:outline-none">
                                    Pilih Produk
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div>
                <h3 class="font-bold text-lg mt-6">Rekomendasi Produk</h3>
                <p class="text-sm text-gray-500 mb-4">Coba lengkapi form isian pada kolom di sebelah kiri dan klik "Lihat Penawaran" untuk mendapatkan produk terbaik.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('js')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const amountInput = document.getElementById("amount");
    const dpPercentInput = document.getElementById("dp_percent");
    const dpAmountInput = document.getElementById("dp_amount");

    function formatRupiah(angka) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        }).format(angka);
    }

    function parseRupiah(str) {
        return parseFloat(str.replace(/[^0-9]/g, "")) || 0;
    }

    function updateDpAmount() {
        const amount = parseRupiah(amountInput.value);
        const dpPercent = parseFloat(dpPercentInput.value) || 0;
        if (amount > 0 && dpPercent > 0) {
            const dp = Math.round((dpPercent / 100) * amount);
            dpAmountInput.value = formatRupiah(dp);
        }
    }

    function updateDpPercent() {
        const amount = parseRupiah(amountInput.value);
        const dpAmount = parseRupiah(dpAmountInput.value);
        if (amount > 0 && dpAmount > 0) {
            dpPercentInput.value = ((dpAmount / amount) * 100).toFixed(2);
        }
    }

    dpPercentInput.addEventListener("input", updateDpAmount);
    amountInput.addEventListener("input", updateDpAmount);
    dpAmountInput.addEventListener("input", updateDpPercent);

    document.querySelectorAll(".rupiah-input").forEach(input => {
        input.addEventListener("input", function () {
            const angka = parseRupiah(this.value);
            this.value = angka > 0 ? formatRupiah(angka) : "";
        });
    });
});
</script>
@endpush
