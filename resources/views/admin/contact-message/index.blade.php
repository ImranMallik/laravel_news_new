@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Received Contact Message') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Contact Message List') }}</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('Message') }}</th>
                                <th>{{ __('Is Replied') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receivedMails as $receivedMail)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $receivedMail->email }}</td>
                                    <td>{{ $receivedMail->subject }}</td>
                                    <td>{{ Str::limit($receivedMail->message, 50) }}</td>
                                    <td>
                                        @if ($receivedMail->replied)
                                            <i style="font-size:20px" class="fas fa-check text-success"></i>
                                        @else
                                            <i style="font-size:20px" class="fas fa-clock text-warning"></i>
                                        @endif

                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal-{{ $receivedMail->id }}">
                                            <i class="fas fa-envelope"></i>
                                        </button>



                                        <a href="#" class="btn btn-danger delete-item" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section>

    @foreach ($receivedMails as $receivedMail)
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal-{{ $receivedMail->id }}"
            aria-labelledby="exampleModalLabel-{{ $receivedMail->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.user-contract-message.reply') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel-{{ $receivedMail->id }}">
                                {{ __('Reply to: ') . $receivedMail->email }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __('Subject') }}</label>
                                <input type="hidden" name="email" value="{{ $receivedMail->email }}">
                                <input type="hidden" name="mail_id" value="{{ $receivedMail->id }}">
                                <input type="text" name="subject" class="form-control">
                                @error('subject')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('Message') }}</label>
                                <textarea name="reply" class="form-control" style="height:200px !important"></textarea>
                                @error('reply')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Send Reply') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#table').DataTable({
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                        orderable: false,
                        targets: [4]
                    },
                    {
                        className: 'text-center',
                        targets: [0, 4]
                    }
                ]
            });
        });
    </script>
@endpush
