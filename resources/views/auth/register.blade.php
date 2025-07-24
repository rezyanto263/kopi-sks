@extends('layout.app')

@section('title', 'Register')

@push('styles')
    <style>
        /* Animasi slide background dari kanan ke kiri (register) */
        .bg-slide-right {
            animation: slideBackgroundRight 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes slideBackgroundRight {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        /* Home Button Styles */
        .home-btn {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .home-btn:hover {
            background: linear-gradient(135deg, var(--primary-brown) 0%, var(--primary-brown) 100%);
            border-color: var(--primary-brown);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .home-btn:hover .home-btn-icon {
            color: white;
            transform: translateX(-2px);
        }

        .home-btn:hover .home-btn-text {
            color: white;
        }

        .home-btn-icon {
            transition: all 0.3s ease;
            color: #64748b;
        }

        .home-btn-text {
            transition: all 0.3s ease;
            color: #475569;
            font-weight: 500;
        }

        /* Mobile Home Button */
        .mobile-home-btn {
            background: white;
            border: 1px solid var(--primary-brown);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .mobile-home-btn:hover {
            background-color: var(--primary-brown);
            color: white;
        }

        /* Hover effect untuk navigasi */
        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateX(-2px);
        }

        /* Toast Notification Styles */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 300px;
            max-width: 400px;
            padding: 16px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transform: translateX(400px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            background: linear-gradient(135deg, #28a745, #26ff4e);
        }

        .toast.error {
            background: linear-gradient(135deg, #e41b1b, #dc2626);
        }

        .toast.warning {
            background: linear-gradient(135deg, #f5d60b, #d97706);
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 24px;
            max-width: 400px;
            width: 90%;
            transform: scale(0.7);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: scale(1);
        }

        /* Loading Button */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Form validation styles */
        .input-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }

        .error-message.show {
            display: block;
        }
    </style>
@endpush

@section('content')
<main class="bg-white">
    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="flex items-center">
            <div id="toast-icon" class="mr-3">
                <!-- Icon will be inserted here -->
            </div>
            <div>
                <div id="toast-title" class="font-semibold"></div>
                <div id="toast-message" class="text-sm opacity-90"></div>
            </div>
            <button onclick="hideToast()" class="ml-auto text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Registration Success!</h3>
            <p class="text-gray-600 mb-6">Your account has been created successfully. Click OK to log in.</p>
            <button onclick="redirectToLogin()"
                class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                OK
            </button>
        </div>
    </div>

    <!-- Desktop Home Button - Fixed Position -->
    <div class="hidden md:block fixed top-6 right-6 z-50">
        <a href="/"
            class="home-btn inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium shadow-sm">
            <svg class="home-btn-icon w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="home-btn-text">Home</span>
        </a>
    </div>

    <div class="flex flex-col md:flex-row h-screen">
        <!-- Mobile header with logo (hidden on desktop) -->
        <div class="flex md:hidden items-center justify-between p-6 bg-yellow-50">
            <div class="flex items-center">
                <img src="{{ asset('storage/images/logo.jpg') }}" alt="KopiSKS Logo" class="h-8 w-auto rounded">
                <a href="/" class="ml-3 text-yellow-500 font-bold text-xl tracking-tight">KopiSKS</a>
            </div>
            <!-- Mobile Home Button -->
            <a href="/"
                class="mobile-home-btn inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-yellow-600">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="font-medium">Home</span>
            </a>
        </div>

        <!-- Left side - Image (hidden on mobile) dengan animasi slide -->
        <div class="hidden md:block md:w-1/2 relative bg-slide-right">
            <div class="absolute inset-0 bg-black/20 z-10"></div>
            <img src="{{ asset('storage/images/header-bg.jpg') }}" alt="Beach view" class="w-full h-full object-cover">

            <!-- Logo - positioned at top left with proper z-index -->
            <div class="absolute top-10 left-10 z-30">
                <div class="flex items-center">
                    <img src="{{ asset('storage/images/logo.jpg') }}" alt="KopiSKS Logo" class="h-9 w-auto rounded">
                    <a href="/"
                        class="ml-3 text-yellow-900 font-bold text-xl tracking-tight hover:text-white/80 transition-colors drop-shadow-md">KopiSKS</a>
                </div>
            </div>

            <!-- Text overlay with card styling - perfectly centered -->
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl max-w-md mx-auto border border-yellow-900">
                    <h2 class="text-4xl font-bold text-white mb-4">PRACTICAL<br>ACCESS TO<br>DREAM ISLANDS</h2>
                    <p class="text-white/80">
                        Our boat ticket booking system is specifically designed to meet the needs of boat operators and
                        travel businesses.
                    </p>
                </div>
            </div>
        </div>

        <!-- Right side - Form (full width on mobile) -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-6 md:p-12">
            <div class="w-full max-w-md px-4 relative">
                <!-- User icon and title -->
                <div class="flex flex-col items-center mb-8">
                    <div class="w-12 h-12 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-center">Register</h1>
                </div>

                <!-- Registration Form -->
                <form id="register-form" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <input type="email" name="email" id="email" placeholder="Email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200">
                        <div id="email-error" class="error-message"></div>
                    </div>

                    <div>
                        <input type="text" name="nama" id="nama" placeholder="Nama" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200">
                        <div id="nama-error" class="error-message"></div>
                    </div>

                    <div>
                        <input type="text" name="no_telp" id="no_telp" placeholder="Nomor Telepon" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200">
                        <div id="no_telp-error" class="error-message"></div>
                    </div>

                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200">
                        <button type="button" onclick="togglePasswordVisibility()"
                            class="absolute right-3 top-1/2 transform -translate-y-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-5 h-5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                        <div id="password-error" class="error-message"></div>
                    </div>

                    <div>
                        <button type="submit" id="register-btn"
                            class="w-full py-3 px-4 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-md transition duration-200 flex items-center justify-center">
                            <span id="btn-text">Register</span>
                        </button>
                    </div>
                </form>

                <!-- Links -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-yellow-600 hover:underline nav-link">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }

    // Toast notification functions
    function showToast(type, title, message) {
        const toast = document.getElementById('toast');
        const toastIcon = document.getElementById('toast-icon');
        const toastTitle = document.getElementById('toast-title');
        const toastMessage = document.getElementById('toast-message');

        // Set icon based on type
        let icon = '';
        if (type === 'success') {
            icon =
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
        } else if (type === 'error') {
            icon =
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
        } else if (type === 'warning') {
            icon =
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>';
        }

        toastIcon.innerHTML = icon;
        toastTitle.textContent = title;
        toastMessage.textContent = message;

        toast.className = `toast ${type}`;
        setTimeout(() => toast.classList.add('show'), 100);

        // Auto hide after 5 seconds
        setTimeout(() => {
            hideToast();
        }, 5000);
    }

    function hideToast() {
        const toast = document.getElementById('toast');
        toast.classList.remove('show');
    }

    // Modal functions
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('show');
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('show');
    }

    function redirectToLogin() {
        hideModal('successModal');
        setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 300);
    }

    // Form validation
    function clearErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        const inputElements = document.querySelectorAll('input');

        errorElements.forEach(el => {
            el.classList.remove('show');
            el.textContent = '';
        });

        inputElements.forEach(el => {
            el.classList.remove('input-error');
        });
    }

    function showFieldError(fieldName, message) {
        const input = document.getElementById(fieldName);
        const errorDiv = document.getElementById(fieldName + '-error');

        if (input && errorDiv) {
            input.classList.add('input-error');
            errorDiv.textContent = message;
            errorDiv.classList.add('show');
        }
    }

    // Loading state
    function setLoading(isLoading) {
        const btn = document.getElementById('register-btn');
        const btnText = document.getElementById('btn-text');

        if (isLoading) {
            btn.classList.add('btn-loading');
            btn.disabled = true;
            btnText.textContent = 'processing...';
        } else {
            btn.classList.remove('btn-loading');
            btn.disabled = false;
            btnText.textContent = 'Register';
        }
    }

    document.getElementById('register-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        clearErrors();
        setLoading(true);

        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const no_telp = document.getElementById('no_telp').value;
        const password = document.getElementById('password').value;

        try {
            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    nama,
                    email,
                    no_telp,
                    password
                })
            });

            const data = await response.json();

            if (response.ok) {
                showModal('successModal');
            } else {
                if (data.errors) {
                    // Show field-specific errors
                    Object.keys(data.errors).forEach(field => {
                        showFieldError(field, data.errors[field][0]);
                    });
                    showToast('error', 'Validasi Gagal', 'Periksa kembali data yang Anda masukkan');
                } else {
                    showToast('error', 'Registrasi Gagal', data.message ||
                        'Terjadi kesalahan saat registrasi');
                }
            }
        } catch (error) {
            console.error('Register Error:', error);
            showToast('error', 'Kesalahan Sistem', 'Terjadi kesalahan koneksi. Silakan coba lagi.');
        } finally {
            setLoading(false);
        }
    });

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal')) {
            e.target.classList.remove('show');
        }
    });
</script>
@endpush
