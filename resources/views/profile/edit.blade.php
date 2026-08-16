@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3" 
                     style="background: #d1fae5; color: #065f46; padding: 16px 20px; border-left: 4px solid #10b981; font-size: 0.9rem; box-shadow: 0 2px 10px rgba(16, 185, 129, 0.1);" 
                     role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2" style="font-size: 1.2rem; color: #10b981;"></i>
                        <strong>{{ session('success') }}</strong>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" 
                            style="position: absolute; right: 12px; top: 12px;"></button>
                </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3" 
                     style="background: #f8d7da; color: #721c24; padding: 16px 20px; border-left: 4px solid #ef4444; font-size: 0.85rem;">
                    <i class="fas fa-exclamation-circle me-2"></i> 
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1" style="padding-left: 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- First Card - Update Profile Information -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Second Card - Update Password -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Third Card - Delete User -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Success Message -->
    <style>
        .alert-success {
            position: relative;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success .btn-close {
            filter: brightness(0) saturate(100%) invert(29%) sepia(91%) saturate(376%) hue-rotate(155deg) brightness(92%) contrast(92%);
        }

        [data-theme="dark"] .alert-success {
            background: rgba(16, 185, 129, 0.15) !important;
            color: #6ee7b7 !important;
            border-left-color: #10b981 !important;
        }

        [data-theme="dark"] .alert-success .btn-close {
            filter: brightness(0) saturate(100%) invert(88%) sepia(45%) saturate(441%) hue-rotate(95deg) brightness(92%) contrast(91%);
        }

        [data-theme="dark"] .alert-danger {
            background: rgba(239, 68, 68, 0.15) !important;
            color: #fca5a5 !important;
            border-left-color: #ef4444 !important;
        }
    </style>

    <!-- JavaScript for Auto-dismiss -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
           
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(successAlert);
                    bsAlert.close();
                }, 5000);
            }
        });
    </script>
@endsection