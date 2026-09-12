<div class="row g-3">
    <div class="col-md-6">
        <label for="user_id" class="form-label">User</label>
        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
            <option value="">Select a user</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id', $driver?->user_id ?? null) == $user->id)>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
        @error('user_id')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
            value="{{ old('phone', $driver?->phone ?? '') }}" required>
        @error('phone')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="car" class="form-label">Car</label>
        <input type="text" class="form-control @error('car') is-invalid @enderror" id="car" name="car"
            value="{{ old('car', $driver?->car ?? '') }}">
        @error('car')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="color" class="form-label">Color</label>
        <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color"
            value="{{ old('color', $driver?->color ?? '') }}">
        @error('color')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12">
        <div class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                @checked(old('is_active', $driver?->is_active ?? true))>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
    </div>
</div>
