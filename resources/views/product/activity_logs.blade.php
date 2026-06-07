<x-layout>

<div class="container mt-4 tbl-wrap">

    <div class="tbl-header">
        <div>
            <h2>Activity Logs</h2>
            <p>Track all user actions and system events</p>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>
                        <div class="td-user">
                            <div class="td-user-avatar">
                                {{ strtoupper(substr($log->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <span class="td-user-name">{{ $log->user->name ?? 'Unknown' }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="action-badge">{{ $log->action }}</span>
                    </td>
                    <td class="td-desc">{{ $log->description }}</td>
                    <td class="td-date">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="td-empty">No activity logs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>

</div>

</x-layout>