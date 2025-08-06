import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, Link } from '@inertiajs/react';
import { FormEvent } from 'react';

interface Patient {
    id: number;
    nama: string;
}

interface Props {
    patients: Patient[];
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Kunjungan', href: '/visits' },
    { title: 'Catat Kunjungan', href: '/visits/create' },
];

export default function VisitsCreate({ patients }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        patient_id: '',
        visited_at: new Date().toISOString().slice(0, 16), // Current datetime
    });

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();
        post(route('visits.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Catat Kunjungan Baru" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                            ➕ Catat Kunjungan Baru
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400">
                            Daftarkan kunjungan pasien ke klinik
                        </p>
                    </div>
                    <Link
                        href={route('visits.index')}
                        className="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                    >
                        ← Kembali
                    </Link>
                </div>

                <div className="grid gap-6 lg:grid-cols-3">
                    {/* Form */}
                    <div className="lg:col-span-2">
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                    📝 Formulir Kunjungan
                                </h2>
                            </div>
                            <form onSubmit={handleSubmit} className="p-6">
                                <div className="space-y-6">
                                    {/* Patient Selection */}
                                    <div>
                                        <label htmlFor="patient_id" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Pilih Pasien *
                                        </label>
                                        <select
                                            id="patient_id"
                                            value={data.patient_id}
                                            onChange={(e) => setData('patient_id', e.target.value)}
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                        >
                                            <option value="">-- Pilih pasien --</option>
                                            {patients.map((patient) => (
                                                <option key={patient.id} value={patient.id}>
                                                    {patient.nama}
                                                </option>
                                            ))}
                                        </select>
                                        {errors.patient_id && (
                                            <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                                {errors.patient_id}
                                            </p>
                                        )}
                                        
                                        {patients.length === 0 && (
                                            <div className="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-md dark:bg-yellow-900/20 dark:border-yellow-800">
                                                <div className="flex">
                                                    <div className="text-yellow-400">⚠️</div>
                                                    <div className="ml-3">
                                                        <p className="text-sm text-yellow-800 dark:text-yellow-200">
                                                            Belum ada data pasien. 
                                                            <Link
                                                                href={route('patients.create')}
                                                                className="ml-1 underline hover:text-yellow-900 dark:hover:text-yellow-100"
                                                            >
                                                                Tambah pasien baru
                                                            </Link>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        )}
                                    </div>

                                    {/* Visit Date & Time */}
                                    <div>
                                        <label htmlFor="visited_at" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Waktu Kunjungan
                                        </label>
                                        <input
                                            type="datetime-local"
                                            id="visited_at"
                                            value={data.visited_at}
                                            onChange={(e) => setData('visited_at', e.target.value)}
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                        />
                                        {errors.visited_at && (
                                            <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                                {errors.visited_at}
                                            </p>
                                        )}
                                        <p className="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            💡 Waktu default adalah saat ini. Anda bisa mengubahnya jika diperlukan.
                                        </p>
                                    </div>
                                </div>

                                {/* Submit Button */}
                                <div className="mt-8 flex justify-end space-x-3">
                                    <Link
                                        href={route('visits.index')}
                                        className="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                                    >
                                        Batal
                                    </Link>
                                    <button
                                        type="submit"
                                        disabled={processing || patients.length === 0}
                                        className="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50"
                                    >
                                        {processing ? (
                                            <>
                                                <svg className="mr-2 h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                                    <path className="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                                </svg>
                                                Menyimpan...
                                            </>
                                        ) : (
                                            '✅ Catat Kunjungan'
                                        )}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {/* Sidebar - Quick Info */}
                    <div className="space-y-6">
                        {/* Quick Stats */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 className="text-lg font-medium text-gray-900 dark:text-white">
                                    📊 Info Hari Ini
                                </h3>
                            </div>
                            <div className="p-6">
                                <div className="text-center">
                                    <div className="text-3xl mb-2">📅</div>
                                    <p className="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                        {new Date().toLocaleDateString('id-ID', {
                                            weekday: 'long',
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric'
                                        })}
                                    </p>
                                    <p className="text-lg font-semibold text-gray-900 dark:text-white">
                                        {new Date().toLocaleTimeString('id-ID', {
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })} WIB
                                    </p>
                                </div>
                            </div>
                        </div>

                        {/* Quick Actions */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 className="text-lg font-medium text-gray-900 dark:text-white">
                                    ⚡ Aksi Cepat
                                </h3>
                            </div>
                            <div className="p-6 space-y-3">
                                <Link
                                    href={route('patients.index')}
                                    className="w-full inline-flex justify-center items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                                >
                                    👥 Lihat Semua Pasien
                                </Link>
                                
                                <Link
                                    href={route('patients.create')}
                                    className="w-full inline-flex justify-center items-center rounded-lg border border-blue-300 bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700 shadow-sm transition-colors hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-blue-600 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/30"
                                >
                                    ➕ Daftar Pasien Baru
                                </Link>

                                <Link
                                    href={route('visits.index')}
                                    className="w-full inline-flex justify-center items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                                >
                                    📋 Riwayat Kunjungan
                                </Link>
                            </div>
                        </div>

                        {/* Tips */}
                        <div className="rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
                            <div className="flex">
                                <div className="text-blue-400 text-lg">💡</div>
                                <div className="ml-3">
                                    <h4 className="text-sm font-medium text-blue-800 dark:text-blue-200">
                                        Tips Pencatatan
                                    </h4>
                                    <div className="mt-2 text-xs text-blue-700 dark:text-blue-300 space-y-1">
                                        <p>• Pastikan pasien sudah terdaftar di sistem</p>
                                        <p>• Waktu kunjungan bisa disesuaikan jika diperlukan</p>
                                        <p>• Data kunjungan dapat dilihat di riwayat</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}