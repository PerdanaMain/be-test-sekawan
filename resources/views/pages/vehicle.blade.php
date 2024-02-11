@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Vehicles</h4>

        {{-- vehicle main table --}}
        <div class="card">
            <h5 class="card-header">Vehicles Table</h5>

            <div class="card-body">
                <button type="button" class="btn btn-primary mb-3 d-block" data-bs-toggle="modal"
                    data-bs-target="#vehicleModal">
                    Add Vehicle
                </button>

                <!-- Create Modal -->
                <div class="modal fade" id="vehicleModal" tabindex="-1" aria-labelledby="vehicleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vehicleModalLabel">Add Vehicle</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('vehicles.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="vehicleName" class="form-label">Vehicle Name</label>
                                            <input type="text" class="form-control" id="vehicleName" name="vehicle_name"
                                                placeholder="Enter Vehicle Name" />
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="vehicleVin" class="form-label">Vehicle VIN</label>
                                            <input type="text" class="form-control" id="vehicleVin" name="vehicle_vin"
                                                placeholder="Enter Vehicle VIN" />
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <label for="vehiclePicture" class="form-label">Vehicle Picture</label>
                                            <input type="file" class="form-control" id="vehiclePicture"
                                                name="vehicle_picture" />
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="vehicleVin" class="form-label">Vehicle Year Built</label>
                                            <input type="text" class="form-control" id="vehicle_year" name="vehicle_year"
                                                placeholder="Enter Vehicle Year Built" />
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="vehicleVin" class="form-label">Vehicle Price</label>
                                            <input type="text" class="form-control" id="vehicle_price"
                                                name="vehicle_price" placeholder="Enter Vehicle Price" />
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="vehicle_fuel" class="form-label">Vehicle Fuel</label>
                                            <select class="form-select" id="vehicle_fuel" name="vehicle_fuel">
                                                <option hidden>Select Fuel</option>
                                                <option value="Bensin">Bensin</option>
                                                <option value="Solar">Solar</option>

                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="vehicleStatus" class="form-label">Vehicle Category</label>
                                            <select class="form-select" id="vehicleStatus" name="category_id">
                                                <option hidden>Select Status</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->category_id }}">{{ $c->category_desc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="vehicleStatus" class="form-label">Vehicle Type</label>
                                            <select class="form-select" id="vehicleStatus" name="type_id">
                                                <option hidden>Select Types</option>
                                                @foreach ($types as $t)
                                                    <option value="{{ $t->type_id }}">{{ $t->type_desc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="vehicleStatus" class="form-label">Driver</label>
                                            <select class="form-select" id="vehicleStatus" name="driver_id">
                                                <option hidden>Select Driver</option>
                                                @foreach ($drivers as $d)
                                                    <option value="{{ $d->driver_id }}">
                                                        {{ $d->driver_name }} - {{ $d->driver_phone }} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- make textarea --}}
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <label for="vehicleDescription" class="form-label">Vehicle Usage</label>
                                            <textarea class="form-control" id="vehicleDescription" name="log_desc" rows="3"></textarea>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Create Modal -->

                <div class="container table-responsive text-nowrap pb-4 pt-2">
                    <table class="table" id="vehicle-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Picture</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Number</th>
                                <th class="text-center">Submitted At</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($vehicles as $v)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $v->vehicle_picture) }}"
                                            alt="Vehicle Picture" class="rounded img-fluid" width="50"
                                            height="50" />
                                    </td>
                                    <td>{{ $v->vehicle_name }}</td>
                                    <td>{{ $v->vehicle_vin }}</td>
                                    <td>{{ $v->created_at->format('d M, Y, H:i') }}</td>
                                    <td class="text-center">
                                        @if ($v->status_id == 1)
                                            <span class="badge rounded-pill bg-label-warning">
                                                {{ $v->status_desc }}
                                            </span>
                                        @elseif ($v->status_id == 2)
                                            <span class="badge rounded-pill bg-label-primary">
                                                {{ $v->status_desc }}
                                            </span>
                                        @elseif ($v->status_id == 3)
                                            <span class="badge rounded-pill bg-label-success">
                                                {{ $v->status_desc }}
                                            </span>
                                        @elseif ($v->status_id == 4)
                                            <span class="badge rounded-pill bg-label-danger">
                                                {{ $v->status_desc }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @if ($v->status_id == 1 || $v->status_id == 2)
                                                    @if ($user['role_id'] != 1)
                                                        <button type="button" class="dropdown-item"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#infoVehicle{{ $v->vehicle_id }}">
                                                            <i class="mdi mdi-information-outline me-2"></i> Info
                                                        </button>

                                                        <button type="submit" class="dropdown-item"
                                                            data-bs-target="#approvalVehicle{{ $v->vehicle_id }}"
                                                            data-bs-toggle="modal"><i
                                                                class="mdi mdi-check-outline me-2"></i>
                                                            Approval</button>
                                                    @else
                                                        @if ($v->status_id == 2)
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#infoVehicle{{ $v->vehicle_id }}">
                                                                <i class="mdi mdi-information-outline me-2"></i> Info
                                                            </button>
                                                        @else
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#infoVehicle{{ $v->vehicle_id }}">
                                                                <i class="mdi mdi-information-outline me-2"></i> Info
                                                            </button>

                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#updateVehicle{{ $v->vehicle_id }}">
                                                                <i class="mdi mdi-pencil-outline me-2"></i> Edit
                                                            </button>

                                                            <button type="button" class="dropdown-item"
                                                                data-bs-target="#deleteVehicle{{ $v->vehicle_id }}"
                                                                data-bs-toggle="modal"><i
                                                                    class="mdi mdi-trash-can-outline me-2"></i>
                                                                Delete</button>
                                                        @endif
                                                    @endif
                                                @else
                                                    @if ($user['role_id'] != 1)
                                                        <button type="button" class="dropdown-item"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#infoVehicle{{ $v->vehicle_id }}">
                                                            <i class="mdi mdi-information-outline me-2"></i> Info
                                                        </button>
                                                    @else
                                                        @if ($v->status_id == 4)
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#infoVehicle{{ $v->vehicle_id }}">
                                                                <i class="mdi mdi-information-outline me-2"></i> Info
                                                            </button>

                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#updateVehicle{{ $v->vehicle_id }}">
                                                                <i class="mdi mdi-pencil-outline me-2"></i> Edit
                                                            </button>
                                                        @else
                                                            <button type="button" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#infoVehicle{{ $v->vehicle_id }}">
                                                                <i class="mdi mdi-information-outline me-2"></i> Info
                                                            </button>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Info Modal -->
                                <div class="modal fade" id="infoVehicle{{ $v->vehicle_id }}" tabindex="-1"
                                    aria-labelledby="infoVehicle{{ $v->vehicle_id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="infoVehicle{{ $v->vehicle_id }}Label">
                                                    {{ $v->vehicle_name }} Info </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="text-center">
                                                            <img src="{{ asset('storage/images/' . $v->vehicle_picture) }}"
                                                                alt="Vehicle Picture" class="img-fluid rounded mb-3"
                                                                style="max-height: 300px; max-width: 100%" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="status"
                                                                    class="form-label fw-bold">Status</label>
                                                                <p style="overflow: hidden;
                                                                    text-overflow: ellipsis;
                                                                    white-space: nowrap;
                                                                    max-width: 100%;"
                                                                    class="rounded-pill
                                                                    {{ $v->status_id == 1 ? 'bg-label-warning' : ($v->status_id == 2 ? 'bg-label-primary' : ($v->status_id == 3 ? 'bg-label-success' : ($v->status_id == 4 ? 'bg-label-danger' : ''))) }}
                                                                    ps-3">
                                                                    {{ $v->status_desc }}
                                                                </p>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="status"
                                                                    class="form-label fw-bold">Number</label>
                                                                <p>
                                                                    {{ $v->vehicle_vin }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6"><label for="vehicleName"
                                                                    class="form-label fw-bold">Vehicle
                                                                    Name</label>
                                                                <p>{{ $v->vehicle_name }}</p>
                                                            </div>
                                                            <div class="col-md-6"><label for="vehicleName"
                                                                    class="form-label fw-bold">Vehicle
                                                                    Price</label>
                                                                <p id="v-price">{{ $v->vehicle_price }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6"><label for="vehicleName"
                                                                    class="form-label fw-bold">Vehicle
                                                                    Fuel</label>
                                                                <p>{{ $v->vehicle_fuel }}</p>
                                                            </div>
                                                            <div class="col-md-6"><label for="vehicleName"
                                                                    class="form-label fw-bold">Vehicle
                                                                    Year</label>
                                                                <p>{{ $v->vehicle_year }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6"><label for="vehicleName"
                                                                    class="form-label fw-bold">Vehicle
                                                                    Category</label>
                                                                <p>{{ $v->category_desc }}</p>
                                                            </div>
                                                            <div class="col-md-6"><label for="vehicleName"
                                                                    class="form-label fw-bold">Vehicle Usage</label>
                                                                <p
                                                                    style="overflow: hidden;
                                                                text-overflow: ellipsis;
                                                                white-space: nowrap;
                                                                max-width: 100%;">
                                                                    @if ($v->logs != null)
                                                                        {{ $v->logs->log_desc }}
                                                                    @else
                                                                        No Usage found.
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6"><label for="vehicleName"
                                                                    class="form-label fw-bold">Vehicle
                                                                    Type</label>
                                                                <p>{{ $v->type_desc }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="vehicleName" class="form-label fw-bold">Driver
                                                                    name</label>
                                                                <p>{{ $v->driver_name }}</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Info Modal -->

                                <!-- Update Modal -->
                                <div class="modal fade" id="updateVehicle{{ $v->vehicle_id }}" tabindex="-1"
                                    aria-labelledby="updateVehicle{{ $v->vehicle_id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateVehicle{{ $v->vehicle_id }}Label">
                                                    Update {{ $v->vehicle_name }} Vechicle </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('vehicles.update', ['vId' => $v->vehicle_id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12 mb-3">
                                                            <label for="vehicleName" class="form-label">Vehicle
                                                                Name</label>
                                                            <input type="text" class="form-control" id="vehicleName"
                                                                name="vehicle_name" placeholder="Enter Vehicle Name"
                                                                value="{{ $v->vehicle_name }}" />
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 mb-3">
                                                            <label for="vehicleVin" class="form-label">Vehicle
                                                                VIN</label>
                                                            <input type="text" class="form-control" id="vehicleVin"
                                                                name="vehicle_vin" placeholder="Enter Vehicle VIN"
                                                                value="{{ $v->vehicle_vin }}" />
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 mb-3">
                                                            <label for="vehiclePicture" class="form-label">Vehicle
                                                                Picture</label>
                                                            <input type="file" class="form-control"
                                                                id="vehiclePicture" name="vehicle_picture" />
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 mb-3">
                                                            <label for="vehicleVin" class="form-label">Vehicle
                                                                Year
                                                                Built</label>
                                                            <input type="text" class="form-control" id="vehicle_year"
                                                                name="vehicle_year" placeholder="Enter Vehicle Year Built"
                                                                value="{{ $v->vehicle_year }}" />
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 mb-3">
                                                            <label for="vehicleVin" class="form-label">Vehicle
                                                                Price</label>
                                                            <input type="text" class="form-control" id="vehicle_price"
                                                                name="vehicle_price" placeholder="Enter Vehicle Price"
                                                                value="{{ (int) $v->vehicle_price }}" />
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 mb-3">
                                                            <label for="vehicle_fuel" class="form-label">Vehicle
                                                                Fuel</label>
                                                            <select class="form-select" id="vehicle_fuel"
                                                                name="vehicle_fuel">
                                                                <option hidden selected value="{{ $v->vehicle_fuel }}">
                                                                    {{ $v->vehicle_fuel }}</option>
                                                                <option value="Bensin">Bensin</option>
                                                                <option value="Solar">Solar</option>

                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 mb-3">
                                                            <label for="vehicleStatus" class="form-label">Vehicle
                                                                Category</label>
                                                            <select class="form-select" id="vehicleStatus"
                                                                name="category_id">
                                                                <option hidden selected value={{ $v->category_id }}>
                                                                    {{ $v->category_desc }}</option>
                                                                @foreach ($categories as $c)
                                                                    <option value="{{ $c->category_id }}">
                                                                        {{ $c->category_desc }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 mb-3">
                                                            <label for="vehicleStatus" class="form-label">Vehicle
                                                                Type</label>
                                                            <select class="form-select" id="vehicleStatus"
                                                                name="type_id">
                                                                <option hidden selected value={{ $v->type_id }}>
                                                                    {{ $v->type_desc }}</option>
                                                                @foreach ($types as $t)
                                                                    <option value="{{ $t->type_id }}">
                                                                        {{ $t->type_desc }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 col-sm-12 mb-3">
                                                            <label for="vehicleStatus" class="form-label">Driver</label>
                                                            <select class="form-select" id="vehicleStatus"
                                                                name="driver_id">
                                                                <option hidden selected value={{ $v->driver_id }}>
                                                                    {{ $v->driver_name }} - {{ $v->driver_phone }}
                                                                </option>
                                                                @foreach ($drivers as $d)
                                                                    <option value="{{ $d->driver_id }}">
                                                                        {{ $d->driver_name }} -
                                                                        {{ $d->driver_phone }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 mb-3">
                                                            <label for="vehicleDescription" class="form-label">Vehicle
                                                                Usage</label>
                                                            @if ($v->logs != null)
                                                                <textarea class="form-control" id="vehicleDescription" name="log_desc" rows="3">
                                                                  {{ $v->logs->log_desc }}
                                                                </textarea>
                                                            @else
                                                                <textarea class="form-control" id="vehicleDescription" name="log_desc" rows="3"></textarea>
                                                            @endif

                                                        </div>

                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Update Modal -->

                                {{-- delete modal --}}
                                <div class="modal fade
                                    "
                                    id="deleteVehicle{{ $v->vehicle_id }}" tabindex="-1"
                                    aria-labelledby="deleteVehicle{{ $v->vehicle_id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteVehicle{{ $v->vehicle_id }}Label">
                                                    Delete {{ $v->vehicle_name }} Vechicle </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('vehicles.destroy', ['vId' => $v->vehicle_id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>Are you sure you want to delete {{ $v->vehicle_name }}?</p>
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- /delete modal --}}

                                {{-- Approval Modal --}}
                                <div class="modal fade" id="approvalVehicle{{ $v->vehicle_id }}" tabindex="-1"
                                    aria-labelledby="approvalVehicle{{ $v->vehicle_id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approvalVehicle{{ $v->vehicle_id }}Label">
                                                    Approval {{ $v->vehicle_name }} Vechicle </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('vehicles.approval', ['vId' => $v->vehicle_id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <p>Are you sure you want to approve {{ $v->vehicle_name }}?</p>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="status_id" id="status_id1" value=0 checked>
                                                                <label class="form-check-label" for="status_id1">
                                                                    <span class="badge bg-danger">Reject</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="status_id" id="status_id2" value=1>
                                                                <label class="form-check-label" for="status_id2">
                                                                    <span class="badge bg-success">Approved</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="d-block mt-4">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- /Approval Modal --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        {{-- /vehicle main table --}}
        <hr class="my-5" />
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#vehicle-table').DataTable({
                paging: true,
                ordering: true,
                info: true,

                // buttons
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            });

            $('#v-price').text(new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format($('#v-price').text()));

        });
    </script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ $error }}',
                })
            </script>
        @endforeach
    @endif

    @if (session('vehicle.store.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'great.',
                text: '{{ session('vehicle.store.success') }}',
            })
        </script>
    @endif
    @if (session('vehicle.update.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'great.',
                text: '{{ session('vehicle.update.success') }}',
            })
        </script>
    @endif
    @if (session('vehicle.destroy.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'great.',
                text: '{{ session('vehicle.destroy.success') }}',
            })
        </script>
    @endif
    @if (session('vehicle.approval.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'great.',
                text: '{{ session('vehicle.approval.success') }}',
            })
        </script>
    @endif
    @if (session('vehicle.approval.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('vehicle.approval.error') }}',
            })
        </script>
    @endif
@endpush
