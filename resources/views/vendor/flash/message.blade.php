@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @push('scripts')
            <script>
                let message = "{{ $message['message'] }}",
                    level = "{{ $message['level'] }}";

                swal(message, '', level);
            </script>
        @endpush

        {{-- <div class="shadow-lg
                    alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
             style="position: absolute;
                    right: 2%;
                    z-index: 999999;"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message['message'] !!}
        </div> --}}
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
