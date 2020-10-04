@if (session('status'))
    <script>
        var message = '{{session('message')}}';
        var status = '{{session('status')}}';
        swal(message, {
            buttons: false,
            timer: 1500,
            icon: status
        });
    </script>
@endif
