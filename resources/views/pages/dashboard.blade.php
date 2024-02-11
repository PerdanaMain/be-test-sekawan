@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-4">

            <!-- Transactions -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Dashboard</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-primary rounded shadow">
                                            <i class="mdi mdi-trending-up mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Logs</div>
                                        <h5 class="mb-0">{{ count($logs) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-success rounded shadow">
                                            <i class="mdi mdi-account-outline mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Drivers</div>
                                        <h5 class="mb-0">{{ count($drivers) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-warning rounded shadow">
                                            <i class="mdi mdi-cellphone-link mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Vehicles</div>
                                        <h5 class="mb-0">{{ count($vehicles) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-info rounded shadow">
                                            <i class="mdi mdi-currency-usd mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Maintenances</div>
                                        <h5 class="mb-0" id="m-price">
                                            {{ $maintenances }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->

            <!-- Weekly Overview Chart -->
            <div class="col-xl-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Vehicles Maintenance</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="weeklyOverviewChart"></div>

                    </div>
                </div>
            </div>
            <!--/ Weekly Overview Chart -->

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#m-price').text(new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format($('#m-price').text()));
        });
    </script>
@endpush
