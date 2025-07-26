@extends('layout.auth')

@section('title', 'Login')

@push('styles')
    <style>
        /* Animasi slide background dari kiri ke kanan (login) */
        .bg-slide-left {
            animation: slideBackgroundLeft 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes slideBackgroundLeft {
            from {
                transform: translateX(-100%);
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
            transform: translateX(2px);
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

        /* Success notification above form */
        .form-notification {
            position: absolute;
            top: -60px;
            left: 0;
            right: 0;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 500;
            text-center;
            transform: translateY(-20px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .form-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .form-notification.success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .form-notification.error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        /* Google Button Styles */
        .google-btn {
            transition: all 0.2s ease;
            border: 1px solid #dadce0;
            background: white;
            text-decoration: none !important;
        }

        .google-btn:hover {
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .3), 0 1px 3px 1px rgba(60, 64, 67, .15);
            border-color: #dadce0;
            text-decoration: none !important;
        }

        .google-btn:active {
            background-color: #f8f9fa;
        }

        /* Divider styles */
        .divider {
            position: relative;
            text-align: center;
            margin: 24px 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
            z-index: 1;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            color: #6b7280;
            font-size: 14px;
            position: relative;
            z-index: 2;
            display: inline-block;
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

        <!-- Desktop Home Button - Fixed Position -->
        <div class="hidden lg:block fixed top-6 left-6 z-50">
            <a href="/"
                class="home-btn inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium shadow-sm">
                <svg class="home-btn-icon w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="home-btn-text">Home</span>
            </a>
        </div>

        <div class="flex flex-col lg:flex-row h-screen">
            <!-- Mobile header with logo -->
            <div class="flex lg:hidden items-center justify-between p-6 bg-yellow-50">
                <div class="flex items-center">
                    <img src="{{ asset('storage/images/logo.jpg') }}" alt="SanurFerryPass Logo" class="h-8 w-auto rounded">
                    <a href="/" class="ml-3 text-yellow-900 font-bold text-xl tracking-tight">KopiSKS</a>
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

            <!-- Left side - Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-12">
                <div class="w-full max-w-md relative">
                    <!-- Form Notification -->
                    <div id="form-notification" class="form-notification">
                        <span id="notification-message"></span>
                    </div>

                    <!-- User icon and title -->
                    <div class="flex flex-col items-center mb-8">
                        <div class="w-12 h-12 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-center">Log In</h1>
                        @error('status')
                            <div class="bg-red-300 text-red-600 p-2 text-center border-2 border-red-600 rounded mt-3 w-full">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="mb-4">
                            <input type="email" name="email" id="email" placeholder="Email" required
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200 @error('email') input-error @enderror">
                            @error('email')
                                <small class="text-red-600 block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="Password" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200">
                                <span type="button" onclick="togglePasswordVisibility(this)"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                    <x-tabler-eye-closed />
                                </span>
                            </div>
                            @error('password')
                                <small class="text-red-600 block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex items-center space-x-2 mb-6">
                            <input type="checkbox" id="remember" name="remember"
                                class="text-yellow-600 focus:ring-yellow-500" {{ old('remember', false) ? 'checked' : '' }}>
                            <label for="remember" class="text-sm text-gray-700">Remember me</label>
                        </div>
                        @error('remember')
                            <small class="text-red-800 block">{{ $message }}</small>
                        @enderror

                        <div class="mb-4">
                            <button type="submit"
                                class="w-full py-3 px-4 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-md transition duration-200 flex items-center justify-center">
                                <span id="btn-text">Login</span>
                            </button>
                        </div>
                    </form>

                    <!-- Links -->
                    <div class="mt-6 text-center">
                        <p class="text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}"
                                class="text-yellow-600 hover:underline nav-link">Register</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right side - Image dengan animasi slide -->
            <div class="hidden lg:block lg:w-1/2 relative bg-slide-left">
                <div class="absolute inset-0 bg-black/20 z-10"></div>
                <img src="{{ asset('storage/images/header-bg.jpg') }}" alt="Beach view"
                    class="w-full h-full object-cover">

                <!-- Logo on image side - positioned at top left like on register page -->
                <div class="absolute top-10 left-10 z-30">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/images/logo.jpg') }}" alt="SanurFerryPass Logo"
                            class="h-9 w-auto rounded">
                        <a href="/"
                            class="ml-3 text-yellow-700 font-bold text-xl tracking-tight hover:text-white/80 transition-colors drop-shadow-md">KopiSKS</a>
                    </div>
                </div>

                <!-- Text overlay - perfectly centered -->
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
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function togglePasswordVisibility(button) {
            const passwordInput = button.previousElementSibling;
            const eyeIcon = button;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = @js(svg('tabler-eye'));
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = @js(svg('tabler-eye-closed'));
            }
        }
    </script>
@endpush
