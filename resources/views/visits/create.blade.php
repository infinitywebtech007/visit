@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h1>Create Pass</h1>
        <div class="card">
            <div class="card-body">
                <form action="/visits" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="visitor_id" class="label">Search by Number</label>
                                <input type="text" name="visitor_number" id="visitor_number" class="form-control"
                                    v-model="visitorNumber" @input="handleVisitorNumberInput" maxlength="10" pattern="[0-9]{10}"
                                    placeholder="Enter 10-digit mobile number">
                                <small v-if="visitorNumberError" class="text-danger">@{{ visitorNumberError }}</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label for="visitor_id" class="label">Search by Name</label>
                                <select name="visitor_id" class="form-control" id="visitor_id" v-model="selectedVisitor">
                                    <option value="">Select Visitor</option>
                                    <option v-for="visitor in filteredVisitors" :key="visitor.id" :value="visitor.id">
                                        @{{ visitor.name }} - @{{ visitor.phone || visitor.mobile }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="attendant" class="form-label">To meet Employee</label>
                            <select name="employee_id" id="attendant" class="form-control" required>
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3 col-lg-6">
                            <label for="purpose" class="form-label">Purpose</label>
                            <input type="text" name="purpose" id="purpose" class="form-control" value="{{ old('purpose') }}">
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="&nbsp" class="form-label">Schedule Meeting ? </label>
                            <select name="prebooked" class="form-control" v-model="prebooked" id="prebooked">
                                <option value="0" selected >No</option>
                                <option value="1" >Yes</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3" v-if="prebooked==1" >
                            <label for="&nbsp" class="form-label">Booking Date</label>
                            <input type="date" required name="booking_date" id="booking_date" v-model="booking_date" class="form-control" >
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3" v-if="prebooked==1" >
                            <label for="&nbsp" class="form-label">Booking Time</label>
                            <input type="time" required name="booking_time" id="booking_time" v-model="booking_time" class="form-control" >
                        </div>
        
                        <div class="col-sm-12">
                            <input type="submit" value="Submit" class="btn bg-teal mt-3 ">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    {{-- <script src="https://unpkg.com/vue@3.5.21/dist/vue.esm-browser.js"></script>    --}}
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    visitors: @json($visitors),
                    employees: @json($employees),
                    visitorNumber: '',
                    selectedVisitor: '',
                    filteredVisitors: @json($visitors),
                    visitorNumberError: '',
                    prebooked:'',
                    booking_date:'',
                    booking_time:''
                }
            },
            computed: {
                selectedVisitorInfo() {
                    if (this.selectedVisitor) {
                        return this.visitors.find(visitor => visitor.id == this.selectedVisitor)
                    }
                    return null
                }
            },
            methods: {
                handleVisitorNumberInput(event) {
                    let value = event.target.value;

                    // Remove all non-numeric characters
                    value = value.replace(/\D/g, '');

                    // Limit to 10 digits
                    if (value.length > 10) {
                        value = value.slice(0, 10);
                    }

                    // Update the model
                    this.visitorNumber = value;

                    // Validate and show error
                    this.validateVisitorNumber();

                    // Filter visitors
                    this.filterVisitorsByNumber();
                },

                validateVisitorNumber() {
                    if (this.visitorNumber === '') {
                        this.visitorNumberError = '';
                        return true;
                    }

                    if (this.visitorNumber.length !== 10) {
                        this.visitorNumberError = 'Mobile number must be exactly 10 digits';
                        return false;
                    }

                    if (!/^\d{10}$/.test(this.visitorNumber)) {
                        this.visitorNumberError = 'Mobile number must contain only numbers';
                        return false;
                    }

                    this.visitorNumberError = '';
                    return true;
                },

                filterVisitorsByNumber() {
                    if (this.visitorNumber.trim() === '') {
                        // Show all visitors if no number entered
                        this.filteredVisitors = this.visitors
                        this.selectedVisitor = ''
                        return
                    }

                    // Filter visitors based on mobile number
                    this.filteredVisitors = this.visitors.filter(visitor => {
                        const phone = visitor.phone || visitor.mobile || ''
                        // Remove non-numeric characters from phone for comparison
                        const cleanPhone = phone.replace(/\D/g, '')
                        return cleanPhone.includes(this.visitorNumber)
                    })

                    // Auto-select if exact match found
                    const exactMatch = this.filteredVisitors.find(visitor => {
                        const phone = visitor.phone || visitor.mobile || ''
                        const cleanPhone = phone.replace(/\D/g, '')
                        return cleanPhone === this.visitorNumber
                    })

                    if (exactMatch) {
                        this.selectedVisitor = exactMatch.id
                    } else if (this.filteredVisitors.length === 1) {
                        // Auto-select if only one result
                        this.selectedVisitor = this.filteredVisitors[0].id
                    } else {
                        this.selectedVisitor = ''
                    }
                }
            },
            watch: {
                selectedVisitor(newVal) {
                    // Update the visitor number field when visitor is selected manually
                    if (newVal) {
                        const visitor = this.visitors.find(v => v.id == newVal)
                        if (visitor) {
                            const phone = visitor.phone || visitor.mobile || ''
                            // Extract only digits and limit to 10
                            const cleanPhone = phone.replace(/\D/g, '').slice(0, 10)
                            this.visitorNumber = cleanPhone
                            this.validateVisitorNumber()
                        }
                    } else {
                        // Clear visitor number when no visitor is selected
                        this.visitorNumber = ''
                        this.visitorNumberError = ''
                    }
                }
            }
        }).mount('#app')
    </script>
@endsection

