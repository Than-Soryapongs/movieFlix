@csrf
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $actor->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Date of Birth</label>
    <input type="date" name="dob" class="form-control" value="{{ old('dob', $actor->dob ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Bio</label>
    <textarea name="bio" class="form-control">{{ old('bio', $actor->bio ?? '') }}</textarea>
</div>
<button type="submit" class="btn btn-success">Save</button>
<a href="{{ route('admin.actors.index') }}" class="btn btn-secondary">Cancel</a>
