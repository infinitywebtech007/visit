@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <h1>Create Visit</h1>
        <form action="/visits" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="visitor_id" class="label">Visitor Number</label>
                        <input type="text" name="visitor_number" id="visitor_number" class="form-control" v-model="visitorNumber" @input="filterVisitorsByNumber" >
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label for="visitor_id" class="label">Visitor</label>
                        <select name="visitor_id" class="form-control" id="visitor_id" v-model="selectedVisitor" >
                            <option value="">Select Visitor</option>
                            <option v-for="visitor in filteredVisitors" 
                                    :key="visitor.id" 
                                    :value="visitor.id">
                                @{{ visitor.name }} - @{{ visitor.phone || visitor.mobile }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <label for="attendant" class="form-label">Employee</label>
                    <select name="employee_id" id="attendant" class="form-control" required>
                        <option value="">Select Attendant</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <label for="purpose" class="form-label">Purpose</label>
                    <input type="text" name="purpose" id="purpose" class="form-control"
                        value="{{ old('purpose') }}">
                </div>
p --}}
                {{-- <div class="col-sm-12 col-md-6 col-lg-4 form-check">
                    <label for="&nbsp" class="label">&nbsp</label>
                    <input type="checkbox" name="prebooked" id="prebooked" class="form-check-input" value="1"
                        {{ old('prebooked') ? 'checked' : '' }}>
                    <label for="prebooked" class="form-check-label">Prebooked</label>
                </div> --}}
                <div class="col-sm-12">
                    <input type="submit" value="submit">
                </div>
            </div>
        </form>

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
                    filteredVisitors: @json($visitors)
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
                        return phone.includes(this.visitorNumber)
                    })

                    // Auto-select if exact match found
                    const exactMatch = this.filteredVisitors.find(visitor => {
                        const phone = visitor.phone || visitor.mobile || ''
                        return phone === this.visitorNumber
                    })

                    if (exactMatch) {
                        this.selectedVisitor = exactMatch.id
                    } else if (this.filteredVisitors.length === 1) {
                        // Auto-select if only one result
                        this.selectedVisitor = this.filteredVisitors[0].id
                    } else {
                        this.selectedVisitor = ''
                    }
                },
                watch: {
                    selectedVisitor(newVal) {
                        // Update the visitor number field when visitor is selected manually
                        if (newVal) {
                            const visitor = this.visitors.find(v => v.id == newVal)
                            if (visitor) {
                                this.visitorNumber = visitor.phone || visitor.mobile || ''
                            }
                        }
                    }
                }
            },
        }).mount('#app')
    </script>
@endsection

