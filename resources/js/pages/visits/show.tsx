import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/react';

interface Patient {
    id: number;
    nama: string;
    tanggal_lahir: string;
    jenis_kelamin: string;
    kontak: string | null;
    alergi: string | null;
}

interface Visit {
    id: number;
    visited_at: string;
    created_at: string;
    patient: Patient;
}

interface Props {
    visit: Visit;
    [key: string]: unknown;
}

export default function VisitsShow({ visit }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Data Kunjungan', href: '/visits' },
        { title: `Kunjungan #${visit.id}`, href: `/visits/${visit.id}` },
    ];

    const calculateAge = (birthDate: string) => {
        const today = new Date();
        const birth = new Date(birthDate);
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }
        
        return age;
    };

    const handleDelete = () => {
        if (confirm('Apakah Anda yakin ingin menghapus data kunjungan ini? Tindakan ini tidak dapat dibatalkan.')) {
            router.delete(route('visits.destroy', visit.id));
        }
    };

    const visitDate = new Date(visit.visited_at);
    const isToday = visitDate.toDateString() === new Date().toDateString();

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Detail Kunjungan #${visit.id}`} />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div className="flex items-center space-x-3">
                        <div className="text-4xl">
                            {visit.patient.jenis_kelamin === 'Laki-laki' ? '👨' : '👩'}
                        </div>
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                                Kunjungan #{visit.id}
                            </h1>
                            <p className="text-gray-600 dark:text-gray-400">
                                {visit.patient.nama} • {visitDate.toLocaleDateString('id-ID')}
                            </p>
                        </div>
                        {isToday && (
                            <span className="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800 dark:bg-green-800 dark:text-green-100">
                                ✅ Hari Ini
                            </span>
                        )}
                    </div>
                    <div className="flex space-x-2">
                        <Link
                            href={route('visits.index')}
                            className="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            ← Kembali
                        </Link>
                    </div>
                </div>

                {/* Content Grid */}
                <div className="grid gap-6 lg:grid-cols-3">
                    {/* Visit Information */}
                    <div className="lg:col-span-2 space-y-6">
                        {/* Visit Details */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                    📅 Detail Kunjungan
                                </h2>
                            </div>
                            <div className="p-6">
                                <div className="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">ID Kunjungan</dt>
                                        <dd className="mt-1 text-lg font-semibold text-gray-900 dark:text-white">#{visit.id}</dd>
                                    </div>
                                    <div>
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                        <dd className="mt-1">
                                            <span className={`inline-flex rounded-full px-3 py-1 text-sm font-semibold ${
                                                isToday 
                                                    ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' 
                                                    : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100'
                                            }`}>
                                                {isToday ? '✅ Kunjungan Hari Ini' : '✓ Kunjungan Selesai'}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Kunjungan</dt>
                                        <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                            {visitDate.toLocaleDateString('id-ID', {
                                                weekday: 'long',
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric'
                                            })}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Waktu Kunjungan</dt>
                                        <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                            {visitDate.toLocaleTimeString('id-ID', {
                                                hour: '2-digit',
                                                minute: '2-digit'
                                            })} WIB
                                        </dd>
                                    </div>
                                    <div className="md:col-span-2">
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Dicatat pada</dt>
                                        <dd className="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            {new Date(visit.created_at).toLocaleDateString('id-ID', {
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric',
                                                hour: '2-digit',
                                                minute: '2-digit'
                                            })}
                                        </dd>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Patient Information */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <div className="flex items-center justify-between">
                                    <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                        👤 Informasi Pasien
                                    </h2>
                                    <Link
                                        href={route('patients.show', visit.patient.id)}
                                        className="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                    >
                                        Lihat Detail Lengkap →
                                    </Link>
                                </div>
                            </div>
                            <div className="p-6">
                                <div className="grid gap-4 md:grid-cols-2">
                                    <div>
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                        <dd className="mt-1 text-sm font-medium text-gray-900 dark:text-white">{visit.patient.nama}</dd>
                                    </div>
                                    <div>
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Umur</dt>
                                        <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                            {calculateAge(visit.patient.tanggal_lahir)} tahun
                                        </dd>
                                    </div>
                                    <div>
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin</dt>
                                        <dd className="mt-1">
                                            <span className={`inline-flex rounded-full px-2 py-1 text-xs font-semibold ${
                                                visit.patient.jenis_kelamin === 'Laki-laki' 
                                                    ? 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100' 
                                                    : 'bg-pink-100 text-pink-800 dark:bg-pink-800 dark:text-pink-100'
                                            }`}>
                                                {visit.patient.jenis_kelamin}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Kontak</dt>
                                        <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                            {visit.patient.kontak || '-'}
                                        </dd>
                                    </div>
                                    {visit.patient.alergi && (
                                        <div className="md:col-span-2">
                                            <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">⚠️ Alergi</dt>
                                            <dd className="mt-1 text-sm text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 p-2 rounded">
                                                {visit.patient.alergi}
                                            </dd>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Sidebar */}
                    <div className="space-y-6">
                        {/* Quick Actions */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 className="text-lg font-medium text-gray-900 dark:text-white">
                                    ⚡ Aksi Cepat
                                </h3>
                            </div>
                            <div className="p-6 space-y-3">
                                <Link
                                    href={route('patients.show', visit.patient.id)}
                                    className="w-full inline-flex justify-center items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    👤 Lihat Detail Pasien
                                </Link>
                                
                                <Link
                                    href={route('visits.create')}
                                    className="w-full inline-flex justify-center items-center rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-sm font-medium text-green-700 shadow-sm transition-colors hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:border-green-600 dark:bg-green-900/20 dark:text-green-400 dark:hover:bg-green-900/30"
                                >
                                    ➕ Catat Kunjungan Baru
                                </Link>
                                
                                <Link
                                    href={route('visits.index')}
                                    className="w-full inline-flex justify-center items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                                >
                                    📋 Semua Kunjungan
                                </Link>
                            </div>
                        </div>

                        {/* Visit Stats */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 className="text-lg font-medium text-gray-900 dark:text-white">
                                    📊 Informasi Tambahan
                                </h3>
                            </div>
                            <div className="p-6 space-y-4">
                                <div className="text-center">
                                    <div className="text-2xl mb-1">🕐</div>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">
                                        Waktu sejak kunjungan
                                    </p>
                                    <p className="text-sm font-medium text-gray-900 dark:text-white">
                                        {Math.floor((new Date().getTime() - visitDate.getTime()) / (1000 * 60 * 60 * 24))} hari yang lalu
                                    </p>
                                </div>
                                
                                <div className="border-t border-gray-200 pt-4 dark:border-gray-700">
                                    <p className="text-xs text-gray-500 dark:text-gray-400 text-center">
                                        ID Pasien: #{visit.patient.id}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {/* Danger Zone */}
                        <div className="rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800">
                            <div className="px-6 py-4 border-b border-red-200 dark:border-red-800">
                                <h3 className="text-lg font-medium text-red-900 dark:text-red-200">
                                    ⚠️ Zona Berbahaya
                                </h3>
                            </div>
                            <div className="p-6">
                                <p className="text-sm text-red-700 dark:text-red-300 mb-4">
                                    Tindakan ini akan menghapus data kunjungan secara permanen.
                                </p>
                                <button
                                    onClick={handleDelete}
                                    className="w-full inline-flex justify-center items-center rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                >
                                    🗑️ Hapus Data Kunjungan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}