@extends('layouts.admin')

@section('content')
<div class="admin-form-wrapper">
    <div class="admin-form-card">
        <h1 class="admin-form-title">➕ Agregar Nuevo Juego</h1>
        {{-- Mostrar errores generales --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom:18px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data" class="game-form">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="title"><span>🎮</span> Nombre del Juego</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required maxlength="255" placeholder="Ej: The Witcher 3">
                    @error('title')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="price"><span>💰</span> Precio (S/)</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" step="0.01" min="0" max="999.99" required placeholder="Ej: 59.99">
                    @error('price')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="category_id"><span>📂</span> Categoría</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Selecciona una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="image"><span>🖼️</span> Imagen principal</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="developer"><span>🛠️</span> Desarrollador</label>
                    <input type="text" name="developer" id="developer" class="form-control" value="{{ old('developer') }}" required maxlength="255" placeholder="Ej: CD Projekt Red">
                    @error('developer')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="publisher"><span>🏢</span> Publicador</label>
                    <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher') }}" required maxlength="255" placeholder="Ej: CD Projekt">
                    @error('publisher')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="release_date"><span>📅</span> Fecha de Lanzamiento</label>
                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date') }}" required>
                    @error('release_date')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="age_rating"><span>🔞</span> Clasificación de Edad</label>
                    <select name="age_rating" id="age_rating" class="form-control" required>
                        <option value="">Selecciona</option>
                        <option value="E" {{ old('age_rating') == 'E' ? 'selected' : '' }}>E (Todos)</option>
                        <option value="E10+" {{ old('age_rating') == 'E10+' ? 'selected' : '' }}>E10+ (10+ años)</option>
                        <option value="T" {{ old('age_rating') == 'T' ? 'selected' : '' }}>T (Adolescentes)</option>
                        <option value="M" {{ old('age_rating') == 'M' ? 'selected' : '' }}>M (Maduros 17+)</option>
                        <option value="AO" {{ old('age_rating') == 'AO' ? 'selected' : '' }}>AO (Solo adultos)</option>
                    </select>
                    @error('age_rating')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group">
                <label for="description"><span>📝</span> Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="4" required maxlength="2000" placeholder="Describe el juego...">{{ old('description') }}</textarea>
                @error('description')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="screenshots"><span>📸</span> Capturas de pantalla (puedes subir varias)</label>
                <input type="file" name="screenshots[]" id="screenshots" class="form-control" accept="image/*" multiple>
                @error('screenshots')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar Juego</button>
                <a href="{{ route('admin.games') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<style>
.admin-form-wrapper {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 80vh;
    background: #f7f8fa;
    padding: 40px 0;
}
.admin-form-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    padding: 32px 36px 24px 36px;
    width: 100%;
    max-width: 540px;
}
.admin-form-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 24px;
    color: #2d3748;
    text-align: center;
}
.form-row {
    display: flex;
    gap: 24px;
}
.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
    margin-bottom: 18px;
}
.form-group label {
    font-weight: 600;
    margin-bottom: 6px;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 6px;
}
.form-control {
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 10px 12px;
    font-size: 1rem;
    background: #f9fafb;
    transition: border 0.2s;
}
.form-control:focus {
    border-color: #6366f1;
    outline: none;
    background: #fff;
}
.error {
    color: #e53e3e;
    font-size: 0.95em;
    margin-top: 2px;
}
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 16px;
    margin-top: 18px;
}
.btn.btn-primary {
    background: #6366f1;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 22px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}
.btn.btn-primary:hover {
    background: #4f46e5;
}
.btn.btn-secondary {
    background: #e5e7eb;
    color: #374151;
    border: none;
    border-radius: 6px;
    padding: 10px 22px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}
.btn.btn-secondary:hover {
    background: #d1d5db;
}
</style>
@endsection
