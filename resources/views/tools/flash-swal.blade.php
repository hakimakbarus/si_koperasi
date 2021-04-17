<head>
    {{-- <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> --}}
    <link rel='stylesheet' href='{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}'>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
</head>

@if (session()->has('swal_msg'))
    <script>
        notification = @json(session()->pull("swal_msg"));        
        Swal.fire(notification.title, notification.message, notification.type);
        // To prevent showing the notification when on browser back we can do:
        @php 
            session()->forget('swal_msg'); 
        @endphp    
    </script>
@endif