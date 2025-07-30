<div class="language-switcher">
    <form method="POST" action="{{ route('language.change') }}">
        @csrf
        <select name="locale" onchange="this.form.submit()" class="form-select">
            <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>🇬🇧 English</option>
            <option value="fr" {{ app()->getLocale() === 'fr' ? 'selected' : '' }}>🇫🇷 Français</option>
        </select>
    </form>
</div>
