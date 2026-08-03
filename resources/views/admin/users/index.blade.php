@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <div>
                <p class="mm-subtitle">User management</p>
                <h1 class="mt-2 mm-section-title">Users</h1>
                <p class="mm-section-copy">Manage registered customers and staff roles.</p>
            </div>
        </div>

        <div class="mm-table-shell">
            <table class="w-full min-w-[680px] divide-y divide-slate-200 text-left text-slate-700">
                <thead class="bg-slate-50 text-xs uppercase tracking-[0.2em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4">Address</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->phone }}</td>
                            <td class="px-6 py-4">{{ $user->address }}</td>
                            <td class="px-6 py-4"><span class="mm-badge bg-brand-50 text-brand-700 ring-1 ring-brand-100">{{ ucfirst($user->role) }}</span></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <form action="{{ route('admin.users.toggle', $user) }}" method="post">@csrf
                                        <button class="font-semibold text-brand-700 transition hover:text-brand-800">{{ $user->role === 'admin' ? 'Demote' : 'Promote' }}</button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="post">@csrf @method('delete')
                                        <button onclick="return confirm('Delete user?')" class="font-semibold text-rose-600 transition hover:text-rose-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="rounded-[1.5rem] bg-white p-4 shadow-sm">{{ $users->links() }}</div>
    </div>
@endsection
