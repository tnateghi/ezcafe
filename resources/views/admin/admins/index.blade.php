@extends('admin.layouts.app')

@section('content')
    <main id="main-container">

        <!-- Page Content -->
        <div class="content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">لیست مدیرها</h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>نام کاربری</th>
                                    <th>شماره تلفن</th>
                                    <th class="text-center">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td class="text-center fs-sm">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="fs-sm">{{ $admin->name }}</td>
                                        <td class="fs-sm">{{ $admin->username }}</td>
                                        <td class="fs-sm">{{ $admin->mobile }}</td>
                                        <td class="text-center fs-sm">

                                            @if ($admin->id != 1)
                                                <a class="btn btn-sm btn-alt-secondary" href="{{ route('admin.admins.edit', ['admin' => $admin]) }}">
                                                    <i class="fa fa-fw fa-pencil"></i>
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-alt-secondary" disabled>
                                                    <i class="fa fa-fw fa-pencil"></i>
                                                </button>
                                            @endif

                                            @if ($admin->id != auth('admin')->id() && $admin->id != 1)
                                                <a class="btn btn-sm btn-alt-secondary delete-admin" data-url="{{ route('admin.admins.destroy', ['admin' => $admin]) }}" href="javascript:void(0)">
                                                    <i class="fa fa-fw fa-times text-danger"></i>
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-alt-secondary" disabled>
                                                    <i class="fa fa-fw fa-times text-danger"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted py-4">چیزی برای نمایش وجود ندارد!</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $admins->links() }}
                    <!-- END Pagination -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('assets/admin/js/pages/admins/index.js') }}"></script>
@endpush
