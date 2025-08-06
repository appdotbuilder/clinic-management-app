import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, Link } from '@inertiajs/react';
import { FormEvent } from 'react';



const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Pasien', href: '/patients' },
    { title: 'Tambah Pasien', href: '/patients/create' },
];

export default function PatientsCreate() {
    const { data, setData, post, processing, errors } = useForm({
        nama: '',
        tanggal_lahir: '',
        jenis_kelamin: '',
        kontak: '',
        alamat: '',
        alergi: '',
        catatan: '',
    });

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();
        post(route('patients.store'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tambah Pasien" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                            ➕ Tambah Pasien Baru
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400">
                            Lengkapi informasi pasien dengan benar
                        </p>
                    </div>
                    <Link
                        href={route('patients.index')}
                        className="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                    >
                        ← Kembali
                    </Link>
                </div>

                {/* Form */}
                <div className="rounded-lg bg-white shadow-sm dark:bg-gray-800">
                    <form onSubmit={handleSubmit} className="p-6">
                        <div className="grid gap-6 md:grid-cols-2">
                            {/* Nama */}
                            <div className="md:col-span-2">
                                <label htmlFor="nama" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Lengkap *
                                </label>
                                <input
                                    type="text"
                                    id="nama"
                                    value={data.nama}
                                    onChange={(e) => setData('nama', e.target.value)}
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                    placeholder="Masukkan nama lengkap pasien"
                                />
                                {errors.nama && (
                                    <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                        {errors.nama}
                                    </p>
                                )}
                            </div>

                            {/* Tanggal Lahir */}
                            <div>
                                <label htmlFor="tanggal_lahir" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Tanggal Lahir *
                                </label>
                                <input
                                    type="date"
                                    id="tanggal_lahir"
                                    value={data.tanggal_lahir}
                                    onChange={(e) => setData('tanggal_lahir', e.target.value)}
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                />
                                {errors.tanggal_lahir && (
                                    <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                        {errors.tanggal_lahir}
                                    </p>
                                )}
                            </div>

                            {/* Jenis Kelamin */}
                            <div>
                                <label htmlFor="jenis_kelamin" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Jenis Kelamin *
                                </label>
                                <select
                                    id="jenis_kelamin"
                                    value={data.jenis_kelamin}
                                    onChange={(e) => setData('jenis_kelamin', e.target.value)}
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                >
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki">👨 Laki-laki</option>
                                    <option value="Perempuan">👩 Perempuan</option>
                                </select>
                                {errors.jenis_kelamin && (
                                    <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                        {errors.jenis_kelamin}
                                    </p>
                                )}
                            </div>

                            {/* Kontak */}
                            <div>
                                <label htmlFor="kontak" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nomor Kontak
                                </label>
                                <input
                                    type="text"
                                    id="kontak"
                                    value={data.kontak}
                                    onChange={(e) => setData('kontak', e.target.value)}
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                    placeholder="Contoh: 081234567890"
                                />
                                {errors.kontak && (
                                    <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                        {errors.kontak}
                                    </p>
                                )}
                            </div>

                            {/* Alamat */}
                            <div>
                                <label htmlFor="alamat" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Alamat
                                </label>
                                <textarea
                                    id="alamat"
                                    rows={3}
                                    value={data.alamat}
                                    onChange={(e) => setData('alamat', e.target.value)}
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                    placeholder="Masukkan alamat lengkap"
                                />
                                {errors.alamat && (
                                    <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                        {errors.alamat}
                                    </p>
                                )}
                            </div>

                            {/* Alergi */}
                            <div className="md:col-span-2">
                                <label htmlFor="alergi" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Alergi yang Diketahui
                                </label>
                                <textarea
                                    id="alergi"
                                    rows={2}
                                    value={data.alergi}
                                    onChange={(e) => setData('alergi', e.target.value)}
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                    placeholder="Sebutkan alergi obat, makanan, atau lainnya"
                                />
                                {errors.alergi && (
                                    <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                        {errors.alergi}
                                    </p>
                                )}
                            </div>

                            {/* Catatan */}
                            <div className="md:col-span-2">
                                <label htmlFor="catatan" className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Catatan Tambahan
                                </label>
                                <textarea
                                    id="catatan"
                                    rows={3}
                                    value={data.catatan}
                                    onChange={(e) => setData('catatan', e.target.value)}
                                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500"
                                    placeholder="Catatan penting lainnya tentang pasien"
                                />
                                {errors.catatan && (
                                    <p className="mt-2 text-sm text-red-600 dark:text-red-400">
                                        {errors.catatan}
                                    </p>
                                )}
                            </div>
                        </div>

                        {/* Submit Button */}
                        <div className="mt-8 flex justify-end space-x-3">
                            <Link
                                href={route('patients.index')}
                                className="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                disabled={processing}
                                className="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
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
                                    '💾 Simpan Data Pasien'
                                )}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </AppLayout>
    );
}