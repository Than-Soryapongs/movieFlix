<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $director->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" name="dob" class="form-control" value="{{ old('dob', $director->dob ?? '') }}">
</div>

<div class="mb-3">
    <label for="bio" class="form-label">Biography</label>
    <textarea name="bio" class="form-control" rows="4">{{ old('bio', $director->bio ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-success">{{ isset($director) ? 'Update' : 'Create' }}</button>
