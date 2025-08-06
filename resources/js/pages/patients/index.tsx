import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

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
    visits_count?: number;
}

interface PaginatedPatients {
    data: Patient[];
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
    patients: PaginatedPatients;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Pasien', href: '/patients' },
];

export default function PatientsIndex({ patients }: Props) {
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

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Pasien" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                            👥 Data Pasien
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400">
                            Kelola informasi pasien klinik
                        </p>
                    </div>
                    <Link
                        href={route('patients.create')}
                        className="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        ➕ Tambah Pasien
                    </Link>
                </div>

                {/* Stats */}
                <div className="grid gap-4 md:grid-cols-3">
                    <div className="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="mr-3 text-2xl">👥</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Pasien
                                </p>
                                <p className="text-xl font-bold text-gray-900 dark:text-white">
                                    {patients.total}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div className="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="mr-3 text-2xl">👨</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Laki-laki
                                </p>
                                <p className="text-xl font-bold text-gray-900 dark:text-white">
                                    {patients.data.filter(p => p.jenis_kelamin === 'Laki-laki').length}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div className="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800">
                        <div className="flex items-center">
                            <div className="mr-3 text-2xl">👩</div>
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Perempuan
                                </p>
                                <p className="text-xl font-bold text-gray-900 dark:text-white">
                                    {patients.data.filter(p => p.jenis_kelamin === 'Perempuan').length}
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
                                        Nama Pasien
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Umur
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Jenis Kelamin
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Kontak
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                                {patients.data.length > 0 ? (
                                    patients.data.map((patient) => (
                                        <tr key={patient.id} className="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="flex items-center">
                                                    <div className="mr-3 text-lg">
                                                        {patient.jenis_kelamin === 'Laki-laki' ? '👨' : '👩'}
                                                    </div>
                                                    <div>
                                                        <div className="text-sm font-medium text-gray-900 dark:text-white">
                                                            {patient.nama}
                                                        </div>
                                                        {patient.alergi && (
                                                            <div className="text-xs text-red-600 dark:text-red-400">
                                                                ⚠️ Alergi: {patient.alergi}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                {calculateAge(patient.tanggal_lahir)} tahun
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <span className={`inline-flex rounded-full px-2 text-xs font-semibold leading-5 ${
                                                    patient.jenis_kelamin === 'Laki-laki' 
                                                        ? 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100' 
                                                        : 'bg-pink-100 text-pink-800 dark:bg-pink-800 dark:text-pink-100'
                                                }`}>
                                                    {patient.jenis_kelamin}
                                                </span>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                {patient.kontak || '-'}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div className="flex space-x-2">
                                                    <Link
                                                        href={route('patients.show', patient.id)}
                                                        className="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                    >
                                                        👁️ Lihat
                                                    </Link>
                                                    <Link
                                                        href={route('patients.edit', patient.id)}
                                                        className="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                                    >
                                                        ✏️ Edit
                                                    </Link>
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan={5} className="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Belum ada data pasien
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    {patients.last_page > 1 && (
                        <div className="border-t border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800">
                            <div className="flex items-center justify-between">
                                <div className="flex-1 flex justify-between sm:hidden">
                                    {patients.links.find(link => link.label === 'Previous')?.url && (
                                        <Link
                                            href={patients.links.find(link => link.label === 'Previous')?.url || ''}
                                            className="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Previous
                                        </Link>
                                    )}
                                    {patients.links.find(link => link.label === 'Next')?.url && (
                                        <Link
                                            href={patients.links.find(link => link.label === 'Next')?.url || ''}
                                            className="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Next
                                        </Link>
                                    )}
                                </div>
                                <div className="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p className="text-sm text-gray-700 dark:text-gray-300">
                                            Halaman <span className="font-medium">{patients.current_page}</span> dari{' '}
                                            <span className="font-medium">{patients.last_page}</span>
                                        </p>
                                    </div>
                                    <div>
                                        <nav className="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                            {patients.links.map((link, index) => (
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