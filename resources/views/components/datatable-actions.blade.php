<div class="btn-group btn-group-sm">
    <a href="{{ $editRoute }}" class="btn btn-outline-primary">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ $deleteRoute }}" method="POST" class="d-inline">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-outline-danger" 
                onclick="return confirm('Delete this schedule?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>