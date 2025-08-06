import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/react';

interface Visit {
    id: number;
    visited_at: string;
}

interface Patient {
    id: number;
    nama: string;
    tanggal_lahir: string;
    jenis_kelamin: string;
    kontak: string | null;
    alamat: string | null;
    alergi: string | null;
    catatan: string | null;
    created_at: string;
    visits: Visit[];
}

interface Props {
    patient: Patient;
    [key: string]: unknown;
}

export default function PatientsShow({ patient }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Data Pasien', href: '/patients' },
        { title: patient.nama, href: `/patients/${patient.id}` },
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
        if (confirm('Apakah Anda yakin ingin menghapus data pasien ini? Tindakan ini tidak dapat dibatalkan.')) {
            router.delete(route('patients.destroy', patient.id));
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Detail Pasien - ${patient.nama}`} />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div className="flex items-center space-x-3">
                        <div className="text-4xl">
                            {patient.jenis_kelamin === 'Laki-laki' ? '👨' : '👩'}
                        </div>
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                                {patient.nama}
                            </h1>
                            <p className="text-gray-600 dark:text-gray-400">
                                {calculateAge(patient.tanggal_lahir)} tahun • {patient.jenis_kelamin}
                            </p>
                        </div>
                    </div>
                    <div className="flex space-x-2">
                        <Link
                            href={route('patients.index')}
                            className="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            ← Kembali
                        </Link>
                        <Link
                            href={route('patients.edit', patient.id)}
                            className="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            ✏️ Edit
                        </Link>
                    </div>
                </div>

                {/* Content Grid */}
                <div className="grid gap-6 lg:grid-cols-3">
                    {/* Patient Information */}
                    <div className="lg:col-span-2 space-y-6">
                        {/* Basic Info */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                    📋 Informasi Dasar
                                </h2>
                            </div>
                            <div className="p-6 grid gap-4 md:grid-cols-2">
                                <div>
                                    <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                    <dd className="mt-1 text-sm text-gray-900 dark:text-white">{patient.nama}</dd>
                                </div>
                                <div>
                                    <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Lahir</dt>
                                    <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                        {new Date(patient.tanggal_lahir).toLocaleDateString('id-ID', {
                                            weekday: 'long',
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric'
                                        })}
                                    </dd>
                                </div>
                                <div>
                                    <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Umur</dt>
                                    <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                        {calculateAge(patient.tanggal_lahir)} tahun
                                    </dd>
                                </div>
                                <div>
                                    <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin</dt>
                                    <dd className="mt-1">
                                        <span className={`inline-flex rounded-full px-2 py-1 text-xs font-semibold ${
                                            patient.jenis_kelamin === 'Laki-laki' 
                                                ? 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100' 
                                                : 'bg-pink-100 text-pink-800 dark:bg-pink-800 dark:text-pink-100'
                                        }`}>
                                            {patient.jenis_kelamin}
                                        </span>
                                    </dd>
                                </div>
                            </div>
                        </div>

                        {/* Contact Information */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                    📞 Informasi Kontak
                                </h2>
                            </div>
                            <div className="p-6 space-y-4">
                                <div>
                                    <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Kontak</dt>
                                    <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                        {patient.kontak || 'Tidak tersedia'}
                                    </dd>
                                </div>
                                <div>
                                    <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                                    <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                        {patient.alamat || 'Tidak tersedia'}
                                    </dd>
                                </div>
                            </div>
                        </div>

                        {/* Medical Information */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                    🏥 Informasi Medis
                                </h2>
                            </div>
                            <div className="p-6 space-y-4">
                                <div>
                                    <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Alergi yang Diketahui</dt>
                                    <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                        {patient.alergi ? (
                                            <div className="flex items-start">
                                                <span className="text-red-500 mr-1">⚠️</span>
                                                <span className="text-red-600 dark:text-red-400">{patient.alergi}</span>
                                            </div>
                                        ) : (
                                            <span className="text-green-600 dark:text-green-400">✅ Tidak ada alergi yang diketahui</span>
                                        )}
                                    </dd>
                                </div>
                                <div>
                                    <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Catatan Tambahan</dt>
                                    <dd className="mt-1 text-sm text-gray-900 dark:text-white">
                                        {patient.catatan || 'Tidak ada catatan tambahan'}
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Sidebar */}
                    <div className="space-y-6">
                        {/* Quick Stats */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                    📊 Statistik Kunjungan
                                </h2>
                            </div>
                            <div className="p-6">
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                        {patient.visits.length}
                                    </div>
                                    <div className="text-sm text-gray-500 dark:text-gray-400">
                                        Total Kunjungan
                                    </div>
                                </div>
                                <div className="mt-4">
                                    <Link
                                        href={route('visits.create')}
                                        className="w-full inline-flex justify-center items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                    >
                                        ➕ Catat Kunjungan Baru
                                    </Link>
                                </div>
                            </div>
                        </div>

                        {/* Recent Visits */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                    🕐 Kunjungan Terakhir
                                </h2>
                            </div>
                            <div className="p-6">
                                {patient.visits.length > 0 ? (
                                    <div className="space-y-3">
                                        {patient.visits.slice(0, 5).map((visit) => (
                                            <div key={visit.id} className="flex items-center justify-between rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
                                                <div>
                                                    <div className="text-sm font-medium text-gray-900 dark:text-white">
                                                        Kunjungan #{visit.id}
                                                    </div>
                                                    <div className="text-xs text-gray-500 dark:text-gray-400">
                                                        {new Date(visit.visited_at).toLocaleDateString('id-ID')}
                                                    </div>
                                                </div>
                                                <span className="text-green-500">✓</span>
                                            </div>
                                        ))}
                                        {patient.visits.length > 5 && (
                                            <div className="text-center">
                                                <Link
                                                    href={route('visits.index')}
                                                    className="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                                >
                                                    Lihat semua kunjungan →
                                                </Link>
                                            </div>
                                        )}
                                    </div>
                                ) : (
                                    <div className="text-center text-gray-500 dark:text-gray-400">
                                        <div className="text-4xl mb-2">📋</div>
                                        <p className="text-sm">Belum ada kunjungan</p>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Actions */}
                        <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                            <div className="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h2 className="text-lg font-medium text-gray-900 dark:text-white">
                                    ⚙️ Aksi
                                </h2>
                            </div>
                            <div className="p-6 space-y-2">
                                <Link
                                    href={route('patients.edit', patient.id)}
                                    className="w-full inline-flex justify-center items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                                >
                                    ✏️ Edit Data Pasien
                                </Link>
                                <button
                                    onClick={handleDelete}
                                    className="w-full inline-flex justify-center items-center rounded-lg border border-red-300 bg-red-50 px-4 py-2 text-sm font-medium text-red-700 shadow-sm transition-colors hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:border-red-600 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30"
                                >
                                    🗑️ Hapus Data Pasien
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}