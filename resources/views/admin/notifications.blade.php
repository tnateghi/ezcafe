@extends('admin.layouts.app')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">اعلان ها</h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="timeline timeline-alt">

                        @foreach ($notifications as $notification)
                            @php
                                switch ($notification->type) {
                                    case 'Admin/AdCreated':
                                        $data['icon'] = 'fa fa-bullhorn';
                                        $data['title'] = $notification->data['title'];

                                        break;
                                    case 'Admin/OrderCreated':
                                        $data['icon'] = 'fa fa-book';
                                        $data['title'] = $notification->data['title'];

                                        break;
                                    case 'Admin/UserRegistered':
                                        $data['icon'] = 'fa fa-user';
                                        $data['title'] = $notification->data['title'];

                                        break;
                                    case 'Admin/TicketCreated':
                                        $data['icon'] = 'fa fa-comments';
                                        $data['title'] = $notification->data['title'];

                                        break;

                                    default:
                                        $data['icon'] = 'fa fa-message';
                                        $data['title'] = $notification->data['title'];
                                }

                            @endphp
                            <!-- Single Event -->
                            <li class="timeline-event">
                                <div class="timeline-event-icon bg-default">
                                    <i class="{{ $data['icon'] ?? 'fa fa-message' }}"></i>
                                </div>
                                <div class="timeline-event-block block block-rounded">
                                    <div class="block-content {{ $notification->read_at ? '' : 'bg-xeco-light text-white' }}">
                                        <p>{{ $data['title'] }}</p>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div title="{{ jdate($notification->created_at) }}" class="timeline-event-time block-options-item fs-sm fw-semibold">
                                                {{ jdate($notification->created_at)->ago() }}
                                            </div>
                                            <a class="btn btn-sm btn-alt-secondary" href="{{ route('admin.readNotification', ['notification' => $notification]) }}">مشاهده</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- END Single Event -->
                        @endforeach

                    </ul>

                </div>
            </div>
            <!-- END Timeline -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
