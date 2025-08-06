import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Patient {
    id: number;
    nama: string;
    jenis_kelamin: string;
    created_at: string;
}

interface Visit {
    id: number;
    visited_at: string;
    patient: Patient;
}

interface Stats {
    total_patients?: number;
    total_visits?: number;
    total_doctors?: number;
    total_receptionists?: number;
    visits_today?: number;
    visits_this_week?: number;
    patients_this_month?: number;
    recent_patients?: Patient[];
    recent_visits?: Visit[];
}

interface Props {
    stats: Stats;
    user_role: string;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ stats, user_role }: Props) {
    const roleNames = {
        admin: 'Administrator',
        doctor: 'Dokter',
        receptionist: 'Resepsionis',
    };

    const getRoleIcon = (role: string) => {
        switch (role) {
            case 'admin': return '👑';
            case 'doctor': return '👨‍⚕️';
            case 'receptionist': return '📋';
            default: return '👤';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                {/* Welcome Header */}
                <div className="rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-white">
                    <h1 className="text-2xl font-bold">
                        {getRoleIcon(user_role)} Selamat Datang, {roleNames[user_role as keyof typeof roleNames]}!
                    </h1>
                    <p className="mt-2 opacity-90">
                        Dashboard untuk mengelola sistem klinik
                    </p>
                </div>

                {/* Stats Grid */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    {user_role === 'admin' && (
                        <>
                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Total Pasien
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.total_patients || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">👥</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Total Kunjungan
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.total_visits || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">📊</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Dokter
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.total_doctors || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">👨‍⚕️</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Resepsionis
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.total_receptionists || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">📋</div>
                                </div>
                            </div>
                        </>
                    )}

                    {user_role === 'doctor' && (
                        <>
                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Total Pasien
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.total_patients || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">👥</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Kunjungan Hari Ini
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.visits_today || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">📅</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Kunjungan Minggu Ini
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.visits_this_week || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">📈</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Total Kunjungan
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.total_visits || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">📊</div>
                                </div>
                            </div>
                        </>
                    )}

                    {user_role === 'receptionist' && (
                        <>
                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Total Pasien
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.total_patients || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">👥</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Kunjungan Hari Ini
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.visits_today || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">📅</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                            Pasien Bulan Ini
                                        </p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                            {stats.patients_this_month || 0}
                                        </p>
                                    </div>
                                    <div className="text-3xl">📋</div>
                                </div>
                            </div>

                            <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                                <Link 
                                    href={route('patients.create')}
                                    className="flex items-center justify-between rounded-xl bg-blue-50 p-4 text-blue-600 transition-colors hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/30"
                                >
                                    <div>
                                        <p className="font-medium">Tambah Pasien Baru</p>
                                    </div>
                                    <div className="text-3xl">➕</div>
                                </Link>
                            </div>
                        </>
                    )}
                </div>

                {/* Quick Actions */}
                <div className="grid gap-4 md:grid-cols-2">
                    <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                        <h3 className="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                            📋 Aksi Cepat
                        </h3>
                        <div className="grid gap-2">
                            <Link
                                href={route('patients.index')}
                                className="flex items-center rounded-lg bg-gray-50 p-3 text-gray-700 transition-colors hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                            >
                                <span className="mr-3">👥</span>
                                Data Pasien
                            </Link>
                            <Link
                                href={route('patients.create')}
                                className="flex items-center rounded-lg bg-gray-50 p-3 text-gray-700 transition-colors hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                            >
                                <span className="mr-3">➕</span>
                                Tambah Pasien Baru
                            </Link>
                            <Link
                                href={route('visits.index')}
                                className="flex items-center rounded-lg bg-gray-50 p-3 text-gray-700 transition-colors hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                            >
                                <span className="mr-3">📊</span>
                                Data Kunjungan
                            </Link>
                            <Link
                                href={route('visits.create')}
                                className="flex items-center rounded-lg bg-gray-50 p-3 text-gray-700 transition-colors hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                            >
                                <span className="mr-3">📝</span>
                                Catat Kunjungan Baru
                            </Link>
                        </div>
                    </div>

                    <div className="rounded-xl bg-white p-6 shadow-sm dark:bg-gray-800">
                        <h3 className="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                            ⏰ Aktivitas Terbaru
                        </h3>
                        {stats.recent_visits && stats.recent_visits.length > 0 ? (
                            <div className="space-y-2">
                                {stats.recent_visits.slice(0, 5).map((visit) => (
                                    <div key={visit.id} className="rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
                                        <div className="flex items-center justify-between">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {visit.patient.nama}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                                    {new Date(visit.visited_at).toLocaleString('id-ID')}
                                                </p>
                                            </div>
                                            <span className="text-green-500">✓</span>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ) : (
                            <p className="text-gray-500 dark:text-gray-400">
                                Belum ada kunjungan hari ini
                            </p>
                        )}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}