import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Sistem Manajemen Klinik">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-gradient-to-br from-blue-50 to-indigo-100 p-6 text-gray-900 lg:justify-center lg:p-8 dark:from-gray-900 dark:to-gray-800 dark:text-gray-100">
                <header className="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
                    <nav className="flex items-center justify-end gap-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="inline-block rounded-lg border border-blue-300 bg-blue-600 px-6 py-2 text-sm font-medium text-white shadow-md transition-all hover:bg-blue-700 hover:shadow-lg dark:border-blue-600 dark:bg-blue-700 dark:hover:bg-blue-600"
                            >
                                Dashboard
                            </Link>
                        ) : (
                            <Link
                                href={route('login')}
                                className="inline-block rounded-lg border border-transparent px-5 py-2 text-sm font-medium text-gray-700 transition-all hover:bg-white hover:shadow-md dark:text-gray-300 dark:hover:bg-gray-800"
                            >
                                Masuk
                            </Link>
                        )}
                    </nav>
                </header>
                
                <div className="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow">
                    <main className="flex w-full max-w-6xl flex-col lg:flex-row lg:gap-12">
                        {/* Main Content */}
                        <div className="flex-1 rounded-2xl bg-white p-8 shadow-xl lg:p-12 dark:bg-gray-800">
                            <div className="text-center">
                                <div className="mb-6 text-6xl">🏥</div>
                                <h1 className="mb-4 text-4xl font-bold text-gray-900 lg:text-5xl dark:text-white">
                                    Sistem Manajemen Klinik
                                </h1>
                                <p className="mb-8 text-lg text-gray-600 lg:text-xl dark:text-gray-300">
                                    Kelola data pasien, kunjungan, dan administrasi klinik dengan mudah dan efisien
                                </p>

                                {/* Features Grid */}
                                <div className="mb-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                    <div className="rounded-lg bg-blue-50 p-6 dark:bg-blue-900/20">
                                        <div className="mb-3 text-3xl">👥</div>
                                        <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">
                                            Manajemen Pasien
                                        </h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            Data lengkap pasien, riwayat medis, dan informasi kontak
                                        </p>
                                    </div>

                                    <div className="rounded-lg bg-green-50 p-6 dark:bg-green-900/20">
                                        <div className="mb-3 text-3xl">📋</div>
                                        <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">
                                            Pencatatan Kunjungan
                                        </h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            Rekam jejak kunjungan pasien dengan timestamp otomatis
                                        </p>
                                    </div>

                                    <div className="rounded-lg bg-purple-50 p-6 dark:bg-purple-900/20">
                                        <div className="mb-3 text-3xl">👨‍⚕️</div>
                                        <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">
                                            Multi-Role Access
                                        </h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            Akses berbeda untuk Admin, Dokter, dan Resepsionis
                                        </p>
                                    </div>
                                </div>

                                {/* Action Buttons */}
                                {!auth.user && (
                                    <div className="flex flex-col gap-4 sm:flex-row sm:justify-center">
                                        <Link
                                            href={route('login')}
                                            className="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-3 text-base font-medium text-white shadow-lg transition-all hover:bg-blue-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                        >
                                            🔐 Masuk ke Sistem
                                        </Link>
                                    </div>
                                )}

                                {auth.user && (
                                    <div className="flex flex-col gap-4 sm:flex-row sm:justify-center">
                                        <Link
                                            href={route('dashboard')}
                                            className="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-3 text-base font-medium text-white shadow-lg transition-all hover:bg-blue-700 hover:shadow-xl"
                                        >
                                            📊 Buka Dashboard
                                        </Link>
                                        <Link
                                            href={route('patients.index')}
                                            className="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-8 py-3 text-base font-medium text-gray-700 shadow-md transition-all hover:bg-gray-50 hover:shadow-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
                                        >
                                            👥 Data Pasien
                                        </Link>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Side Panel - Stats or Demo */}
                        <div className="mt-8 w-full lg:mt-0 lg:w-80">
                            <div className="rounded-2xl bg-white p-6 shadow-xl dark:bg-gray-800">
                                <h3 className="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                                    ✨ Fitur Utama
                                </h3>
                                <ul className="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                                    <li className="flex items-center">
                                        <span className="mr-2 text-green-500">✓</span>
                                        Data pasien lengkap dengan alergi dan catatan
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-2 text-green-500">✓</span>
                                        Pencatatan kunjungan real-time
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-2 text-green-500">✓</span>
                                        Dashboard khusus setiap role
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-2 text-green-500">✓</span>
                                        Interface dalam Bahasa Indonesia
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-2 text-green-500">✓</span>
                                        Keamanan login terintegrasi
                                    </li>
                                    <li className="flex items-center">
                                        <span className="mr-2 text-green-500">✓</span>
                                        Responsive design untuk semua device
                                    </li>
                                </ul>
                                
                                <div className="mt-6 rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
                                    <p className="text-xs text-blue-800 dark:text-blue-200">
                                        💡 <strong>Tips:</strong> Sistem ini dirancang khusus untuk 
                                        memudahkan pengelolaan klinik dengan workflow yang efisien
                                    </p>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>

                <footer className="mt-12 text-center text-sm text-gray-500 dark:text-gray-400">
                    <p>
                        Dibuat dengan 💙 untuk kemudahan pengelolaan klinik modern
                    </p>
                </footer>
            </div>
        </>
    );
}