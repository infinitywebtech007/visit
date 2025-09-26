
@extends('layouts.app')

@section('subtitle', 'Roles and Permissions')
@section('content_header_title', 'Manage Roles and Permissions')
@section('content_header_subtitle', 'Create, assign, and manage roles and permissions')

@section('content')
<div class="container" id="app">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="roles-tab" data-toggle="tab" href="#roles" role="tab" aria-controls="roles" aria-selected="false">Roles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="permissions-tab" data-toggle="tab" href="#permissions" role="tab" aria-controls="permissions" aria-selected="false">Permissions</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Assign Roles and Permissions to Users</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="user_select">Select User</label>
                                <select id="user_select" class="form-control" v-model="selectedUserId">
                                    <option value="">Choose a user</option>
                                    <option v-for="user in users" :key="user.id" :value="user.id">
                                        @{{ user.name }} (@{{ user.email }})
                                    </option>
                                </select>
                            </div>
                            <div v-if="selectedUser" class="row">
                                <div class="col-md-6">
                                    <h5>Roles</h5>
                                    <div v-for="role in roles" :key="role.id" class="form-check">
                                        <input class="form-check-input" type="checkbox" :id="'role-' + role.id" :value="role.name" v-model="selectedUserRoles" @change="toggleRole(role.name)">
                                        <label class="form-check-label" :for="'role-' + role.id">
                                            @{{ role.name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Permissions</h5>
                                    <div v-for="permission in permissions" :key="permission.id" class="form-check">
                                        <input class="form-check-input" type="checkbox" :id="'perm-' + permission.id" :value="permission.name" v-model="selectedUserPermissions" @change="togglePermission(permission.name)">
                                        <label class="form-check-label" :for="'perm-' + permission.id">
                                            @{{ permission.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="roles-tab">
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create New Role</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="newRoleName" placeholder="Role name">
                                <button class="btn btn-primary mt-2" @click="createRole" :disabled="!newRoleName">Create Role</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Existing Roles</h3>
                        </div>
                        <div class="card-body">
                            <div v-for="role in roles" :key="role.id" class="mb-3">
                                <h5>@{{ role.name }}</h5>
                                <button class="btn btn-danger btn-sm" @click="deleteRole(role.name)">Delete Role</button>
                                <div class="mt-2">
                                    <h6>Permissions:</h6>
                                    <div v-for="permission in permissions" :key="permission.id" class="form-check">
                                        <input class="form-check-input" type="checkbox" :id="'role-perm-' + role.id + '-' + permission.id" :value="permission.name" :checked="role.permissions.some(p => p.name === permission.name)" @change="togglePermissionForRole(role.name, permission.name, $event)">
                                        <label class="form-check-label" :for="'role-perm-' + role.id + '-' + permission.id">
                                            @{{ permission.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create New Permission</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="newPermissionName" placeholder="Permission name">
                                <button class="btn btn-primary mt-2" @click="createPermission" :disabled="!newPermissionName">Create Permission</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Existing Permissions</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li v-for="permission in permissions" :key="permission.id" class="list-group-item d-flex justify-content-between align-items-center">
                                    @{{ permission.name }}
                                    <button class="btn btn-danger btn-sm" @click="deletePermission(permission.name)">Delete</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            users: @json($users),
            roles: @json($roles),
            permissions: @json($permissions),
            selectedUserId: '',
            selectedUserRoles: [],
            selectedUserPermissions: [],
            newRoleName: '',
            newPermissionName: ''
        }
    },
    computed: {
        selectedUser() {
            if (this.selectedUserId) {
                return this.users.find(user => user.id == this.selectedUserId);
            }
            return null;
        }
    },
    watch: {
        selectedUserId(newVal) {
            if (newVal) {
                const user = this.selectedUser;
                this.selectedUserRoles = user.roles.map(r => r.name);
                this.selectedUserPermissions = user.permissions.map(p => p.name);
            } else {
                this.selectedUserRoles = [];
                this.selectedUserPermissions = [];
            }
        }
    },
    methods: {
        async toggleRole(roleName) {
            if (!this.selectedUserId) return;
            const hasRole = this.selectedUserRoles.includes(roleName);
            const url = hasRole ? '/remove-role' : '/assign-role';
            try {
                const response = await axios.post(url, { user_id: this.selectedUserId, role: roleName });
                alert('Success: ' + response.data.message);
                // Model already updated by v-model, update selectedUser for consistency
                if (hasRole) {
                    this.selectedUser.roles = this.selectedUser.roles.filter(r => r.name !== roleName);
                } else {
                    const role = this.roles.find(r => r.name === roleName);
                    this.selectedUser.roles.push(role);
                }
            } catch (error) {
                // Revert model
                if (hasRole) {
                    this.selectedUserRoles.push(roleName);
                } else {
                    this.selectedUserRoles = this.selectedUserRoles.filter(r => r !== roleName);
                }
                alert('Error: ' + error.response.data.message);
            }
        },
        async togglePermission(permissionName) {
            if (!this.selectedUserId) return;
            const hasPermission = this.selectedUserPermissions.includes(permissionName);
            const url = hasPermission ? '/remove-permission' : '/give-permission';
            try {
                const response = await axios.post(url, { user_id: this.selectedUserId, permission: permissionName });
                alert('Success: ' + response.data.message);
                // Model already updated, update selectedUser
                if (hasPermission) {
                    this.selectedUser.permissions = this.selectedUser.permissions.filter(p => p.name !== permissionName);
                } else {
                    const perm = this.permissions.find(p => p.name === permissionName);
                    this.selectedUser.permissions.push(perm);
                }
            } catch (error) {
                // Revert model
                if (hasPermission) {
                    this.selectedUserPermissions.push(permissionName);
                } else {
                    this.selectedUserPermissions = this.selectedUserPermissions.filter(p => p !== permissionName);
                }
                alert('Error: ' + error.response.data.message);
            }
        },
        async createRole() {
            try {
                const response = await axios.post('/create-role', { name: this.newRoleName });
                alert('Success: ' + response.data.message);
                const newRole = response.data.role;
                newRole.permissions = [];
                this.roles.push(newRole);
                this.newRoleName = '';
            } catch (error) {
                alert('Error: ' + (error.response.data.error || error.response.data.message));
            }
        },
        async deleteRole(roleName) {
            if (!confirm('Delete role?')) return;
            try {
                const response = await axios.post('/delete-role', { name: roleName });
                alert('Success: ' + response.data.message);
                this.roles = this.roles.filter(r => r.name !== roleName);
            } catch (error) {
                alert('Error: ' + (error.response.data.error || error.response.data.message));
            }
        },
        async togglePermissionForRole(roleName, permissionName, event) {
            const role = this.roles.find(r => r.name === roleName);
            const shouldAdd = event.target.checked;
            const url = shouldAdd ? '/add-permission-to-role' : '/remove-permission-from-role';
            try {
                const response = await axios.post(url, { role: roleName, permission: permissionName });
                alert('Success: ' + response.data.message);
                if (shouldAdd) {
                    const perm = this.permissions.find(p => p.name === permissionName);
                    if (perm && !role.permissions.some(p => p.name === permissionName)) {
                        role.permissions.push(perm);
                    }
                } else {
                    role.permissions = role.permissions.filter(p => p.name !== permissionName);
                }
            } catch (error) {
                event.target.checked = !shouldAdd; // Revert checkbox
                alert('Error: ' + error.response.data.message);
            }
        },
        async createPermission() {
            try {
                const response = await axios.post('/create-permission', { name: this.newPermissionName });
                alert('Success: ' + response.data.message);
                this.permissions.push(response.data.permission);
                this.newPermissionName = '';
            } catch (error) {
                alert('Error: ' + (error.response.data.error || error.response.data.message));
            }
        },
        async deletePermission(permissionName) {
            if (!confirm('Delete permission?')) return;
            try {
                const response = await axios.post('/delete-permission', { name: permissionName });
                alert('Success: ' + response.data.message);
                this.permissions = this.permissions.filter(p => p.name !== permissionName);
            } catch (error) {
                alert('Error: ' + (error.response.data.error || error.response.data.message));
            }
        }
    }
}).mount('#app');
</script>
@endsection

@push('css')
{{-- Additional CSS if needed --}}
@endpush

@push('js')
{{-- Additional JS if needed --}}
@endpush
