import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/react';

interface Patient {
    id: number;
    nama: string;
    jenis_kelamin: string;
}

interface Visit {
    id: number;
    visited_at: string;
    patient: Patient;
}

interface PaginatedVisits {
    data: Visit[];
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
    current_page: number;
    last_page: number;
    total: number;
}

interface Props {
    visits: PaginatedVisits;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Kunjungan', href: '/visits' },
];

export default function VisitsIndex({ visits }: Props) {
    const handleDelete = (visitId: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus data kunjungan ini?')) {
            router.delete(route('visits.destroy', visitId));
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Kunjungan" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                            📊 Data Kunjungan Pasien
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400">
                            Riwayat kunjungan semua pasien
                        </p>
                    </div>
                    <Link
                        href={route('visits.create')}
                        className="inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                    >
                        ➕ Catat Kunjungan Baru
                    </Link>
                </div>

                {/* Stats */}
                <div className="grid gap-4 md:grid-cols-3">
                    <div className="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="mr-3 text-2xl">📊</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Kunjungan
                                </p>
                                <p className="text-xl font-bold text-gray-900 dark:text-white">
                                    {visits.total}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div className="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="mr-3 text-2xl">📅</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Hari Ini
                                </p>
                                <p className="text-xl font-bold text-gray-900 dark:text-white">
                                    {visits.data.filter(v => new Date(v.visited_at).toDateString() === new Date().toDateString()).length}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div className="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="mr-3 text-2xl">📈</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Minggu Ini
                                </p>
                                <p className="text-xl font-bold text-gray-900 dark:text-white">
                                    {visits.data.filter(v => {
                                        const visitDate = new Date(v.visited_at);
                                        const startOfWeek = new Date();
                                        startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay());
                                        return visitDate >= startOfWeek;
                                    }).length}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Table */}
                <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                    <div className="overflow-x-auto">
                        <table className="w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead className="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Pasien
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Waktu Kunjungan
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Status
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                {visits.data.length > 0 ? (
                                    visits.data.map((visit) => {
                                        const visitDate = new Date(visit.visited_at);
                                        const isToday = visitDate.toDateString() === new Date().toDateString();
                                        
                                        return (
                                            <tr key={visit.id} className={`hover:bg-gray-50 dark:hover:bg-gray-700 ${isToday ? 'bg-blue-50 dark:bg-blue-900/20' : ''}`}>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div className="flex items-center">
                                                        <div className="mr-3 text-lg">
                                                            {visit.patient.jenis_kelamin === 'Laki-laki' ? '👨' : '👩'}
                                                        </div>
                                                        <div>
                                                            <div className="text-sm font-medium text-gray-900 dark:text-white">
                                                                {visit.patient.nama}
                                                            </div>
                                                            <div className="text-xs text-gray-500 dark:text-gray-400">
                                                                ID: {visit.patient.id}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div className="text-sm text-gray-900 dark:text-white">
                                                        {visitDate.toLocaleDateString('id-ID', {
                                                            day: 'numeric',
                                                            month: 'long',
                                                            year: 'numeric'
                                                        })}
                                                    </div>
                                                    <div className="text-xs text-gray-500 dark:text-gray-400">
                                                        {visitDate.toLocaleTimeString('id-ID', {
                                                            hour: '2-digit',
                                                            minute: '2-digit'
                                                        })} WIB
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <span className={`inline-flex rounded-full px-2 text-xs font-semibold leading-5 ${
                                                        isToday 
                                                            ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' 
                                                            : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100'
                                                    }`}>
                                                        {isToday ? '✅ Hari Ini' : '✓ Selesai'}
                                                    </span>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div className="flex space-x-2">
                                                        <Link
                                                            href={route('visits.show', visit.id)}
                                                            className="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                        >
                                                            👁️ Detail
                                                        </Link>
                                                        <Link
                                                            href={route('patients.show', visit.patient.id)}
                                                            className="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                                        >
                                                            👤 Pasien
                                                        </Link>
                                                        <button
                                                            onClick={() => handleDelete(visit.id)}
                                                            className="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                        >
                                                            🗑️ Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan={4} className="px-6 py-12 text-center">
                                            <div className="text-gray-500 dark:text-gray-400">
                                                <div className="text-6xl mb-4">📋</div>
                                                <p className="text-lg font-medium mb-2">Belum ada data kunjungan</p>
                                                <p className="text-sm">Mulai catat kunjungan pasien pertama</p>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    {visits.last_page > 1 && (
                        <div className="border-t border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800">
                            <div className="flex items-center justify-between">
                                <div className="flex-1 flex justify-between sm:hidden">
                                    {visits.links.find(link => link.label === 'Previous')?.url && (
                                        <Link
                                            href={visits.links.find(link => link.label === 'Previous')?.url || ''}
                                            className="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Previous
                                        </Link>
                                    )}
                                    {visits.links.find(link => link.label === 'Next')?.url && (
                                        <Link
                                            href={visits.links.find(link => link.label === 'Next')?.url || ''}
                                            className="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Next
                                        </Link>
                                    )}
                                </div>
                                <div className="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p className="text-sm text-gray-700 dark:text-gray-300">
                                            Halaman <span className="font-medium">{visits.current_page}</span> dari{' '}
                                            <span className="font-medium">{visits.last_page}</span>
                                        </p>
                                    </div>
                                    <div>
                                        <nav className="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                            {visits.links.map((link, index) => (
                                                link.url ? (
                                                    <Link
                                                        key={index}
                                                        href={link.url}
                                                        className={`relative inline-flex items-center px-4 py-2 border text-sm font-medium ${
                                                            link.active
                                                                ? 'z-10 bg-blue-50 border-blue-500 text-blue-600'
                                                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                                                        }`}
                                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                                    />
                                                ) : (
                                                    <span
                                                        key={index}
                                                        className="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-300"
                                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                                    />
                                                )
                                            ))}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}