<div class="list-group">
    @forelse($users as $user)
    <div class="list-group-item list-group-item-action d-flex align-items-center">
        <div class="avatar me-3">
            <span class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
        </div>
        <div class="w-100">
            <div class="d-flex justify-content-between">
                <div class="user-info">
                    <h6 class="mb-1">{{ $user->name }}</h6>
                    @if($user->email) <small class="text-muted">{{ $user->email }}</small> @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center p-3">
        {{ trns('No users found') }}
    </div>
    @endforelse
</div>
