@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Subscribers') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Send Mail To Subscribers') }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.subscriber.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subject">{{ __('Subject') }}</label>
                        <input type="text" class="form-control" name="subject" id="subject">
                        @error('subject')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">{{ __('Message') }}</label>
                        <textarea class="summernote" name="message" id="message" rows="10" cols="30"></textarea>
                        @error('message')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                </form>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <h1>{{ __('Subscriber') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Subscribers') }}</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscribers as $subscriber)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $subscriber->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.subscriber.destroy', $subscriber->id) }}"
                                            class="btn btn-danger delete-item" title="Delete">
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
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#table').DataTable({
                columnDefs: [{
                        orderable: false,
                        targets: [2]
                    },
                    {
                        className: 'text-center',
                        targets: [0]
                    }
                ]
            });
        });
    </script>
@endpush
