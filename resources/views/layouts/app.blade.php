@extends('adminlte::page')

{{-- Extend and customize the browser title --}}

@section('title')
    @php
        $setting = ['get' => fn($k, $d = null) => \App\Models\Setting::get($k, $d)];
    @endphp
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right d-print-none">
        Version: {{ config('app.version', '1.0.0') }}
    </div>

    <strong class=" d-print-none    ">
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong>
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
    <script>
        $(document).ready(function() {
            Livewire.on('show-toast', (event) => {



                const {
                    message,
                    type
                } = event[0];


                const toastType = type || 'success';
                const toastMessage = message || 'Something went wrong!';


                const toastHTML = `
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="position: fixed; top: 1rem; right: 1rem; min-width: 250px; z-index: 1060;">
                        <div class="toast-header bg-${toastType} text-white">
                            <strong class="mr-auto">Notification</strong>
                            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            ${toastMessage}
                        </div>
                    </div>`;
                document.body.insertAdjacentHTML('beforeend', toastHTML);
                const toastElement = document.querySelector('.toast');
                const toast = new bootstrap.Toast(toastElement);
                toast.show();
            });

        });
    </script>
    @livewireScripts
@endpush

{{-- Add common CSS customizations --}}

@push('css')

<style>
        .bg {
            background: linear-gradient(135deg, #12c738 0%, #0099b8 100%);
        }
        .nav-sidebar .nav-item>.nav-link {
            position: relative;
            color: white;
        }
</style>
    @livewireStyles

@endpush
