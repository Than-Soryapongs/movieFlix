<div class="mb-3">
    <label for="name" class="form-label">Genre Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $genre->name ?? '') }}" required>
</div>

<button type="submit" class="btn btn-success">{{ isset($genre) ? 'Update' : 'Create' }}</button>
